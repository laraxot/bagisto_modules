<?php

namespace Modules\MyTestTheme;

use Modules\Category\Repositories\CategoryRepository;

class MyTestTheme
{
    /**
     * Content Type List
     *
     * @var array
     */
	protected $content_type = [
        // 'link'     => 'Link CMS Page',
        // 'product'  => 'Catalog Products',
        // 'static'   => 'Static Content',
        'category' => 'Category Slug',
    ];

    /**
     * Catalog Product Type
     *
     * @var array
     */
	protected $catalog_type = [
        'new'     => 'New Arrival',
        'offer'   => 'Offered Product [Special]',
        'popular' => 'Popular Products',
        'viewed'  => 'Most Viewed',
        'rated'   => 'Most Rated',
        'custom'  => 'Custom Selection',
    ];

	/**
	 * CategoryRepository object
	 * 
	 * @var \Modules\Category\Repositories\CategoryRepository
	 */
	protected $categoryRepository;

    /**
     * Create a new instance.
     *
     * @param  \Modules\Category\Repositories\CategoryRepository  $categoryRepository
     * @return void
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
		return $this->content_type;
    }

    /**
     * @return string
     */
    public function getCatalogType()
    {
		return $this->catalog_type;
    }
}