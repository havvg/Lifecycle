<?php

namespace Havvg\Component\Lifecycle\Artifact;

class Artifact implements ArtifactInterface
{
    /**
     * @var mixed[]
     */
    private $data = [];

    /**
     * {@inheritdoc}
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function get($key)
    {
        if (!isset($this->data[$key])) {
            return;
        }

        return $this->data[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function all()
    {
        return $this->data;
    }
}
