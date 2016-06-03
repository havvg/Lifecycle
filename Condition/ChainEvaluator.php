<?php

namespace Havvg\Component\Lifecycle\Condition;

class ChainEvaluator implements ConditionEvaluatorInterface
{
    /**
     * @var ConditionEvaluatorInterface[]
     */
    private $evaluators = [];

    /**
     * Adds an evaluator to utilize.
     *
     * @param ConditionEvaluatorInterface $evaluator
     *
     * @return ChainEvaluator
     */
    public function add(ConditionEvaluatorInterface $evaluator)
    {
        $this->evaluators[] = $evaluator;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isFulfilled(ConditionInterface $condition)
    {
        foreach ($this->evaluators as $eachEvaluator) {
            $isFulfilled = $eachEvaluator->isFulfilled($condition);
            if (null !== $isFulfilled) {
                return $isFulfilled;
            }
        }

        return;
    }
}
