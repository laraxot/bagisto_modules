<?php

namespace Modules\Shop\Http\Controllers;

use Modules\Product\Repositories\SearchRepository;

 class SearchController extends Controller
{
    /**
     * SearchRepository object
     *
     * @var \Modules\Product\Repositories\SearchRepository
    */
    protected $searchRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Modules\Product\Repositories\SearchRepository  $searchRepository
     * @return void
    */
    public function __construct(SearchRepository $searchRepository)
    {
        $this->searchRepository = $searchRepository;

        parent::__construct();
    }

    /**
     * Index to handle the view loaded with the search results
     * 
     * @return \Illuminate\View\View 
     */
    public function index()
    {
        $results = $this->searchRepository->search(request()->all());

        return view($this->_config['view'])->with('results', $results->count() ? $results : null);
    }
}
