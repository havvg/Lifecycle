<?php

namespace Havvg\Component\Lifecycle\Tests\Event;

use Havvg\Component\Lifecycle\Condition\ConditionCollection;
use Havvg\Component\Lifecycle\Condition\ConditionEvaluatorInterface;
use Havvg\Component\Lifecycle\Condition\ConditionInterface;
use Havvg\Component\Lifecycle\Consequence\ConsequenceCollection;
use Havvg\Component\Lifecycle\Consequence\ConsequenceInterface;
use Havvg\Component\Lifecycle\Consequence\ConsequenceProcessorInterface;
use Havvg\Component\Lifecycle\Event\EventInterface;
use Havvg\Component\Lifecycle\Event\EventProcessor;

/**
 * @covers \Havvg\Component\Lifecycle\Event\EventProcessor
 */
class EventProcessorTest extends \PHPUnit_Framework_TestCase
{
    public function testNoConditions()
    {
        $consequence = $this->createConsequence();

        $event = \Mockery::mock(EventInterface::class);
        $event->shouldReceive('getConditions')->andReturn(new ConditionCollection());
        $event->shouldReceive('getConsequences')->andReturn((new ConsequenceCollection())->addConsequence($consequence));

        $evaluator = $this->createEvaluator();
        $evaluator->shouldNotReceive('isFulfilled');

        $processor = $this->createProcessor();
        $processor->shouldReceive('process')->once()->with($consequence);

        $eventProcessor = new EventProcessor($evaluator, $processor);
        $eventProcessor->process($event);
    }

    public function testConditionNotFulfilled()
    {
        $condition = $this->createCondition();

        $event = \Mockery::mock(EventInterface::class);
        $event->shouldReceive('getConditions')->andReturn((new ConditionCollection())->addCondition($condition));
        $event->shouldReceive('getConsequences')->andReturn(new ConsequenceCollection());

        $evaluator = $this->createEvaluator();
        $evaluator
            ->shouldReceive('isFulfilled')
            ->once()
            ->with($condition)
            ->andReturn(false)
        ;

        $processor = $this->createProcessor();
        $processor->shouldNotReceive('process');

        $eventProcessor = new EventProcessor($evaluator, $processor);
        $eventProcessor->process($event);
    }

    public function testConditionAbstained()
    {
        $condition = $this->createCondition();
        $consequence = $this->createConsequence();

        $event = \Mockery::mock(EventInterface::class);
        $event->shouldReceive('getConditions')->andReturn((new ConditionCollection())->addCondition($condition));
        $event->shouldReceive('getConsequences')->andReturn((new ConsequenceCollection())->addConsequence($consequence));

        $evaluator = $this->createEvaluator();
        $evaluator
            ->shouldReceive('isFulfilled')
            ->once()
            ->with($condition)
            ->andReturn(null)
        ;

        $processor = $this->createProcessor();
        $processor->shouldNotReceive('process');

        $eventProcessor = new EventProcessor($evaluator, $processor);
        $eventProcessor->process($event);
    }

    public function testConditionFulfilled()
    {
        $condition = $this->createCondition();
        $consequence = $this->createConsequence();

        $event = \Mockery::mock(EventInterface::class);
        $event->shouldReceive('getConditions')->andReturn((new ConditionCollection())->addCondition($condition));
        $event->shouldReceive('getConsequences')->andReturn((new ConsequenceCollection())->addConsequence($consequence));

        $evaluator = $this->createEvaluator();
        $evaluator
            ->shouldReceive('isFulfilled')
            ->once()
            ->with($condition)
            ->andReturn(true)
        ;

        $processor = $this->createProcessor();
        $processor
            ->shouldReceive('process')
            ->once()
            ->with($consequence)
        ;

        $eventProcessor = new EventProcessor($evaluator, $processor);
        $eventProcessor->process($event);
    }

    public function testConditionsPartlyFulfilled()
    {
        $consequence = $this->createConsequence();

        $abstained = $this->createCondition();
        $fulfilled = $this->createCondition();
        $notFulfilled = $this->createCondition();

        $event = \Mockery::mock(EventInterface::class);
        $event->shouldReceive('getConditions')->andReturn((new ConditionCollection())->addCondition($abstained)->addCondition($fulfilled)->addCondition($notFulfilled));
        $event->shouldReceive('getConsequences')->andReturn((new ConsequenceCollection())->addConsequence($consequence));

        $evaluator = $this->createEvaluator();
        $evaluator
            ->shouldReceive('isFulfilled')
            ->times(3)
            ->andReturn(null, true, false)
        ;

        $processor = $this->createProcessor();
        $processor->shouldNotReceive('process');

        $eventProcessor = new EventProcessor($evaluator, $processor);
        $eventProcessor->process($event);
    }

    private function createEvaluator()
    {
        return \Mockery::mock(ConditionEvaluatorInterface::class);
    }

    private function createCondition()
    {
        return \Mockery::mock(ConditionInterface::class);
    }

    private function createProcessor()
    {
        return \Mockery::mock(ConsequenceProcessorInterface::class);
    }

    private function createConsequence()
    {
        return \Mockery::mock(ConsequenceInterface::class);
    }
}
