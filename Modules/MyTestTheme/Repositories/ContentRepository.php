<?php

namespace Modules\MyTestTheme\Repositories;

use Modules\Core\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Modules\Product\Repositories\ProductRepository;
use Prettus\Repository\Traits\CacheableRepository;

class ContentRepository extends Repository
{
    use CacheableRepository;

   /**
    * Product Repository object
    *
    * @var \Modules\Product\Repositories\ProductRepository
    */
    protected $productRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Modules\Product\Repositories\ProductRepository $productRepository
     * @param  \Illuminate\Container\Container  $app
     * @return void
     */
    public function __construct(
        ProductRepository $productRepository,
        App $app
    )
    {
        $this->productRepository = $productRepository;

        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Modules\myTestTheme\Contracts\Content';
    }

    /**
     * @param  array  $data
     * @return \Modules\myTestTheme\Models\Content
     */
    public function create(array $data)
    {
        // Event::fire('myTestTheme.content.create.before');

        if (isset($data['locale']) && $data['locale'] == 'all') {
            $model = app()->make($this->model());

            foreach (core()->getAllLocales() as $locale) {
                foreach ($model->translatedAttributes as $attribute) {
                    if (isset($data[$attribute])) {
                        $data[$locale->code][$attribute] = $data[$attribute];
                    }
                }
            }
        }

        $content = $this->model->create($data);

        // Event::fire('myTestTheme.content.create.after', $content);

        return $content;
    }

    /**
     * @param  array  $data
     * @param  int  $id
     * @return \Modules\myTestTheme\Models\Content
     */
    public function update(array $data, $id)
    {
        $content = $this->find($id);

        // Event::fire('myTestTheme.content.update.before', $id);

        $content->update($data);

        // Event::fire('myTestTheme.content.update.after', $id);

        return $content;
    }

    /**
     * @param  int  $id
     * @return array
     */
    public function getProducts($id)
    {
        $results = [];

        $locale = request()->get('locale') ?: app()->getLocale();

        $content = $this->model->find($id);

        if ($content->content_type == 'product') {
            $contentLocale = $content->translate($locale);

            $products = json_decode($contentLocale->products, true);

            if (! empty($products)) {
                foreach ($products as $product_id) {
                    $product = $this->productRepository->find($product_id);

                    if (isset($product->id)) {
                        $results[] = [
                            'id'   => $product->id,
                            'name' => $product->name,
                        ];
                    }
                }
            }
        }

        return $results;
    }

    /**
     * @return array
     */
    public function getAllContents()
    {
        $query = $this->model::orderBy('position', 'ASC');

        $myTestThemeMetaData = app('Modules\myTestTheme\Helpers\Helper')->getmyTestThemeMetaData();
        $headerContentCount = $myTestThemeMetaData->header_content_count ?? '';

        $headerContentCount = $headerContentCount != '' ? $headerContentCount : 5;

        $contentCollection = $query
            ->select(
                'myTestTheme_contents.content_type',
                'myTestTheme_contents_translations.title as title',
                'myTestTheme_contents_translations.page_link as page_link',
                'myTestTheme_contents_translations.link_target as link_target'
            )
            ->where('myTestTheme_contents.status', 1)
            ->leftJoin('myTestTheme_contents_translations', 'myTestTheme_contents.id', 'myTestTheme_contents_translations.content_id')
            ->distinct('myTestTheme_contents_translations.id')
            ->where('myTestTheme_contents_translations.locale', app()->getLocale())
            ->limit($headerContentCount)
            ->get();

        $formattedContent = [];

        foreach ($contentCollection as $content) {
            array_push($formattedContent, [
                'title'        => $content->title,
                'page_link'    => $content->page_link,
                'link_target'  => $content->link_target,
                'content_type' => $content->content_type,
            ]);
        }

        return $formattedContent;
    }
}