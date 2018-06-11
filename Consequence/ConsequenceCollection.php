<?php

namespace Havvg\Component\Lifecycle\Consequence;

use Havvg\Component\Lifecycle\Artifact\ArtifactAwareInterface;
use Havvg\Component\Lifecycle\Artifact\ArtifactInterface;

class ConsequenceCollection implements \IteratorAggregate, ConsequenceCollectionInterface, ArtifactAwareInterface
{
    /**
     * @var ArtifactInterface|null
     */
    private $artifact;

    /**
     * @var ConsequenceInterface[]
     */
    private $consequences = [];

    public function addConsequence(ConsequenceInterface $consequence): ConsequenceCollectionInterface
    {
        $this->consequences[] = $consequence;

        return $this;
    }

    public function setArtifact(ArtifactInterface $artifact = null): ArtifactAwareInterface
    {
        $this->artifact = $artifact;

        foreach ($this->consequences as $eachConsequence) {
            if ($eachConsequence instanceof ArtifactAwareInterface) {
                $eachConsequence->setArtifact($artifact);
            }
        }

        return $this;
    }

    public function getArtifact(): ArtifactInterface
    {
        return $this->artifact;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->consequences);
    }

    public function count()
    {
        return count($this->consequences);
    }
}
