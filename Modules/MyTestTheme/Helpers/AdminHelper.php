<?php

namespace Modules\MyTestTheme\Helpers;

use Illuminate\Support\Facades\Storage;
use Modules\Category\Repositories\CategoryRepository;

class AdminHelper
{
    /**
     * CategoryRepository object
     *
     * @var \Modules\Category\Repositories\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * Create a new helper instance.
     *
     * @param  \Modules\Category\Repositories\CategoryRepository  $categoryRepository
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository =  $categoryRepository;
    }

    /**
     * @param  string  $locale
     * @return string
     */
    public function saveLocaleImg($locale)
    {
        $data = request()->all();
        $type = 'locale_image';

        $locale = $this->uploadImage($locale, $data, $type);

        return $locale;
    }

    /**
     * @param  \Modules\Category\Contracts\Category  $category
     * @return \Modules\Category\Contracts\Category
     */
    public function storeCategoryIcon($category)
    {
        $data = request()->all();

        if (! $category instanceof \Modules\Category\Contracts\Category) {
            $category = $this->categoryRepository->findOrFail($category);
        }

        $category = $this->uploadImage($category, $data, 'category_icon_path');

        return $category;
    }

    /**
     * @param  \Modules\Core\Contracts\Slider  $slider
     * @return bool
     */
    public function storeSliderDetails($slider)
    {
        $slider->slider_path = request()->get('slider_path');
        $slider->save();

        return true;
    }

    /**
     * @param  \Illuminate\Database\Eloquent\Model  $slider
     * @param  array  $data
     * @param  string  $type
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function uploadImage($model, $data, $type) {
        if (isset($data[$type])) {
            $request = request();

            foreach ($data[$type] as $imageId => $image) {
                $file = $type . '.' . $imageId;
                $dir = 'myTestTheme/' . $type . '/' . $model->id;

                if ($request->hasFile($file)) {
                    if ($model->{$type}) {
                        Storage::delete($model->{$type});
                    }

                    $model->{$type} = $request->file($file)->store($dir);
                    $model->save();
                }
            }
        } else {
            if ($model->{$type}) {
                Storage::delete($model->{$type});
            }

            $model->{$type} = null;
            $model->save();
        }

        return $model;
    }
}