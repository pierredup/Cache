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

use Doctrine\Common\Cache\Cache;
use GrahamCampbell\TestBench\AbstractTestCase;
use Mockery;
use StyleCI\Cache\Adapters\DoctrineAdapter;

/**
 * This is the doctrine adapter test case class.
 *
 * @author Pierre du Plessis <pdples@gmail.com>
 */
class DoctrineAdapterTest extends AbstractTestCase
{
    public function testGetString()
    {
        $adapter = new DoctrineAdapter($cache = Mockery::mock(Cache::class), 123);

        $cache->shouldReceive('fetch')->once()->with('analysis.2468.branch.master')->andReturn('foo');

        $this->assertSame('foo', $adapter->get(2468, 'branch.master'));
    }

    public function testGetEmpty()
    {
        $adapter = new DoctrineAdapter($cache = Mockery::mock(Cache::class), 12);

        $cache->shouldReceive('fetch')->once()->with('analysis.42.pr.5')->andReturn('');

        $this->assertNull($adapter->get(42, 'pr.5'));
    }

    public function testGetNull()
    {
        $adapter = new DoctrineAdapter($cache = Mockery::mock(Cache::class), 42);

        $cache->shouldReceive('fetch')->once()->with('analysis.123.branch.bug/foo')->andReturn(null);

        $this->assertNull($adapter->get(123, 'branch.bug/foo'));
    }

    public function testPut()
    {
        $adapter = new DoctrineAdapter($cache = Mockery::mock(Cache::class), 2);

        $cache->shouldReceive('save')->once()->with('analysis.7.branch.foo', 'foo bar baz', 2);

        $this->assertNull($adapter->put(7, 'branch.foo', 'foo bar baz'));
    }

    public function testFlush()
    {
        $adapter = new DoctrineAdapter($cache = Mockery::mock(Cache::class), 123);

        $cache->shouldReceive('delete')->once()->with('analysis.3.pr.100');

        $this->assertNull($adapter->flush(3, 'pr.100'));
    }
}
