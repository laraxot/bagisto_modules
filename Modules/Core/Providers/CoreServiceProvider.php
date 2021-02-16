<?php

namespace Modules\Core\Providers;

use Modules\Core\Core;
use Modules\Core\Exceptions\Handler;
use Modules\Core\Models\SliderProxy;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Modules\Theme\ViewRenderEventManager;
use Illuminate\Support\Facades\Validator;
use Modules\Core\Console\Commands\Install;
use Modules\Core\Observers\SliderObserver;
use Modules\Core\Console\Commands\UpCommand;
use Modules\Core\Facades\Core as CoreFacade;
use Modules\Core\Console\Commands\BookingCron;
use Modules\Core\Console\Commands\DownCommand;
use Modules\Core\View\Compilers\BladeCompiler;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Modules\Core\Console\Commands\BagistoVersion;
use Modules\Core\Console\Commands\ExchangeRateUpdate;
use Illuminate\Database\Eloquent\Factory as EloquentFactory;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function boot()
    {
        include __DIR__ . '/../Http/helpers.php';

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->registerEloquentFactoriesFrom(__DIR__ . '/../Database/Factories');

        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'core');

        Validator::extend('slug', 'Modules\Core\Contracts\Validations\Slug@passes');

        Validator::extend('code', 'Modules\Core\Contracts\Validations\Code@passes');

        Validator::extend('decimal', 'Modules\Core\Contracts\Validations\Decimal@passes');

        $this->publishes([
            dirname(__DIR__) . '/Config/concord.php' => config_path('concord.php'),
            dirname(__DIR__) . '/Config/scout.php' => config_path('scout.php'),
        ]);

        $this->app->bind(
            ExceptionHandler::class,
            Handler::class
        );

        SliderProxy::observe(SliderObserver::class);

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'core');

        Event::listen('bagisto.shop.layout.body.after', static function(ViewRenderEventManager $viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('core::blade.tracer.style');
        });

        Event::listen('bagisto.admin.layout.head', static function(ViewRenderEventManager $viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('core::blade.tracer.style');
        });

        $this->app->extend('command.down', function () {
            return new DownCommand;
        });

        $this->app->extend('command.up', function () {
            return new UpCommand;
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFacades();

        $this->registerCommands();

        $this->registerBladeCompiler();
    }

    /**
     * Register Bouncer as a singleton.
     *
     * @return void
     */
    protected function registerFacades()
    {
        $loader = AliasLoader::getInstance();
        $loader->alias('core', CoreFacade::class);

        $this->app->singleton('core', function () {
            return app()->make(Core::class);
        });
    }

    /**
     * Register the console commands of this package
     *
     * @return void
     */
    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                BagistoVersion::class,
                Install::class,
                ExchangeRateUpdate::class,
                BookingCron::class
            ]);
        }
    }

    /**
     * Register factories.
     *
     * @param string $path
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    protected function registerEloquentFactoriesFrom($path): void
    {
        $this->app->make(EloquentFactory::class)->load($path);
    }

    /**
     * Register the Blade compiler implementation.
     *
     * @return void
     */
    public function registerBladeCompiler()
    {
        $this->app->singleton('blade.compiler', function ($app) {
            return new BladeCompiler($app['files'], $app['config']['view.compiled']);
        });
    }
}
