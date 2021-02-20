<?php

Route::group(['middleware' => ['web', 'locale', 'theme', 'currency']], function () {
    Route::namespace('Modules\myTestTheme\Http\Controllers\Shop')->group(function () {
        Route::get('/product-details/{slug}', 'ShopController@fetchProductDetails')
            ->name('myTestTheme.shop.product');

        Route::get('/categorysearch', 'ShopController@search')
            ->name('myTestTheme.search.index')
            ->defaults('_config', [
                'view' => 'shop::search.search'
            ]);

        Route::get('/categories', 'ShopController@fetchCategories')
        ->name('myTestTheme.categoriest');

        Route::get('/category-details', 'ShopController@categoryDetails')
            ->name('myTestTheme.category.details');

        Route::get('/fancy-category-details/{slug}', 'ShopController@fetchFancyCategoryDetails')->name('myTestTheme.fancy.category.details');

        Route::get('/mini-cart', 'CartController@getMiniCartDetails')
            ->name('myTestTheme.cart.get.details');

        Route::post('/cart/add', 'CartController@addProductToCart')
            ->name('myTestTheme.cart.add.product');

        Route::delete('/cart/remove/{id}', 'CartController@removeProductFromCart')
            ->name('myTestTheme.cart.remove.product');

        Route::get('/comparison', 'ComparisonController@getComparisonList')
            ->name('myTestTheme.product.compare')
            ->defaults('_config', [
                'view' => 'shop::guest.compare.index'
            ]);

        Route::group(['middleware' => ['customer']], function () {
            Route::get('/customer/account/comparison', 'ComparisonController@getComparisonList')
                ->name('myTestTheme.customer.product.compare')
                ->defaults('_config', [
                    'view' => 'shop::customers.account.compare.index'
                ]);
        });

        Route::put('/comparison', 'ComparisonController@addCompareProduct')
            ->name('customer.product.add.compare');

        Route::delete('/comparison', 'ComparisonController@deleteComparisonProduct')
            ->name('customer.product.delete.compare');

        Route::get('/items-count', 'ShopController@getItemsCount')
            ->name('myTestTheme.product.item-count');

        Route::get('/detailed-products', 'ShopController@getDetailedProducts')
            ->name('myTestTheme.product.details');

        Route::get('/category-products/{categoryId}', 'ShopController@getCategoryProducts')
            ->name('myTestTheme.category.products');
    });
});