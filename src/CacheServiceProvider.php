<?php

/*
 * This file is part of StyleCI.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Cache;

use Illuminate\Support\ServiceProvider;
use StyleCI\Cache\Adapters\AdapterInterface;
use StyleCI\Cache\Adapters\IlluminateAdapter;

/**
 * This is the cache service provider class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class CacheServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAdapter();
        $this->registerResolver();
    }

    /**
     * Register the adapter class.
     *
     * @return void
     */
    protected function registerAdapter()
    {
        $this->app->bind('cache.adapter', function ($app) {
            $cache = $app['cache.store'];
            $time = 60 * 24 * 14;

            return new IlluminateAdapter($cache, $time);
        });

        $this->app->alias('cache.adapter', AdapterInterface::class);
        $this->app->alias('cache.adapter', IlluminateAdapter::class);
    }

    /**
     * Register the cache resolver class.
     *
     * @return void
     */
    protected function registerResolver()
    {
        $this->app->singleton('cache.resolver', function ($app) {
            $adapter = $app['cache.adapter'];
            $path = $app['path.storage'].'/analysis-cache';

            return new CacheResolver($adapter, $path);
        });

        $this->app->alias('cache.resolver', CacheResolver::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'cache.adapter',
            'cache.resolver',
        ];
    }
}
