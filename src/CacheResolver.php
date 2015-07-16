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

use StyleCI\Cache\Adapters\AdapterInterface;

/**
 * This is the cache resolver class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class CacheResolver
{
    /**
     * The adapter instance.
     *
     * @var \StyleCI\Cache\Adapters\AdapterInterface
     */
    protected $adapter;

    /**
     * The location to use on the disk.
     *
     * @var string
     */
    protected $path;

    /**
     * Create a new config resolver instance.
     *
     * @param \StyleCI\Cache\Adapters\AdapterInterface $adapter
     * @param string                                   $path
     *
     * @return void
     */
    public function __construct(AdapterInterface $adapter, $path)
    {
        $this->adapter = $adapter;
        $this->path = $path;
    }

    /**
     * Get the cache path on the disk.
     *
     * @return string
     */
    public function path()
    {
        return $this->path;
    }

    /**
     * Set up the cache on the disk for use.
     *
     * @param int    $repo
     * @param string $name
     * @param string $default
     *
     * @return $this
     */
    public function setUp($repo, $name, $default)
    {
        $data = $this->adapter->get($repo, $name) ?: $this->adapter->get($repo, $default);

        file_put_contents($this->path, (string) $data);

        return $this;
    }

    /**
     * Store the cache from the disk after use.
     *
     * @param int    $repo
     * @param string $name
     *
     * @return $this
     */
    public function tearDown($repo, $name)
    {
        $this->adapter->put($repo, $name, file_get_contents($this->path));

        return $this;
    }

    /**
     * Flush the cache.
     *
     * @param int    $repo
     * @param string $name
     *
     * @return $this
     */
    public function flush($repo, $name)
    {
        $this->adapter->flush($repo, $name);

        return $this;
    }
}
