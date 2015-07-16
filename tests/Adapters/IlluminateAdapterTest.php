<?php

/*
 * This file is part of StyleCI.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Tests\Cache\Adapters;

use GrahamCampbell\TestBench\AbstractTestCase;
use Illuminate\Contracts\Cache\Repository;
use Mockery;
use StyleCI\Cache\Adapters\IlluminateAdapter;

/**
 * This is the illuminate adapter test case class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class IlluminateAdapterTest extends AbstractTestCase
{
    public function testGetString()
    {
        $adapter = new IlluminateAdapter($cache = Mockery::mock(Repository::class), 123);

        $cache->shouldReceive('get')->once()->with('analysis.2468.branch.master')->andReturn('foo');

        $this->assertSame('foo', $adapter->get(2468, 'branch.master'));
    }

    public function testGetEmpty()
    {
        $adapter = new IlluminateAdapter($cache = Mockery::mock(Repository::class), 12);

        $cache->shouldReceive('get')->once()->with('analysis.42.pr.5')->andReturn('');

        $this->assertNull($adapter->get(42, 'pr.5'));
    }

    public function testGetNull()
    {
        $adapter = new IlluminateAdapter($cache = Mockery::mock(Repository::class), 42);

        $cache->shouldReceive('get')->once()->with('analysis.123.branch.bug/foo')->andReturn(null);

        $this->assertNull($adapter->get(123, 'branch.bug/foo'));
    }

    public function testPut()
    {
        $adapter = new IlluminateAdapter($cache = Mockery::mock(Repository::class), 2);

        $cache->shouldReceive('put')->once()->with('analysis.7.branch.foo', 'foo bar baz', 2);

        $this->assertNull($adapter->put(7, 'branch.foo', 'foo bar baz'));
    }

    public function testFlush()
    {
        $adapter = new IlluminateAdapter($cache = Mockery::mock(Repository::class), 123);

        $cache->shouldReceive('forget')->once()->with('analysis.3.pr.100');

        $this->assertNull($adapter->flush(3, 'pr.100'));
    }
}
