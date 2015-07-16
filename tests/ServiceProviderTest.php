<?php

/*
 * This file is part of StyleCI.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Tests\Cache;

use GrahamCampbell\TestBench\AbstractPackageTestCase;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;
use StyleCI\Cache\CacheResolver;
use StyleCI\Cache\CacheServiceProvider;
use StyleCI\Cache\Adapters\AdapterInterface;
use StyleCI\Cache\Adapters\IlluminateAdapter;

/**
 * This is the service provider test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class ServiceProviderTest extends AbstractPackageTestCase
{
    use ServiceProviderTrait;

    protected function getServiceProviderClass($app)
    {
        return CacheServiceProvider::class;
    }

    public function testAdapterIsInjectable()
    {
        $this->assertIsInjectable(AdapterInterface::class);
        $this->assertIsInjectable(IlluminateAdapter::class);
    }

    public function testResolverIsAlwaysDifferent()
    {
        $this->assertIsInjectable(CacheResolver::class);
    }
}
