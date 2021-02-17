<?php

Route::group(['middleware' => ['web', 'locale', 'theme', 'currency']], function () {
    Route::prefix('customer/account/gdpr')->group(function () {
        Route::namespace('Modules\GDPR\Http\Controllers\Customer')->group(function () {
            try {
                $data = DB::table('gdpr')->get();
                if (1 == $data['0']->gdpr_status) {
                    Route::get('/', 'CustomerController@index')->defaults('_config', [
                        'view' => 'gdpr::shop.customers.gdpr.index',
                    ])->name('gdpr.customers.allgdpr');
                } else {
                    Route::get('/', 'CustomerController@index')->defaults('_config', [
                        'view' => 'shop::errors.404',
                    ])->name('gdpr.customers.allgdpr');
                }
            } catch (\Exception $e) {
                Route::get('/', 'CustomerController@index')->defaults('_config', [
                    'view' => 'shop::errors.404',
                ])->name('gdpr.customers.allgdpr');
            }

            Route::post('/store', 'CustomerController@store')->defaults('_config', [
                'redirect' => 'gdpr.customers.allgdpr',
            ])->name('gdpr.customer.store');

            Route::get('/pdfview', 'CustomerController@pdfview')->defaults('_config', [
                'view' => 'gdpr::shop.customers.gdpr.pdfview',
            ])->name('gdpr.customers.pdfview');

            Route::get('/htmlview', 'CustomerController@htmlview')->defaults('_config', [
                'view' => 'gdpr::shop.customers.gdpr.pdfview',
            ])->name('gdpr.customers.htmlview');
        });
    });
});