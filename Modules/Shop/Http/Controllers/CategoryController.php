<?php

namespace Modules\Shop\Http\Controllers;

use Modules\Category\Repositories\CategoryRepository;

class CategoryController extends Controller
{
    /**
     * CategoryRepository object
     *
     * @var \Modules\Category\Repositories\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Modules\Category\Repositories\CategoryRepository  $categoryRepository
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;

        parent::__construct();
    }
}
