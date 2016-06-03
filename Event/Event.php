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
    /**
     * @var ArtifactInterface
     */
    private $artifact;

    /**
     * @var ConditionCollectionInterface
     */
    private $conditions;

    /**
     * @var ConsequenceCollectionInterface
     */
    private $consequences;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->conditions = new ConditionCollection();
        $this->consequences = new ConsequenceCollection();
    }

    /**
     * Adds a condition to this event.
     *
     * @param ConditionInterface $condition
     *
     * @return Event
     */
    public function addCondition(ConditionInterface $condition)
    {
        $this->conditions->addCondition($condition);

        return $this;
    }

    /**
     * Adds a consequence to this event.
     *
     * @param ConsequenceInterface $consequence
     *
     * @return Event
     */
    public function addConsequence(ConsequenceInterface $consequence)
    {
        $this->consequences->addConsequence($consequence);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * {@inheritdoc}
     */
    public function getConsequences()
    {
        return $this->consequences;
    }

    /**
     * {@inheritdoc}
     */
    public function setArtifact(ArtifactInterface $artifact = null)
    {
        $this->artifact = $artifact;

        $this->getConditions()->setArtifact($artifact);
        $this->getConsequences()->setArtifact($artifact);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getArtifact()
    {
        return $this->artifact;
    }
}
