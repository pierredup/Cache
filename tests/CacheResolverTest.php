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

use GrahamCampbell\TestBench\AbstractTestCase;
use Mockery;
use StyleCI\Cache\Adapters\AdapterInterface;
use StyleCI\Cache\CacheResolver;

/**
 * This is the cache resolver case class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class CacheResolverTest extends AbstractTestCase
{
    protected static $path;

    /**
     * @beforeClass
     */
    public static function setUpStoragePath()
    {
        static::$path = __DIR__.'/analysis-cache';
    }

    /**
     * @before
     */
    public function setUpStorage()
    {
        @unlink(static::$path);
    }

    /**
     * @after
     */
    public function tearDownStorage()
    {
        @unlink(static::$path);
    }

    public function testSetUpBasic()
    {
        $resolver = new CacheResolver($adapter = Mockery::mock(AdapterInterface::class), static::$path);

        $adapter->shouldReceive('get')->once()->with(123, 'pr.12')->andReturn('data');

        $resolver->setUp(123, 'pr.12', 'branch.master');

        $this->assertSame('data', file_get_contents(static::$path));
    }

    public function testSetUpFallback()
    {
        $resolver = new CacheResolver($adapter = Mockery::mock(AdapterInterface::class), static::$path);

        $adapter->shouldReceive('get')->once()->with(246, 'branch.foo')->andReturn(null);
        $adapter->shouldReceive('get')->once()->with(246, 'branch.bar')->andReturn('stuffs');

        $resolver->setUp(246, 'branch.foo', 'branch.bar');

        $this->assertSame('stuffs', file_get_contents(static::$path));
    }

    public function testTearDown()
    {
        $resolver = new CacheResolver($adapter = Mockery::mock(AdapterInterface::class), static::$path);

        file_put_contents(static::$path, 'trololol');

        $adapter->shouldReceive('put')->once()->with(1234, 'branch.master', 'trololol');

        $resolver->tearDown(1234, 'branch.master');
    }

    public function testFlush()
    {
        $resolver = new CacheResolver($adapter = Mockery::mock(AdapterInterface::class), static::$path);

        $adapter->shouldReceive('flush')->once()->with(12, 'pr.12345');

        $resolver->flush(12, 'pr.12345');
    }
}
