<?php

namespace Havvg\Component\Lifecycle\Artifact;

trait ArtifactAwareTrait
{
    /**
     * @var ArtifactInterface|null
     */
    private $artifact = null;

    /**
     * Sets the Artifact on this object.
     *
     * @param ArtifactInterface|null $artifact
     *
     * @return $this
     */
    public function setArtifact(ArtifactInterface $artifact = null)
    {
        $this->artifact = $artifact;

        return $this;
    }

    /**
     * Returns the Artifact, if any.
     *
     * @return ArtifactInterface|null
     */
    public function getArtifact()
    {
        return $this->artifact;
    }
}
