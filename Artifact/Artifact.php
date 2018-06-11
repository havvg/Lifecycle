<?php

namespace Havvg\Component\Lifecycle\Artifact;

class Artifact implements ArtifactInterface
{
    private $data = [];

    public function set(string $key, $value): ArtifactInterface
    {
        $this->data[$key] = $value;

        return $this;
    }

    public function get(string $key)
    {
        if (!isset($this->data[$key])) {
            return null;
        }

        return $this->data[$key];
    }

    public function all(): iterable
    {
        return $this->data;
    }
}
