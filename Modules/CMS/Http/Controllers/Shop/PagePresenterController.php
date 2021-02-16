<?php

namespace Modules\CMS\Http\Controllers\Shop;

use Modules\CMS\Http\Controllers\Controller;
use Modules\CMS\Repositories\CmsRepository;

class PagePresenterController extends Controller
{
    /**
     * CmsRepository object
     *
     * @var \Modules\CMS\Repositories\CmsRepository
     */
    protected $cmsRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Modules\CMS\Repositories\CmsRepository  $cmsRepository
     * @return void
     */
    public function __construct(CmsRepository $cmsRepository)
    {
        $this->cmsRepository = $cmsRepository;
    }

    /**
     * To extract the page content and load it in the respective view file
     *
     * @param  string  $urlKey
     * @return \Illuminate\View\View
     */
    public function presenter($urlKey)
    {
        $page = $this->cmsRepository->findByUrlKeyOrFail($urlKey);

        return view('shop::cms.page')->with('page', $page);
    }
}