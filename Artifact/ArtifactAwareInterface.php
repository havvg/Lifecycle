<?php

namespace Havvg\Component\Lifecycle\Artifact;

interface ArtifactAwareInterface
{
    /**
     * Sets the Artifact on this object.
     *
     * @param ArtifactInterface|null $artifact
     *
     * @return $this
     */
    public function setArtifact(ArtifactInterface $artifact = null);

    /**
     * Returns the Artifact, if any.
     *
     * @return ArtifactInterface|null
     */
    public function getArtifact();
}
