<?php

Route::group(['middleware' => ['web']], function () {
    Route::prefix(config('app.admin_url'))->group(function () {

        Route::get('/', 'Modules\Admin\Http\Controllers\Controller@redirectToLogin');

        // Login Routes
        Route::get('/login', 'Modules\User\Http\Controllers\SessionController@create')->defaults('_config', [
            'view' => 'admin::users.sessions.create',
        ])->name('admin.session.create');

        //login post route to admin auth controller
        Route::post('/login', 'Modules\User\Http\Controllers\SessionController@store')->defaults('_config', [
            'redirect' => 'admin.dashboard.index',
        ])->name('admin.session.store');

        // Forget Password Routes
        Route::get('/forget-password', 'Modules\User\Http\Controllers\ForgetPasswordController@create')->defaults('_config', [
            'view' => 'admin::users.forget-password.create',
        ])->name('admin.forget-password.create');

        Route::post('/forget-password', 'Modules\User\Http\Controllers\ForgetPasswordController@store')->name('admin.forget-password.store');

        // Reset Password Routes
        Route::get('/reset-password/{token}', 'Modules\User\Http\Controllers\ResetPasswordController@create')->defaults('_config', [
            'view' => 'admin::users.reset-password.create',
        ])->name('admin.reset-password.create');

        Route::post('/reset-password', 'Modules\User\Http\Controllers\ResetPasswordController@store')->defaults('_config', [
            'redirect' => 'admin.dashboard.index',
        ])->name('admin.reset-password.store');


        // Admin Routes
        Route::group(['middleware' => ['admin']], function () {
            Route::get('/logout', 'Modules\User\Http\Controllers\SessionController@destroy')->defaults('_config', [
                'redirect' => 'admin.session.create',
            ])->name('admin.session.destroy');

            // Dashboard Route
            Route::get('dashboard', 'Modules\Admin\Http\Controllers\DashboardController@index')->defaults('_config', [
                'view' => 'admin::dashboard.index',
            ])->name('admin.dashboard.index');

            //Customer Management Routes
            Route::get('customers', 'Modules\Admin\Http\Controllers\Customer\CustomerController@index')->defaults('_config', [
                'view' => 'admin::customers.index',
            ])->name('admin.customer.index');

            Route::get('customers/create', 'Modules\Admin\Http\Controllers\Customer\CustomerController@create')->defaults('_config', [
                'view' => 'admin::customers.create',
            ])->name('admin.customer.create');

            Route::post('customers/create', 'Modules\Admin\Http\Controllers\Customer\CustomerController@store')->defaults('_config', [
                'redirect' => 'admin.customer.index',
            ])->name('admin.customer.store');

            Route::get('customers/edit/{id}', 'Modules\Admin\Http\Controllers\Customer\CustomerController@edit')->defaults('_config', [
                'view' => 'admin::customers.edit',
            ])->name('admin.customer.edit');

            Route::get('customers/note/{id}', 'Modules\Admin\Http\Controllers\Customer\CustomerController@createNote')->defaults('_config', [
                'view' => 'admin::customers.note',
            ])->name('admin.customer.note.create');

            Route::put('customers/note/{id}', 'Modules\Admin\Http\Controllers\Customer\CustomerController@storeNote')->defaults('_config', [
                'redirect' => 'admin.customer.index',
            ])->name('admin.customer.note.store');

            Route::put('customers/edit/{id}', 'Modules\Admin\Http\Controllers\Customer\CustomerController@update')->defaults('_config', [
                'redirect' => 'admin.customer.index',
            ])->name('admin.customer.update');

            Route::post('customers/delete/{id}', 'Modules\Admin\Http\Controllers\Customer\CustomerController@destroy')->name('admin.customer.delete');

            Route::post('customers/masssdelete', 'Modules\Admin\Http\Controllers\Customer\CustomerController@massDestroy')->name('admin.customer.mass-delete');

            Route::post('customers/masssupdate', 'Modules\Admin\Http\Controllers\Customer\CustomerController@massUpdate')->name('admin.customer.mass-update');

            Route::get('reviews', 'Modules\Product\Http\Controllers\ReviewController@index')->defaults('_config', [
                'view' => 'admin::customers.reviews.index',
            ])->name('admin.customer.review.index');

            //Customer's addresses routes
            Route::get('customers/{id}/addresses', 'Modules\Admin\Http\Controllers\Customer\AddressController@index')->defaults('_config', [
                'view' => 'admin::customers.addresses.index',
            ])->name('admin.customer.addresses.index');

            Route::get('customers/{id}/addresses/create', 'Modules\Admin\Http\Controllers\Customer\AddressController@create')->defaults('_config', [
                'view' => 'admin::customers.addresses.create',
            ])->name('admin.customer.addresses.create');

            Route::post('customers/{id}/addresses/create', 'Modules\Admin\Http\Controllers\Customer\AddressController@store')->defaults('_config', [
                'redirect' => 'admin.customer.addresses.index',
            ])->name('admin.customer.addresses.store');

            Route::get('customers/addresses/edit/{id}', 'Modules\Admin\Http\Controllers\Customer\AddressController@edit')->defaults('_config', [
                'view' => 'admin::customers.addresses.edit',
            ])->name('admin.customer.addresses.edit');

            Route::put('customers/addresses/edit/{id}', 'Modules\Admin\Http\Controllers\Customer\AddressController@update')->defaults('_config', [
                'redirect' => 'admin.customer.addresses.index',
            ])->name('admin.customer.addresses.update');

            Route::post('customers/addresses/delete/{id}', 'Modules\Admin\Http\Controllers\Customer\AddressController@destroy')->defaults('_config', [
                'redirect' => 'admin.customer.addresses.index',
            ])->name('admin.customer.addresses.delete');

            //mass destroy
            Route::post('customers/{id}/addresses', 'Modules\Admin\Http\Controllers\Customer\AddressController@massDestroy')->defaults('_config', [
                'redirect' => 'admin.customer.addresses.index',
            ])->name('admin.customer.addresses.massdelete');

            // Configuration routes
            Route::get('configuration/{slug?}/{slug2?}', 'Modules\Admin\Http\Controllers\ConfigurationController@index')->defaults('_config', [
                'view' => 'admin::configuration.index',
            ])->name('admin.configuration.index');

            Route::post('configuration/{slug?}/{slug2?}', 'Modules\Admin\Http\Controllers\ConfigurationController@store')->defaults('_config', [
                'redirect' => 'admin.configuration.index',
            ])->name('admin.configuration.index.store');

            Route::get('configuration/{slug?}/{slug2?}/{path}', 'Modules\Admin\Http\Controllers\ConfigurationController@download')->defaults('_config', [
                'redirect' => 'admin.configuration.index',
            ])->name('admin.configuration.download');

            // Reviews Routes
            Route::get('reviews/edit/{id}', 'Modules\Product\Http\Controllers\ReviewController@edit')->defaults('_config', [
                'view' => 'admin::customers.reviews.edit',
            ])->name('admin.customer.review.edit');

            Route::put('reviews/edit/{id}', 'Modules\Product\Http\Controllers\ReviewController@update')->defaults('_config', [
                'redirect' => 'admin.customer.review.index',
            ])->name('admin.customer.review.update');

            Route::post('reviews/delete/{id}', 'Modules\Product\Http\Controllers\ReviewController@destroy')->defaults('_config', [
                'redirect' => 'admin.customer.review.index',
            ])->name('admin.customer.review.delete');

            //mass destroy
            Route::post('reviews/massdestroy', 'Modules\Product\Http\Controllers\ReviewController@massDestroy')->defaults('_config', [
                'redirect' => 'admin.customer.review.index',
            ])->name('admin.customer.review.massdelete');

            //mass update
            Route::post('reviews/massupdate', 'Modules\Product\Http\Controllers\ReviewController@massUpdate')->defaults('_config', [
                'redirect' => 'admin.customer.review.index',
            ])->name('admin.customer.review.massupdate');

            // Customer Groups Routes
            Route::get('groups', 'Modules\Admin\Http\Controllers\Customer\CustomerGroupController@index')->defaults('_config', [
                'view' => 'admin::customers.groups.index',
            ])->name('admin.groups.index');

            Route::get('groups/create', 'Modules\Admin\Http\Controllers\Customer\CustomerGroupController@create')->defaults('_config', [
                'view' => 'admin::customers.groups.create',
            ])->name('admin.groups.create');

            Route::post('groups/create', 'Modules\Admin\Http\Controllers\Customer\CustomerGroupController@store')->defaults('_config', [
                'redirect' => 'admin.groups.index',
            ])->name('admin.groups.store');

            Route::get('groups/edit/{id}', 'Modules\Admin\Http\Controllers\Customer\CustomerGroupController@edit')->defaults('_config', [
                'view' => 'admin::customers.groups.edit',
            ])->name('admin.groups.edit');

            Route::put('groups/edit/{id}', 'Modules\Admin\Http\Controllers\Customer\CustomerGroupController@update')->defaults('_config', [
                'redirect' => 'admin.groups.index',
            ])->name('admin.groups.update');

            Route::post('groups/delete/{id}', 'Modules\Admin\Http\Controllers\Customer\CustomerGroupController@destroy')->name('admin.groups.delete');


            // Sales Routes
            Route::prefix('sales')->group(function () {
                // Sales Order Routes
                Route::get('/orders', 'Modules\Admin\Http\Controllers\Sales\OrderController@index')->defaults('_config', [
                    'view' => 'admin::sales.orders.index',
                ])->name('admin.sales.orders.index');

                Route::get('/orders/view/{id}', 'Modules\Admin\Http\Controllers\Sales\OrderController@view')->defaults('_config', [
                    'view' => 'admin::sales.orders.view',
                ])->name('admin.sales.orders.view');

                Route::get('/orders/cancel/{id}', 'Modules\Admin\Http\Controllers\Sales\OrderController@cancel')->defaults('_config', [
                    'view' => 'admin::sales.orders.cancel',
                ])->name('admin.sales.orders.cancel');

                Route::post('/orders/create/{order_id}', 'Modules\Admin\Http\Controllers\Sales\OrderController@comment')->name('admin.sales.orders.comment');


                // Sales Invoices Routes
                Route::get('/invoices', 'Modules\Admin\Http\Controllers\Sales\InvoiceController@index')->defaults('_config', [
                    'view' => 'admin::sales.invoices.index',
                ])->name('admin.sales.invoices.index');

                Route::get('/invoices/create/{order_id}', 'Modules\Admin\Http\Controllers\Sales\InvoiceController@create')->defaults('_config', [
                    'view' => 'admin::sales.invoices.create',
                ])->name('admin.sales.invoices.create');

                Route::post('/invoices/create/{order_id}', 'Modules\Admin\Http\Controllers\Sales\InvoiceController@store')->defaults('_config', [
                    'redirect' => 'admin.sales.orders.view',
                ])->name('admin.sales.invoices.store');

                Route::get('/invoices/view/{id}', 'Modules\Admin\Http\Controllers\Sales\InvoiceController@view')->defaults('_config', [
                    'view' => 'admin::sales.invoices.view',
                ])->name('admin.sales.invoices.view');

                Route::get('/invoices/print/{id}', 'Modules\Admin\Http\Controllers\Sales\InvoiceController@print')->defaults('_config', [
                    'view' => 'admin::sales.invoices.print',
                ])->name('admin.sales.invoices.print');


                // Sales Shipments Routes
                Route::get('/shipments', 'Modules\Admin\Http\Controllers\Sales\ShipmentController@index')->defaults('_config', [
                    'view' => 'admin::sales.shipments.index',
                ])->name('admin.sales.shipments.index');

                Route::get('/shipments/create/{order_id}', 'Modules\Admin\Http\Controllers\Sales\ShipmentController@create')->defaults('_config', [
                    'view' => 'admin::sales.shipments.create',
                ])->name('admin.sales.shipments.create');

                Route::post('/shipments/create/{order_id}', 'Modules\Admin\Http\Controllers\Sales\ShipmentController@store')->defaults('_config', [
                    'redirect' => 'admin.sales.orders.view',
                ])->name('admin.sales.shipments.store');

                Route::get('/shipments/view/{id}', 'Modules\Admin\Http\Controllers\Sales\ShipmentController@view')->defaults('_config', [
                    'view' => 'admin::sales.shipments.view',
                ])->name('admin.sales.shipments.view');


                // Sales Redunds Routes
                Route::get('/refunds', 'Modules\Admin\Http\Controllers\Sales\RefundController@index')->defaults('_config', [
                    'view' => 'admin::sales.refunds.index',
                ])->name('admin.sales.refunds.index');

                Route::get('/refunds/create/{order_id}', 'Modules\Admin\Http\Controllers\Sales\RefundController@create')->defaults('_config', [
                    'view' => 'admin::sales.refunds.create',
                ])->name('admin.sales.refunds.create');

                Route::post('/refunds/create/{order_id}', 'Modules\Admin\Http\Controllers\Sales\RefundController@store')->defaults('_config', [
                    'redirect' => 'admin.sales.orders.view',
                ])->name('admin.sales.refunds.store');

                Route::post('/refunds/update-qty/{order_id}', 'Modules\Admin\Http\Controllers\Sales\RefundController@updateQty')->defaults('_config', [
                    'redirect' => 'admin.sales.orders.view',
                ])->name('admin.sales.refunds.update_qty');

                Route::get('/refunds/view/{id}', 'Modules\Admin\Http\Controllers\Sales\RefundController@view')->defaults('_config', [
                    'view' => 'admin::sales.refunds.view',
                ])->name('admin.sales.refunds.view');
            });

            // Catalog Routes
            Route::prefix('catalog')->group(function () {
                Route::get('/sync', 'Modules\Product\Http\Controllers\ProductController@sync');

                // Catalog Product Routes
                Route::get('/products', 'Modules\Product\Http\Controllers\ProductController@index')->defaults('_config', [
                    'view' => 'admin::catalog.products.index',
                ])->name('admin.catalog.products.index');

                Route::get('/products/create', 'Modules\Product\Http\Controllers\ProductController@create')->defaults('_config', [
                    'view' => 'admin::catalog.products.create',
                ])->name('admin.catalog.products.create');

                Route::post('/products/create', 'Modules\Product\Http\Controllers\ProductController@store')->defaults('_config', [
                    'redirect' => 'admin.catalog.products.edit',
                ])->name('admin.catalog.products.store');

                Route::get('products/copy/{id}', 'Modules\Product\Http\Controllers\ProductController@copy')->defaults('_config', [
                    'view' => 'admin::catalog.products.edit',
                ])->name('admin.catalog.products.copy');

                Route::get('/products/edit/{id}', 'Modules\Product\Http\Controllers\ProductController@edit')->defaults('_config', [
                    'view' => 'admin::catalog.products.edit',
                ])->name('admin.catalog.products.edit');

                Route::put('/products/edit/{id}', 'Modules\Product\Http\Controllers\ProductController@update')->defaults('_config', [
                    'redirect' => 'admin.catalog.products.index',
                ])->name('admin.catalog.products.update');

                Route::post('/products/upload-file/{id}', 'Modules\Product\Http\Controllers\ProductController@uploadLink')->name('admin.catalog.products.upload_link');

                Route::post('/products/upload-sample/{id}', 'Modules\Product\Http\Controllers\ProductController@uploadSample')->name('admin.catalog.products.upload_sample');

                //product delete
                Route::post('/products/delete/{id}', 'Modules\Product\Http\Controllers\ProductController@destroy')->name('admin.catalog.products.delete');

                //product massaction
                Route::post('products/massaction', 'Modules\Product\Http\Controllers\ProductController@massActionHandler')->name('admin.catalog.products.massaction');

                //product massdelete
                Route::post('products/massdelete', 'Modules\Product\Http\Controllers\ProductController@massDestroy')->defaults('_config', [
                    'redirect' => 'admin.catalog.products.index',
                ])->name('admin.catalog.products.massdelete');

                //product massupdate
                Route::post('products/massupdate', 'Modules\Product\Http\Controllers\ProductController@massUpdate')->defaults('_config', [
                    'redirect' => 'admin.catalog.products.index',
                ])->name('admin.catalog.products.massupdate');

                //product search for linked products
                Route::get('products/search', 'Modules\Product\Http\Controllers\ProductController@productLinkSearch')->defaults('_config', [
                    'view' => 'admin::catalog.products.edit',
                ])->name('admin.catalog.products.productlinksearch');

                Route::get('products/search-simple-products', 'Modules\Product\Http\Controllers\ProductController@searchSimpleProducts')->name('admin.catalog.products.search_simple_product');

                Route::get('/products/{id}/{attribute_id}', 'Modules\Product\Http\Controllers\ProductController@download')->defaults('_config', [
                    'view' => 'admin.catalog.products.edit',
                ])->name('admin.catalog.products.file.download');

                // Catalog Category Routes
                Route::get('/categories', 'Modules\Category\Http\Controllers\CategoryController@index')->defaults('_config', [
                    'view' => 'admin::catalog.categories.index',
                ])->name('admin.catalog.categories.index');

                Route::get('/categories/create', 'Modules\Category\Http\Controllers\CategoryController@create')->defaults('_config', [
                    'view' => 'admin::catalog.categories.create',
                ])->name('admin.catalog.categories.create');

                Route::post('/categories/create', 'Modules\Category\Http\Controllers\CategoryController@store')->defaults('_config', [
                    'redirect' => 'admin.catalog.categories.index',
                ])->name('admin.catalog.categories.store');

                Route::get('/categories/edit/{id}', 'Modules\Category\Http\Controllers\CategoryController@edit')->defaults('_config', [
                    'view' => 'admin::catalog.categories.edit',
                ])->name('admin.catalog.categories.edit');

                Route::put('/categories/edit/{id}', 'Modules\Category\Http\Controllers\CategoryController@update')->defaults('_config', [
                    'redirect' => 'admin.catalog.categories.index',
                ])->name('admin.catalog.categories.update');

                Route::post('/categories/delete/{id}', 'Modules\Category\Http\Controllers\CategoryController@destroy')->name('admin.catalog.categories.delete');

                //category massdelete
                Route::post('categories/massdelete', 'Modules\Category\Http\Controllers\CategoryController@massDestroy')->defaults('_config', [
                    'redirect' => 'admin.catalog.categories.index',
                ])->name('admin.catalog.categories.massdelete');

                Route::post('/categories/product/count', 'Modules\Category\Http\Controllers\CategoryController@categoryProductCount')->name('admin.catalog.categories.product.count');


                // Catalog Attribute Routes
                Route::get('/attributes', 'Modules\Attribute\Http\Controllers\AttributeController@index')->defaults('_config', [
                    'view' => 'admin::catalog.attributes.index',
                ])->name('admin.catalog.attributes.index');

                Route::get('/attributes/create', 'Modules\Attribute\Http\Controllers\AttributeController@create')->defaults('_config', [
                    'view' => 'admin::catalog.attributes.create',
                ])->name('admin.catalog.attributes.create');

                Route::post('/attributes/create', 'Modules\Attribute\Http\Controllers\AttributeController@store')->defaults('_config', [
                    'redirect' => 'admin.catalog.attributes.index',
                ])->name('admin.catalog.attributes.store');

                Route::get('/attributes/edit/{id}', 'Modules\Attribute\Http\Controllers\AttributeController@edit')->defaults('_config', [
                    'view' => 'admin::catalog.attributes.edit',
                ])->name('admin.catalog.attributes.edit');

                Route::put('/attributes/edit/{id}', 'Modules\Attribute\Http\Controllers\AttributeController@update')->defaults('_config', [
                    'redirect' => 'admin.catalog.attributes.index',
                ])->name('admin.catalog.attributes.update');

                Route::post('/attributes/delete/{id}', 'Modules\Attribute\Http\Controllers\AttributeController@destroy')->name('admin.catalog.attributes.delete');

                Route::post('/attributes/massdelete', 'Modules\Attribute\Http\Controllers\AttributeController@massDestroy')->name('admin.catalog.attributes.massdelete');

                // Catalog Family Routes
                Route::get('/families', 'Modules\Attribute\Http\Controllers\AttributeFamilyController@index')->defaults('_config', [
                    'view' => 'admin::catalog.families.index',
                ])->name('admin.catalog.families.index');

                Route::get('/families/create', 'Modules\Attribute\Http\Controllers\AttributeFamilyController@create')->defaults('_config', [
                    'view' => 'admin::catalog.families.create',
                ])->name('admin.catalog.families.create');

                Route::post('/families/create', 'Modules\Attribute\Http\Controllers\AttributeFamilyController@store')->defaults('_config', [
                    'redirect' => 'admin.catalog.families.index',
                ])->name('admin.catalog.families.store');

                Route::get('/families/edit/{id}', 'Modules\Attribute\Http\Controllers\AttributeFamilyController@edit')->defaults('_config', [
                    'view' => 'admin::catalog.families.edit',
                ])->name('admin.catalog.families.edit');

                Route::put('/families/edit/{id}', 'Modules\Attribute\Http\Controllers\AttributeFamilyController@update')->defaults('_config', [
                    'redirect' => 'admin.catalog.families.index',
                ])->name('admin.catalog.families.update');

                Route::post('/families/delete/{id}', 'Modules\Attribute\Http\Controllers\AttributeFamilyController@destroy')->name('admin.catalog.families.delete');
            });

            // User Routes
            //datagrid for backend users
            Route::get('/users', 'Modules\User\Http\Controllers\UserController@index')->defaults('_config', [
                'view' => 'admin::users.users.index',
            ])->name('admin.users.index');

            //create backend user get
            Route::get('/users/create', 'Modules\User\Http\Controllers\UserController@create')->defaults('_config', [
                'view' => 'admin::users.users.create',
            ])->name('admin.users.create');

            //create backend user post
            Route::post('/users/create', 'Modules\User\Http\Controllers\UserController@store')->defaults('_config', [
                'redirect' => 'admin.users.index',
            ])->name('admin.users.store');

            //delete backend user view
            Route::get('/users/edit/{id}', 'Modules\User\Http\Controllers\UserController@edit')->defaults('_config', [
                'view' => 'admin::users.users.edit',
            ])->name('admin.users.edit');

            //edit backend user submit
            Route::put('/users/edit/{id}', 'Modules\User\Http\Controllers\UserController@update')->defaults('_config', [
                'redirect' => 'admin.users.index',
            ])->name('admin.users.update');

            //delete backend user
            Route::post('/users/delete/{id}', 'Modules\User\Http\Controllers\UserController@destroy')->name('admin.users.delete');

            Route::get('/users/confirm/{id}', 'Modules\User\Http\Controllers\UserController@confirm')->defaults('_config', [
                'view' => 'admin::customers.confirm-password',
            ])->name('super.users.confirm');

            Route::post('/users/confirm/{id}', 'Modules\User\Http\Controllers\UserController@destroySelf')->defaults('_config', [
                'redirect' => 'admin.users.index',
            ])->name('admin.users.destroy');

            // User Role Routes
            Route::get('/roles', 'Modules\User\Http\Controllers\RoleController@index')->defaults('_config', [
                'view' => 'admin::users.roles.index',
            ])->name('admin.roles.index');

            Route::get('/roles/create', 'Modules\User\Http\Controllers\RoleController@create')->defaults('_config', [
                'view' => 'admin::users.roles.create',
            ])->name('admin.roles.create');

            Route::post('/roles/create', 'Modules\User\Http\Controllers\RoleController@store')->defaults('_config', [
                'redirect' => 'admin.roles.index',
            ])->name('admin.roles.store');

            Route::get('/roles/edit/{id}', 'Modules\User\Http\Controllers\RoleController@edit')->defaults('_config', [
                'view' => 'admin::users.roles.edit',
            ])->name('admin.roles.edit');

            Route::put('/roles/edit/{id}', 'Modules\User\Http\Controllers\RoleController@update')->defaults('_config', [
                'redirect' => 'admin.roles.index',
            ])->name('admin.roles.update');

            Route::post('/roles/delete/{id}', 'Modules\User\Http\Controllers\RoleController@destroy')->name('admin.roles.delete');


            // Locale Routes
            Route::get('/locales', 'Modules\Core\Http\Controllers\LocaleController@index')->defaults('_config', [
                'view' => 'admin::settings.locales.index',
            ])->name('admin.locales.index');

            Route::get('/locales/create', 'Modules\Core\Http\Controllers\LocaleController@create')->defaults('_config', [
                'view' => 'admin::settings.locales.create',
            ])->name('admin.locales.create');

            Route::post('/locales/create', 'Modules\Core\Http\Controllers\LocaleController@store')->defaults('_config', [
                'redirect' => 'admin.locales.index',
            ])->name('admin.locales.store');

            Route::get('/locales/edit/{id}', 'Modules\Core\Http\Controllers\LocaleController@edit')->defaults('_config', [
                'view' => 'admin::settings.locales.edit',
            ])->name('admin.locales.edit');

            Route::put('/locales/edit/{id}', 'Modules\Core\Http\Controllers\LocaleController@update')->defaults('_config', [
                'redirect' => 'admin.locales.index',
            ])->name('admin.locales.update');

            Route::post('/locales/delete/{id}', 'Modules\Core\Http\Controllers\LocaleController@destroy')->name('admin.locales.delete');


            // Currency Routes
            Route::get('/currencies', 'Modules\Core\Http\Controllers\CurrencyController@index')->defaults('_config', [
                'view' => 'admin::settings.currencies.index',
            ])->name('admin.currencies.index');

            Route::get('/currencies/create', 'Modules\Core\Http\Controllers\CurrencyController@create')->defaults('_config', [
                'view' => 'admin::settings.currencies.create',
            ])->name('admin.currencies.create');

            Route::post('/currencies/create', 'Modules\Core\Http\Controllers\CurrencyController@store')->defaults('_config', [
                'redirect' => 'admin.currencies.index',
            ])->name('admin.currencies.store');

            Route::get('/currencies/edit/{id}', 'Modules\Core\Http\Controllers\CurrencyController@edit')->defaults('_config', [
                'view' => 'admin::settings.currencies.edit',
            ])->name('admin.currencies.edit');

            Route::put('/currencies/edit/{id}', 'Modules\Core\Http\Controllers\CurrencyController@update')->defaults('_config', [
                'redirect' => 'admin.currencies.index',
            ])->name('admin.currencies.update');

            Route::post('/currencies/delete/{id}', 'Modules\Core\Http\Controllers\CurrencyController@destroy')->name('admin.currencies.delete');

            Route::post('/currencies/massdelete', 'Modules\Core\Http\Controllers\CurrencyController@massDestroy')->name('admin.currencies.massdelete');


            // Exchange Rates Routes
            Route::get('/exchange_rates', 'Modules\Core\Http\Controllers\ExchangeRateController@index')->defaults('_config', [
                'view' => 'admin::settings.exchange_rates.index',
            ])->name('admin.exchange_rates.index');

            Route::get('/exchange_rates/create', 'Modules\Core\Http\Controllers\ExchangeRateController@create')->defaults('_config', [
                'view' => 'admin::settings.exchange_rates.create',
            ])->name('admin.exchange_rates.create');

            Route::post('/exchange_rates/create', 'Modules\Core\Http\Controllers\ExchangeRateController@store')->defaults('_config', [
                'redirect' => 'admin.exchange_rates.index',
            ])->name('admin.exchange_rates.store');

            Route::get('/exchange_rates/edit/{id}', 'Modules\Core\Http\Controllers\ExchangeRateController@edit')->defaults('_config', [
                'view' => 'admin::settings.exchange_rates.edit',
            ])->name('admin.exchange_rates.edit');

            Route::get('/exchange_rates/update-rates', 'Modules\Core\Http\Controllers\ExchangeRateController@updateRates')->name('admin.exchange_rates.update_rates');

            Route::put('/exchange_rates/edit/{id}', 'Modules\Core\Http\Controllers\ExchangeRateController@update')->defaults('_config', [
                'redirect' => 'admin.exchange_rates.index',
            ])->name('admin.exchange_rates.update');

            Route::post('/exchange_rates/delete/{id}', 'Modules\Core\Http\Controllers\ExchangeRateController@destroy')->name('admin.exchange_rates.delete');


            // Inventory Source Routes
            Route::get('/inventory_sources', 'Modules\Inventory\Http\Controllers\InventorySourceController@index')->defaults('_config', [
                'view' => 'admin::settings.inventory_sources.index',
            ])->name('admin.inventory_sources.index');

            Route::get('/inventory_sources/create', 'Modules\Inventory\Http\Controllers\InventorySourceController@create')->defaults('_config', [
                'view' => 'admin::settings.inventory_sources.create',
            ])->name('admin.inventory_sources.create');

            Route::post('/inventory_sources/create', 'Modules\Inventory\Http\Controllers\InventorySourceController@store')->defaults('_config', [
                'redirect' => 'admin.inventory_sources.index',
            ])->name('admin.inventory_sources.store');

            Route::get('/inventory_sources/edit/{id}', 'Modules\Inventory\Http\Controllers\InventorySourceController@edit')->defaults('_config', [
                'view' => 'admin::settings.inventory_sources.edit',
            ])->name('admin.inventory_sources.edit');

            Route::put('/inventory_sources/edit/{id}', 'Modules\Inventory\Http\Controllers\InventorySourceController@update')->defaults('_config', [
                'redirect' => 'admin.inventory_sources.index',
            ])->name('admin.inventory_sources.update');

            Route::post('/inventory_sources/delete/{id}', 'Modules\Inventory\Http\Controllers\InventorySourceController@destroy')->name('admin.inventory_sources.delete');

            // Channel Routes
            Route::get('/channels', 'Modules\Core\Http\Controllers\ChannelController@index')->defaults('_config', [
                'view' => 'admin::settings.channels.index',
            ])->name('admin.channels.index');

            Route::get('/channels/create', 'Modules\Core\Http\Controllers\ChannelController@create')->defaults('_config', [
                'view' => 'admin::settings.channels.create',
            ])->name('admin.channels.create');

            Route::post('/channels/create', 'Modules\Core\Http\Controllers\ChannelController@store')->defaults('_config', [
                'redirect' => 'admin.channels.index',
            ])->name('admin.channels.store');

            Route::get('/channels/edit/{id}', 'Modules\Core\Http\Controllers\ChannelController@edit')->defaults('_config', [
                'view' => 'admin::settings.channels.edit',
            ])->name('admin.channels.edit');

            Route::put('/channels/edit/{id}', 'Modules\Core\Http\Controllers\ChannelController@update')->defaults('_config', [
                'redirect' => 'admin.channels.index',
            ])->name('admin.channels.update');

            Route::post('/channels/delete/{id}', 'Modules\Core\Http\Controllers\ChannelController@destroy')->name('admin.channels.delete');


            // Admin Profile route
            Route::get('/account', 'Modules\User\Http\Controllers\AccountController@edit')->defaults('_config', [
                'view' => 'admin::account.edit',
            ])->name('admin.account.edit');

            Route::put('/account', 'Modules\User\Http\Controllers\AccountController@update')->name('admin.account.update');

            //slider index
            Route::get('/slider', 'Modules\Core\Http\Controllers\SliderController@index')->defaults('_config', [
                'view' => 'admin::settings.sliders.index',
            ])->name('admin.sliders.index');

            //slider create show
            Route::get('slider/create', 'Modules\Core\Http\Controllers\SliderController@create')->defaults('_config', [
                'view' => 'admin::settings.sliders.create',
            ])->name('admin.sliders.create');

            //slider create show
            Route::post('slider/create', 'Modules\Core\Http\Controllers\SliderController@store')->defaults('_config', [
                'redirect' => 'admin.sliders.index',
            ])->name('admin.sliders.store');

            //slider edit show
            Route::get('slider/edit/{id}', 'Modules\Core\Http\Controllers\SliderController@edit')->defaults('_config', [
                'view' => 'admin::settings.sliders.edit',
            ])->name('admin.sliders.edit');

            //slider edit update
            Route::post('slider/edit/{id}', 'Modules\Core\Http\Controllers\SliderController@update')->defaults('_config', [
                'redirect' => 'admin.sliders.index',
            ])->name('admin.sliders.update');

            //destroy a slider item
            Route::post('slider/delete/{id}', 'Modules\Core\Http\Controllers\SliderController@destroy')->name('admin.sliders.delete');

            //tax routes
            Route::get('/tax-categories', 'Modules\Tax\Http\Controllers\TaxController@index')->defaults('_config', [
                'view' => 'admin::tax.tax-categories.index',
            ])->name('admin.tax-categories.index');


            // tax category routes
            Route::get('/tax-categories/create', 'Modules\Tax\Http\Controllers\TaxCategoryController@show')->defaults('_config', [
                'view' => 'admin::tax.tax-categories.create',
            ])->name('admin.tax-categories.create');

            Route::post('/tax-categories/create', 'Modules\Tax\Http\Controllers\TaxCategoryController@create')->defaults('_config', [
                'redirect' => 'admin.tax-categories.index',
            ])->name('admin.tax-categories.store');

            Route::get('/tax-categories/edit/{id}', 'Modules\Tax\Http\Controllers\TaxCategoryController@edit')->defaults('_config', [
                'view' => 'admin::tax.tax-categories.edit',
            ])->name('admin.tax-categories.edit');

            Route::put('/tax-categories/edit/{id}', 'Modules\Tax\Http\Controllers\TaxCategoryController@update')->defaults('_config', [
                'redirect' => 'admin.tax-categories.index',
            ])->name('admin.tax-categories.update');

            Route::post('/tax-categories/delete/{id}', 'Modules\Tax\Http\Controllers\TaxCategoryController@destroy')->name('admin.tax-categories.delete');
            //tax category ends


            //tax rate
            Route::get('tax-rates', 'Modules\Tax\Http\Controllers\TaxRateController@index')->defaults('_config', [
                'view' => 'admin::tax.tax-rates.index',
            ])->name('admin.tax-rates.index');

            Route::get('tax-rates/create', 'Modules\Tax\Http\Controllers\TaxRateController@show')->defaults('_config', [
                'view' => 'admin::tax.tax-rates.create',
            ])->name('admin.tax-rates.create');

            Route::post('tax-rates/create', 'Modules\Tax\Http\Controllers\TaxRateController@create')->defaults('_config', [
                'redirect' => 'admin.tax-rates.index',
            ])->name('admin.tax-rates.store');

            Route::get('tax-rates/edit/{id}', 'Modules\Tax\Http\Controllers\TaxRateController@edit')->defaults('_config', [
                'view' => 'admin::tax.tax-rates.edit',
            ])->name('admin.tax-rates.edit');

            Route::put('tax-rates/update/{id}', 'Modules\Tax\Http\Controllers\TaxRateController@update')->defaults('_config', [
                'redirect' => 'admin.tax-rates.index',
            ])->name('admin.tax-rates.update');

            Route::post('/tax-rates/delete/{id}', 'Modules\Tax\Http\Controllers\TaxRateController@destroy')->name('admin.tax-rates.delete');

            Route::post('/tax-rates/import', 'Modules\Tax\Http\Controllers\TaxRateController@import')->defaults('_config', [
                'redirect' => 'admin.tax-rates.index',
            ])->name('admin.tax-rates.import');
            //tax rate ends

            //DataGrid Export
            Route::post(config('app.admin_url') . '/export', 'Modules\Admin\Http\Controllers\ExportController@export')->name('admin.datagrid.export');

            Route::prefix('promotions')->group(function () {
                Route::get('cart-rules', 'Modules\CartRule\Http\Controllers\CartRuleController@index')->defaults('_config', [
                    'view' => 'admin::marketing.promotions.cart-rules.index',
                ])->name('admin.cart-rules.index');

                Route::get('cart-rules/create', 'Modules\CartRule\Http\Controllers\CartRuleController@create')->defaults('_config', [
                    'view' => 'admin::marketing.promotions.cart-rules.create',
                ])->name('admin.cart-rules.create');

                Route::post('cart-rules/create', 'Modules\CartRule\Http\Controllers\CartRuleController@store')->defaults('_config', [
                    'redirect' => 'admin.cart-rules.index',
                ])->name('admin.cart-rules.store');

                Route::get('cart-rules/copy/{id}', 'Modules\CartRule\Http\Controllers\CartRuleController@copy')->defaults('_config', [
                    'view' => 'admin::marketing.promotions.cart-rules.edit',
                ])->name('admin.cart-rules.copy');

                Route::get('cart-rules/edit/{id}', 'Modules\CartRule\Http\Controllers\CartRuleController@edit')->defaults('_config', [
                    'view' => 'admin::marketing.promotions.cart-rules.edit',
                ])->name('admin.cart-rules.edit');

                Route::post('cart-rules/edit/{id}', 'Modules\CartRule\Http\Controllers\CartRuleController@update')->defaults('_config', [
                    'redirect' => 'admin.cart-rules.index',
                ])->name('admin.cart-rules.update');

                Route::post('cart-rules/delete/{id}', 'Modules\CartRule\Http\Controllers\CartRuleController@destroy')->name('admin.cart-rules.delete');

                Route::post('cart-rules/generate-coupons/{id?}', 'Modules\CartRule\Http\Controllers\CartRuleController@generateCoupons')->name('admin.cart-rules.generate-coupons');

                Route::post('/massdelete', 'Modules\CartRule\Http\Controllers\CartRuleCouponController@massDelete')->name('admin.cart-rule-coupons.mass-delete');


                //Catalog rules
                Route::get('catalog-rules', 'Modules\CatalogRule\Http\Controllers\CatalogRuleController@index')->defaults('_config', [
                    'view' => 'admin::marketing.promotions.catalog-rules.index',
                ])->name('admin.catalog-rules.index');

                Route::get('catalog-rules/create', 'Modules\CatalogRule\Http\Controllers\CatalogRuleController@create')->defaults('_config', [
                    'view' => 'admin::marketing.promotions.catalog-rules.create',
                ])->name('admin.catalog-rules.create');

                Route::post('catalog-rules/create', 'Modules\CatalogRule\Http\Controllers\CatalogRuleController@store')->defaults('_config', [
                    'redirect' => 'admin.catalog-rules.index',
                ])->name('admin.catalog-rules.store');

                Route::get('catalog-rules/edit/{id}', 'Modules\CatalogRule\Http\Controllers\CatalogRuleController@edit')->defaults('_config', [
                    'view' => 'admin::marketing.promotions.catalog-rules.edit',
                ])->name('admin.catalog-rules.edit');

                Route::post('catalog-rules/edit/{id}', 'Modules\CatalogRule\Http\Controllers\CatalogRuleController@update')->defaults('_config', [
                    'redirect' => 'admin.catalog-rules.index',
                ])->name('admin.catalog-rules.update');

                Route::post('catalog-rules/delete/{id}', 'Modules\CatalogRule\Http\Controllers\CatalogRuleController@destroy')->name('admin.catalog-rules.delete');


                //Marketing campaigns routes
                Route::get('campaigns', 'Modules\Marketing\Http\Controllers\CampaignController@index')->defaults('_config', [
                    'view' => 'admin::marketing.email-marketing.campaigns.index',
                ])->name('admin.campaigns.index');

                Route::get('campaigns/create', 'Modules\Marketing\Http\Controllers\CampaignController@create')->defaults('_config', [
                    'view' => 'admin::marketing.email-marketing.campaigns.create',
                ])->name('admin.campaigns.create');

                Route::post('campaigns/create', 'Modules\Marketing\Http\Controllers\CampaignController@store')->defaults('_config', [
                    'redirect' => 'admin.campaigns.index',
                ])->name('admin.campaigns.store');

                Route::get('campaigns/edit/{id}', 'Modules\Marketing\Http\Controllers\CampaignController@edit')->defaults('_config', [
                    'view' => 'admin::marketing.email-marketing.campaigns.edit',
                ])->name('admin.campaigns.edit');

                Route::post('campaigns/edit/{id}', 'Modules\Marketing\Http\Controllers\CampaignController@update')->defaults('_config', [
                    'redirect' => 'admin.campaigns.index',
                ])->name('admin.campaigns.update');

                Route::post('campaigns/delete/{id}', 'Modules\Marketing\Http\Controllers\CampaignController@destroy')->name('admin.campaigns.delete');


                //Marketing emails templates routes
                Route::get('email-templates', 'Modules\Marketing\Http\Controllers\TemplateController@index')->defaults('_config', [
                    'view' => 'admin::marketing.email-marketing.templates.index',
                ])->name('admin.email-templates.index');

                Route::get('email-templates/create', 'Modules\Marketing\Http\Controllers\TemplateController@create')->defaults('_config', [
                    'view' => 'admin::marketing.email-marketing.templates.create',
                ])->name('admin.email-templates.create');

                Route::post('email-templates/create', 'Modules\Marketing\Http\Controllers\TemplateController@store')->defaults('_config', [
                    'redirect' => 'admin.email-templates.index',
                ])->name('admin.email-templates.store');

                Route::get('email-templates/edit/{id}', 'Modules\Marketing\Http\Controllers\TemplateController@edit')->defaults('_config', [
                    'view' => 'admin::marketing.email-marketing.templates.edit',
                ])->name('admin.email-templates.edit');

                Route::post('email-templates/edit/{id}', 'Modules\Marketing\Http\Controllers\TemplateController@update')->defaults('_config', [
                    'redirect' => 'admin.email-templates.index',
                ])->name('admin.email-templates.update');

                Route::post('email-templates/delete/{id}', 'Modules\Marketing\Http\Controllers\TemplateController@destroy')->name('admin.email-templates.delete');


                //Marketing events routes
                Route::get('events', 'Modules\Marketing\Http\Controllers\EventController@index')->defaults('_config', [
                    'view' => 'admin::marketing.email-marketing.events.index',
                ])->name('admin.events.index');

                Route::get('events/create', 'Modules\Marketing\Http\Controllers\EventController@create')->defaults('_config', [
                    'view' => 'admin::marketing.email-marketing.events.create',
                ])->name('admin.events.create');

                Route::post('events/create', 'Modules\Marketing\Http\Controllers\EventController@store')->defaults('_config', [
                    'redirect' => 'admin.events.index',
                ])->name('admin.events.store');

                Route::get('events/edit/{id}', 'Modules\Marketing\Http\Controllers\EventController@edit')->defaults('_config', [
                    'view' => 'admin::marketing.email-marketing.events.edit',
                ])->name('admin.events.edit');

                Route::post('events/edit/{id}', 'Modules\Marketing\Http\Controllers\EventController@update')->defaults('_config', [
                    'redirect' => 'admin.events.index',
                ])->name('admin.events.update');

                Route::post('events/delete/{id}', 'Modules\Marketing\Http\Controllers\EventController@destroy')->name('admin.events.delete');


                // Admin Store Front Settings Route
                Route::get('/subscribers', 'Modules\Core\Http\Controllers\SubscriptionController@index')->defaults('_config', [
                    'view' => 'admin::marketing.email-marketing.subscribers.index',
                ])->name('admin.customers.subscribers.index');

                //destroy a newsletter subscription item
                Route::post('subscribers/delete/{id}', 'Modules\Core\Http\Controllers\SubscriptionController@destroy')->name('admin.customers.subscribers.delete');

                Route::get('subscribers/edit/{id}', 'Modules\Core\Http\Controllers\SubscriptionController@edit')->defaults('_config', [
                    'view' => 'admin::marketing.email-marketing.subscribers.edit',
                ])->name('admin.customers.subscribers.edit');

                Route::put('subscribers/update/{id}', 'Modules\Core\Http\Controllers\SubscriptionController@update')->defaults('_config', [
                    'redirect' => 'admin.customers.subscribers.index',
                ])->name('admin.customers.subscribers.update');
            });

            Route::prefix('cms')->group(function () {
                Route::get('/', 'Modules\CMS\Http\Controllers\Admin\PageController@index')->defaults('_config', [
                    'view' => 'admin::cms.index',
                ])->name('admin.cms.index');


                Route::get('create', 'Modules\CMS\Http\Controllers\Admin\PageController@create')->defaults('_config', [
                    'view' => 'admin::cms.create',
                ])->name('admin.cms.create');

                Route::post('create', 'Modules\CMS\Http\Controllers\Admin\PageController@store')->defaults('_config', [
                    'redirect' => 'admin.cms.index',
                ])->name('admin.cms.store');

                Route::get('edit/{id}', 'Modules\CMS\Http\Controllers\Admin\PageController@edit')->defaults('_config', [
                    'view' => 'admin::cms.edit',
                ])->name('admin.cms.edit');

                Route::post('edit/{id}', 'Modules\CMS\Http\Controllers\Admin\PageController@update')->defaults('_config', [
                    'redirect' => 'admin.cms.index',
                ])->name('admin.cms.update');

                Route::post('/delete/{id}', 'Modules\CMS\Http\Controllers\Admin\PageController@delete')->defaults('_config', [
                    'redirect' => 'admin.cms.index',
                ])->name('admin.cms.delete');

                Route::post('/massdelete', 'Modules\CMS\Http\Controllers\Admin\PageController@massDelete')->defaults('_config', [
                    'redirect' => 'admin.cms.index',
                ])->name('admin.cms.mass-delete');

                // Route::post('/delete/{id}', 'Modules\CMS\Http\Controllers\Admin\PageController@delete')->defaults('_config', [
                //     'redirect' => 'admin.cms.index'
                // ])->name('admin.cms.delete');
            });
        });
    });
});
