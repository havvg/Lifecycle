<?php

namespace Havvg\Component\Lifecycle\Condition;

interface ConditionCollectionInterface extends \Traversable, \Countable
{
    /**
     * Adds a condition to this collection.
     *
     * @param ConditionInterface $condition
     *
     * @return ConditionCollectionInterface
     */
    public function addCondition(ConditionInterface $condition);
}
