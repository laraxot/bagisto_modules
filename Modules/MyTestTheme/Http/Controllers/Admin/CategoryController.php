<?php

namespace Modules\MyTestTheme\Http\Controllers\Admin;

use Illuminate\Http\Response;
use Modules\Category\Repositories\CategoryRepository;
use Modules\MyTestTheme\Repositories\CategoryRepository as myTestThemeCategoryRepository;

class CategoryController extends Controller
{
    /**
     * Category Repository object
     *
     * @var \Modules\Category\Repositories\CategoryRepository
    */
    protected $categoryRepository;

    /**
     * myTestThemeCategory Repository object
     *
     * @var \Modules\myTestTheme\Repositories\CategoryRepository
    */
    protected $myTestThemeCategoryRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Modules\Category\Repositories\CategoryRepository  $categoryRepository;
     * @param  \Modules\myTestTheme\Repositories\CategoryRepository  $myTestThemeCategory;
     * @return void
     */
    public function __construct(
        CategoryRepository $categoryRepository,
        myTestThemeCategoryRepository $myTestThemeCategoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;

        $this->myTestThemeCategoryRepository = $myTestThemeCategoryRepository;

        $this->_config = request('_config');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if (! core()->getConfigData('myTestTheme.configuration.general.status')) {
            session()->flash('error', trans('myTestTheme::app.admin.system.myTestTheme.error-module-inactive'));

            return redirect()->route('admin.configuration.index', ['slug' => 'myTestTheme', 'slug2' => 'configuration']);
        }

        return view($this->_config['view']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = $this->myTestThemeCategoryRepository->getChannelCategories();

        return view($this->_config['view'], compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->myTestThemeCategoryRepository->create(request()->all());

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Category Menu']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $categories = $this->categoryRepository->getVisibleCategoryTree(core()->getCurrentChannel()->root_category_id);

        $myTestThemeCategory = $this->myTestThemeCategoryRepository->findOrFail($id);

        return view($this->_config['view'], compact('categories', 'myTestThemeCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $myTestThemeCategory = $this->myTestThemeCategoryRepository->update(request()->all(), $id);

        session()->flash('success', trans('admin::app.response.update-success', ['name' => 'Category Menu']));

        return redirect()->route($this->_config['redirect']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $myTestThemeCategory = $this->myTestThemeCategoryRepository->findOrFail($id);

        try {
            $this->myTestThemeCategoryRepository->delete($id);

            session()->flash('success', trans('admin::app.response.delete-success', ['name' => 'Category Menu']));

            return response()->json(['message' => true], 200);
        } catch (\Exception $e) {
            session()->flash('error', trans('admin::app.response.delete-failed', ['name' => 'Category Menu']));
        }

        return response()->json(['message' => false], 400);
    }

    /**
     * Mass Delete the products
     *
     * @return \Illuminate\Http\Response
     */
    public function massDestroy()
    {
        $menuIds = explode(',', request()->input('indexes'));

        foreach ($menuIds as $menuId) {
            $myTestThemeCategory = $this->myTestThemeCategoryRepository->find($menuId);

            if (isset($myTestThemeCategory)) {
                $this->myTestThemeCategoryRepository->delete($menuId);
            }
        }

        session()->flash('success', trans('myTestTheme::app.admin.category.mass-delete-success'));

        return redirect()->route($this->_config['redirect']);
    }
}