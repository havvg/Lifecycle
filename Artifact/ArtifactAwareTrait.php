<?php

namespace Havvg\Component\Lifecycle\Artifact;

trait ArtifactAwareTrait
{
    private $artifact;

    public function setArtifact(ArtifactInterface $artifact = null): ArtifactAwareInterface
    {
        $this->artifact = $artifact;

        return $this;
    }

    public function getArtifact(): ?ArtifactInterface
    {
        return $this->artifact;
    }
}
