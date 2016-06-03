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

    /**
     * {@inheritdoc}
     */
    public function addCondition(ConditionInterface $condition)
    {
        $this->conditions[] = $condition;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setArtifact(ArtifactInterface $artifact = null)
    {
        $this->artifact = $artifact;

        foreach ($this->conditions as $eachCondition) {
            if ($eachCondition instanceof ArtifactAwareInterface) {
                $eachCondition->setArtifact($artifact);
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
        return new \ArrayIterator($this->conditions);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->conditions);
    }
}
