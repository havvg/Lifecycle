<?php

namespace Havvg\Component\Lifecycle\Artifact;

interface ArtifactAwareInterface
{
    public function setArtifact(ArtifactInterface $artifact = null): ArtifactAwareInterface;

    public function getArtifact(): ?ArtifactInterface;
}
