<?php

namespace Modules\Product\Providers;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;
use Illuminate\Support\ServiceProvider;
use Modules\Product\Models\ProductProxy;
use Modules\Product\Observers\ProductObserver;
use Modules\Product\Console\Commands\PriceUpdate;
use Modules\Product\Console\Commands\GenerateProducts;
use Illuminate\Foundation\AliasLoader;
use Modules\Product\Facades\ProductImage as ProductImageFacade;
use Modules\Product\Facades\ProductVideo as ProductVideoFacade;
use Modules\Product\ProductImage;
use Modules\Product\ProductVideo;

class ProductServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__ . '/../Http/helpers.php';

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->app->make(EloquentFactory::class)->load(__DIR__ . '/../Database/Factories');

        $this->app->register(EventServiceProvider::class);

        $this->publishes([
            dirname(__DIR__) . '/Config/imagecache.php' => config_path('imagecache.php'),
        ]);

        ProductProxy::observe(ProductObserver::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerConfig();

        $this->registerCommands();

        $this->registerFacades();

        $this->registerEloquentFactoriesFrom(__DIR__ . '/../Database/Factories');
    }

    /**
     * Register Configuration
     *
     * @return void
     */
    public function registerConfig(): void
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/product_types.php', 'product_types'
        );
    }

    /**
     * Register the console commands of this package
     *
     * @return void
     */
    protected function registerCommands(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([PriceUpdate::class, GenerateProducts::class,]);
        }
    }

    /**
     * Register factories.
     *
     * @param  string  $path
     * @return void
     */
    protected function registerEloquentFactoriesFrom($path): void
    {
        $this->app->make(EloquentFactory::class)->load($path);
    }


    /**
     * Register Bouncer as a singleton.
     *
     * @return void
     */
    protected function registerFacades()
    {
        // Product image
        $loader = AliasLoader::getInstance();
        $loader->alias('productimage', ProductImageFacade::class);

        $this->app->singleton('productimage', function () {
            return app()->make(ProductImage::class);
        });

        // Product video
        $loader->alias('productvideo', ProductVideoFacade::class);

        $this->app->singleton('productvideo', function () {
            return app()->make(ProductVideo::class);
        });
    }
}