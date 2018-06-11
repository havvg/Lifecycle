<?php

namespace Havvg\Component\Lifecycle\Condition;

class ChainEvaluator implements ConditionEvaluatorInterface
{
    /**
     * @var ConditionEvaluatorInterface[]
     */
    private $evaluators = [];

    public function add(ConditionEvaluatorInterface $evaluator): ChainEvaluator
    {
        $this->evaluators[] = $evaluator;

        return $this;
    }

    public function isFulfilled(ConditionInterface $condition): ?bool
    {
        foreach ($this->evaluators as $eachEvaluator) {
            $isFulfilled = $eachEvaluator->isFulfilled($condition);
            if (null !== $isFulfilled) {
                return $isFulfilled;
            }
        }

        return null;
    }
}
