<?php

Route::group(['middleware' => ['web']], function () {
    Route::prefix(config('app.admin_url') . '/myTestTheme')->group(function () {
        Route::group(['middleware' => ['admin']], function () {
            Route::namespace('Modules\myTestTheme\Http\Controllers\Admin')->group(function () {
                // Content Pages Route
                Route::get('/content', 'ContentController@index')->defaults('_config', [
                    'view' => 'myTestTheme::admin.content.index'
                ])->name('myTestTheme.admin.content.index');

                Route::get('/content/search', 'ContentController@search')->name('myTestTheme.admin.content.search');

                Route::get('/content/create', 'ContentController@create')->defaults('_config',[
                    'view' => 'myTestTheme::admin.content.create'
                ])->name('myTestTheme.admin.content.create');

                Route::post('/content/create', 'ContentController@store')->defaults('_config',[
                    'redirect' => 'myTestTheme.admin.content.index'
                ])->name('myTestTheme.admin.content.store');

                Route::get('/content/edit/{id}', 'ContentController@edit')->defaults('_config',[
                    'view' => 'myTestTheme::admin.content.edit'
                ])->name('myTestTheme.admin.content.edit');

                Route::put('/content/edit/{id}', 'ContentController@update')->defaults('_config', [
                    'redirect' => 'myTestTheme.admin.content.index'
                ])->name('myTestTheme.admin.content.update');

                Route::post('/content/delete/{id}', 'ContentController@destroy')->name('myTestTheme.admin.content.delete');

                Route::post('/content/masssdelete', 'ContentController@massDestroy')->defaults('_config', [
                    'redirect' => 'myTestTheme.admin.content.index'
                ])->name('myTestTheme.admin.content.mass-delete');

                Route::get('/meta-data', 'ConfigurationController@renderMetaData')->defaults('_config', [
                    'view' => 'myTestTheme::admin.meta-info.meta-data'
                ])->name('myTestTheme.admin.meta-data');

                Route::post('/meta-data/{id}', 'ConfigurationController@storeMetaData')->defaults('_config', [
                    'redirect' => 'myTestTheme.admin.meta-data'
                ])->name('myTestTheme.admin.store.meta-data');
            });
        });
    });
});