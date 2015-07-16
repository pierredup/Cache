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

/**
 * This is the adapter interface.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
interface AdapterInterface
{
    /**
     * Get the data from the storage.
     *
     * @param int    $repo
     * @param string $name
     *
     * @return string|null
     */
    public function get($repo, $name);

    /**
     * Put the data into the storage.
     *
     * @param int    $repo
     * @param string $name
     * @param string $data
     *
     * @return void
     */
    public function put($repo, $name, $data);

    /**
     * Flush the data from the storage.
     *
     * @param int    $repo
     * @param string $name
     *
     * @return void
     */
    public function flush($repo, $name);
}
