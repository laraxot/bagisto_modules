<?php

namespace Modules\MyTestTheme\Repositories;

use Modules\Core\Eloquent\Repository;
use Illuminate\Container\Container as App;
use Prettus\Repository\Traits\CacheableRepository;

class CategoryRepository extends Repository
{
    use CacheableRepository;

   /**
    * Category Repository object
    *
    * @var \Modules\Category\Repositories\CategoryRepository
    */
    protected $categoryRepository;

    /**
     * Create a new repository instance.
     *
     * @param  \Modules\Category\Repositories\CategoryRepository  $categoryRepository
     * @param  \Illuminate\Container\Container  $app
     * @return void
     */
    public function __construct(
        CategoryRepository $categoryRepository,
        App $app
    )
    {
        $this->categoryRepository = $categoryRepository;

        parent::__construct($app);
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    function model()
    {
        return 'Modules\myTestTheme\Contracts\Category';
    }

    /**
     * Return current channel categories
     *
     * @return array
     */
    public function getChannelCategories()
    {
        $results = [];

        $myTestThemeCategories = $this->model->all(['category_id']);

        $categoryMenues = json_decode(json_encode($myTestThemeCategories), true);

        $categories = $this->categoryRepository->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id);

        if (isset($categories->first()->id)) {
            foreach ($categories as $category) {

                if (! empty($categoryMenues) && !in_array($category->id, array_column($categoryMenues, 'category_id'))) {
                    $results[] = [
                        'id'   => $category->id,
                        'name' => $category->name,
                    ];
                }
            }
        }
        return $results;
    }
}