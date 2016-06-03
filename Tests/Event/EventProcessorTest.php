<?php

namespace Havvg\Component\Lifecycle\Tests\Event;

use Havvg\Component\Lifecycle\Event\EventProcessor;

/**
 * @covers \Havvg\Component\Lifecycle\Event\EventProcessor
 */
class EventProcessorTest extends \PHPUnit_Framework_TestCase
{
    public function testNoConditions()
    {
        $consequence = $this->createConsequence();

        $event = \Mockery::mock('Havvg\Component\Lifecycle\Event\EventInterface');
        $event->shouldReceive('getConditions')->andReturn([]);
        $event->shouldReceive('getConsequences')->andReturn([$consequence]);

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

        $event = \Mockery::mock('Havvg\Component\Lifecycle\Event\EventInterface');
        $event->shouldReceive('getConditions')->andReturn([$condition]);
        $event->shouldReceive('getConsequences')->andReturn([]);

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

        $event = \Mockery::mock('Havvg\Component\Lifecycle\Event\EventInterface');
        $event->shouldReceive('getConditions')->andReturn([$condition]);
        $event->shouldReceive('getConsequences')->andReturn([$consequence]);

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

        $event = \Mockery::mock('Havvg\Component\Lifecycle\Event\EventInterface');
        $event->shouldReceive('getConditions')->andReturn([$condition]);
        $event->shouldReceive('getConsequences')->andReturn([$consequence]);

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

        $event = \Mockery::mock('Havvg\Component\Lifecycle\Event\EventInterface');
        $event->shouldReceive('getConditions')->andReturn([$abstained, $fulfilled, $notFulfilled]);
        $event->shouldReceive('getConsequences')->andReturn([$consequence]);

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
        return \Mockery::mock('Havvg\Component\Lifecycle\Condition\ConditionEvaluatorInterface');
    }

    private function createCondition()
    {
        return \Mockery::mock('Havvg\Component\Lifecycle\Condition\ConditionInterface');
    }

    private function createProcessor()
    {
        return \Mockery::mock('Havvg\Component\Lifecycle\Consequence\ConsequenceProcessorInterface');
    }

    private function createConsequence()
    {
        return \Mockery::mock('Havvg\Component\Lifecycle\Consequence\ConsequenceInterface');
    }
}
