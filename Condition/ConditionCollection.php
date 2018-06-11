<?php

namespace Havvg\Component\Lifecycle\Condition;

use Havvg\Component\Lifecycle\Artifact\ArtifactAwareInterface;
use Havvg\Component\Lifecycle\Artifact\ArtifactInterface;

class ConditionCollection implements \IteratorAggregate, ConditionCollectionInterface, ArtifactAwareInterface
{
    /**
     * @var ArtifactInterface|null
     */
    private $artifact;

    /**
     * @var ConditionInterface[]
     */
    private $conditions = [];

    public function addCondition(ConditionInterface $condition): ConditionCollectionInterface
    {
        $this->conditions[] = $condition;

        return $this;
    }

    public function setArtifact(ArtifactInterface $artifact = null): ArtifactAwareInterface
    {
        $this->artifact = $artifact;

        foreach ($this->conditions as $eachCondition) {
            if ($eachCondition instanceof ArtifactAwareInterface) {
                $eachCondition->setArtifact($artifact);
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
        return new \ArrayIterator($this->conditions);
    }

    public function count()
    {
        return count($this->conditions);
    }
}
