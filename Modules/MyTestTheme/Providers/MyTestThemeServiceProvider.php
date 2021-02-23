<?php

namespace Modules\MyTestTheme\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Modules\myTestTheme\Facades\MyTestTheme as myTestThemeFacade;

class MyTestThemeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        /*
        include __DIR__ . '/../Http/helpers.php';

        include __DIR__ . '/../Http/admin-routes.php';

        include __DIR__ . '/../Http/front-routes.php';

        $this->app->register(EventServiceProvider::class);

        $this->loadGloableVariables();

        $this->loadPublishableAssets();

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'myTestTheme');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'myTestTheme');
        */
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /*
        $this->registerConfig();

        $this->registerFacades();
        */
    }

    /**
     * Register package config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/admin-menu.php',
            'menu.admin'
        );

        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/acl.php',
            'acl'
        );
    }

    /**
     * Register Bouncer as a singleton.
     *
     * @return void
     */
    protected function registerFacades()
    {
        $loader = AliasLoader::getInstance();

        $loader->alias('myTestTheme', myTestThemeFacade::class);
    }

    /**
     * This method will load all publishables.
     *
     * @return boolean
     */
    private function loadPublishableAssets()
    {
        $this->publishes([
            __DIR__ . '/../../publishable/assets/' => public_path('themes/myTestTheme/assets'),
        ], 'public');

        $this->publishes([
            __DIR__ . '/../Resources/views/shop' => resource_path('themes/myTestTheme/views'),
        ]);

        $this->publishes([__DIR__.'/../Resources/lang' => resource_path('lang/vendor/myTestTheme')]);

        return true;
    }

    /**
     * This method will provide global variables shared by view (blade files).
     *
     * @return boolean
     */
    private function loadGloableVariables()
    {
        view()->composer('*', function ($view) {
            $myTestThemeHelper = app('Modules\myTestTheme\Helpers\Helper');
            $myTestThemeMetaData = $myTestThemeHelper->getmyTestThemeMetaData();

            $view->with('showRecentlyViewed', true);
            $view->with('myTestThemeMetaData', $myTestThemeMetaData);
        });

        return true;
    }
}