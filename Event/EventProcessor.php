<?php

namespace Havvg\Component\Lifecycle\Event;

use Havvg\Component\Lifecycle\Condition\ConditionEvaluatorInterface;
use Havvg\Component\Lifecycle\Consequence\ConsequenceProcessorInterface;

class EventProcessor implements EventProcessorInterface
{
    private $evaluator;
    private $processor;

    public function __construct(ConditionEvaluatorInterface $evaluator, ConsequenceProcessorInterface $processor)
    {
        $this->evaluator = $evaluator;
        $this->processor = $processor;
    }

    public function process(EventInterface $event)
    {
        $openConditions = count($event->getConditions());
        foreach ($event->getConditions() as $eachCondition) {
            $isFulfilled = $this->evaluator->isFulfilled($eachCondition);
            if (false === $isFulfilled) {
                return;
            }

            if (true === $isFulfilled) {
                --$openConditions;
            }
        }

        if ($openConditions) {
            return;
        }

        foreach ($event->getConsequences() as $eachConsequence) {
            $this->processor->process($eachConsequence);
        }
    }
}
