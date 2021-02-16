<?php

Route::group(['middleware' => ['web']], function () {
    Route::prefix('paypal/standard')->group(function () {
        Route::get('/redirect', 'Modules\Paypal\Http\Controllers\StandardController@redirect')->name('paypal.standard.redirect');

        Route::get('/success', 'Modules\Paypal\Http\Controllers\StandardController@success')->name('paypal.standard.success');

        Route::get('/cancel', 'Modules\Paypal\Http\Controllers\StandardController@cancel')->name('paypal.standard.cancel');
    });

    Route::prefix('paypal/smart-button')->group(function () {
        Route::get('/create-order', 'Modules\Paypal\Http\Controllers\SmartButtonController@createOrder')->name('paypal.smart-button.create-order');

        Route::post('/capture-order', 'Modules\Paypal\Http\Controllers\SmartButtonController@captureOrder')->name('paypal.smart-button.capture-order');
    });
});

Route::get('paypal/standard/ipn', 'Modules\Paypal\Http\Controllers\StandardController@ipn')->name('paypal.standard.ipn');
