<?php

/*
 * This file is part of StyleCI.
 *
 * (c) Alt Three Services Limited
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace StyleCI\Cache\Adapters;

use Doctrine\Common\Cache\Cache;

/**
 * This is the doctrine adapter class.
 *
 * @author Pierre du Plessis <pdples@gmail.com>
 */
class DoctrineAdapter implements AdapterInterface
{
    /**
     * The doctrine cache interface instance.
     *
     * @var \Doctrine\Common\Cache\Cache
     */
    protected $cache;

    /**
     * The time to live.
     *
     * @var int
     */
    protected $time;

    /**
     * Create a new doctrine adapter instance.
     *
     * @param \Doctrine\Common\Cache\Cache $cache
     * @param int                          $time
     *
     * @return void
     */
    public function __construct(Cache $cache, $time)
    {
        $this->cache = $cache;
        $this->time = $time;
    }

    /**
     * Get the data from the storage.
     *
     * @param int    $repo
     * @param string $name
     *
     * @return string|null
     */
    public function get($repo, $name)
    {
        return $this->cache->fetch("analysis.{$repo}.{$name}") ?: null;
    }

    /**
     * Put the data into the storage.
     *
     * @param int    $repo
     * @param string $name
     * @param string $data
     *
     * @return void
     */
    public function put($repo, $name, $data)
    {
        $this->cache->save("analysis.{$repo}.{$name}", $data, $this->time);
    }

    /**
     * Flush the data from the storage.
     *
     * @param int    $repo
     * @param string $name
     *
     * @return void
     */
    public function flush($repo, $name)
    {
        $this->cache->delete("analysis.{$repo}.{$name}");
    }
}
