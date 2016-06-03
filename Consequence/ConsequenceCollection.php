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

    /**
     * {@inheritdoc}
     */
    public function addConsequence(ConsequenceInterface $consequence)
    {
        $this->consequences[] = $consequence;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setArtifact(ArtifactInterface $artifact = null)
    {
        $this->artifact = $artifact;

        foreach ($this->consequences as $eachConsequence) {
            if ($eachConsequence instanceof ArtifactAwareInterface) {
                $eachConsequence->setArtifact($artifact);
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getArtifact()
    {
        return $this->artifact;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->consequences);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->consequences);
    }
}
