<?php

namespace Havvg\Component\Lifecycle\Event;

use Havvg\Component\Lifecycle\Artifact\ArtifactAwareInterface;
use Havvg\Component\Lifecycle\Artifact\ArtifactInterface;
use Havvg\Component\Lifecycle\Condition\ConditionCollection;
use Havvg\Component\Lifecycle\Condition\ConditionCollectionInterface;
use Havvg\Component\Lifecycle\Condition\ConditionInterface;
use Havvg\Component\Lifecycle\Consequence\ConsequenceCollection;
use Havvg\Component\Lifecycle\Consequence\ConsequenceCollectionInterface;
use Havvg\Component\Lifecycle\Consequence\ConsequenceInterface;

class Event implements EventInterface, ArtifactAwareInterface
{
    private $conditions;
    private $consequences;

    /**
     * @var ArtifactInterface
     */
    private $artifact;

    public function __construct()
    {
        $this->conditions = new ConditionCollection();
        $this->consequences = new ConsequenceCollection();
    }

    public function addCondition(ConditionInterface $condition): Event
    {
        $this->conditions->addCondition($condition);

        return $this;
    }

    public function addConsequence(ConsequenceInterface $consequence): Event
    {
        $this->consequences->addConsequence($consequence);

        return $this;
    }

    public function getConditions(): ConditionCollectionInterface
    {
        return $this->conditions;
    }

    public function getConsequences(): ConsequenceCollectionInterface
    {
        return $this->consequences;
    }

    public function setArtifact(ArtifactInterface $artifact = null): ArtifactAwareInterface
    {
        $this->artifact = $artifact;

        $this->conditions->setArtifact($artifact);
        $this->consequences->setArtifact($artifact);

        return $this;
    }

    public function getArtifact(): ArtifactInterface
    {
        return $this->artifact;
    }
}
