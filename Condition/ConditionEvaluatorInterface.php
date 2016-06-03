<?php

namespace Havvg\Component\Lifecycle\Condition;

interface ConditionEvaluatorInterface
{
    /**
     * Evaluates the given condition and check whether it's fulfilled.
     *
     * @param ConditionInterface $condition
     *
     * @return bool|null Null is returned to abstain.
     */
    public function isFulfilled(ConditionInterface $condition);
}
