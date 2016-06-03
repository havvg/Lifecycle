<?php

namespace Havvg\Component\Lifecycle\Artifact;

interface ArtifactInterface
{
    /**
     * Saves a specific value under the given key.
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return ArtifactInterface
     */
    public function set($key, $value);

    /**
     * Retrieves the value saved under the given key.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function get($key);

    /**
     * Returns all entries contained in this artifact.
     *
     * @return mixed[]
     */
    public function all();
}
