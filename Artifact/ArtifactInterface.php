<?php

namespace Havvg\Component\Lifecycle\Artifact;

interface ArtifactInterface
{
    public function set(string $key, $value): ArtifactInterface;

    public function get(string $key);

    public function all(): iterable;
}
