<?php

namespace Havvg\Component\Lifecycle\Condition;

interface ConditionCollectionInterface extends \Traversable, \Countable
{
    public function addCondition(ConditionInterface $condition): ConditionCollectionInterface;
}
