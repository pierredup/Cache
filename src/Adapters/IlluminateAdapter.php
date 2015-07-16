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

use Illuminate\Contracts\Cache\Repository;

/**
 * This is the illuminate adapter class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class IlluminateAdapter implements AdapterInterface
{
    /**
     * The illuminate cache repository instance.
     *
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * The time to live.
     *
     * @var int
     */
    protected $time;

    /**
     * Create a new illuminate adapter instance.
     *
     * @param \Illuminate\Contracts\Cache\Repository $cache
     * @param int                                    $time
     *
     * @return void
     */
    public function __construct(Repository $cache, $time)
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
        return $this->cache->get("analysis.{$repo}.{$name}") ?: null;
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
        $this->cache->put("analysis.{$repo}.{$name}", $data, $this->time);
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
        $this->cache->forget("analysis.{$repo}.{$name}");
    }
}
