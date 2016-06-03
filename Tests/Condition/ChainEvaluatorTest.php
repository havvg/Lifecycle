<?php

namespace Havvg\Component\Lifecycle\Tests\Condition;

use Havvg\Component\Lifecycle\Condition\ChainEvaluator;

/**
 * @covers \Havvg\Component\Lifecycle\Condition\ChainEvaluator
 */
class ChainEvaluatorTest extends \PHPUnit_Framework_TestCase
{
    public function testIsNotFulfilledWithoutEvaluators()
    {
        $evaluator = new ChainEvaluator();

        static::assertNull($evaluator->isFulfilled($this->createCondition()));
    }

    public function testEvaluatorsAreChained()
    {
        $condition = $this->createCondition();

        $evaluator = new ChainEvaluator();

        $evaluator->add($this->createEvaluator(null, $condition, $this->once()));
        $evaluator->add($this->createEvaluator(null, $condition, $this->once()));
        $evaluator->add($this->createEvaluator(null, $condition, $this->once()));

        static::assertNull($evaluator->isFulfilled($condition));
    }

    public function testEvaluatorsAreSkippedOnceFulfilled()
    {
        $condition = $this->createCondition();

        $evaluator = new ChainEvaluator();

        $evaluator->add($this->createEvaluator(null, $condition, $this->once()));
        $evaluator->add($this->createEvaluator(true, $condition, $this->once()));
        $evaluator->add($this->createEvaluator(null, $condition, $this->never()));

        static::assertTrue($evaluator->isFulfilled($condition));
    }

    public function testEvaluatorsAreSkippedOnceNotFulfilled()
    {
        $condition = $this->createCondition();

        $evaluator = new ChainEvaluator();

        $evaluator->add($this->createEvaluator(null, $condition, $this->once()));
        $evaluator->add($this->createEvaluator(false, $condition, $this->once()));
        $evaluator->add($this->createEvaluator(null, $condition, $this->never()));

        static::assertFalse($evaluator->isFulfilled($condition));
    }

    private function createCondition()
    {
        return \Mockery::mock('Havvg\Component\Lifecycle\Condition\ConditionInterface');
    }

    private function createEvaluator($isFulfilled, $condition, \PHPUnit_Framework_MockObject_Matcher_Invocation $matcher = null)
    {
        $evaluator = $this->getMockForAbstractClass('Havvg\Component\Lifecycle\Condition\ConditionEvaluatorInterface');
        $evaluator
            ->expects($matcher ?: $this->any())
            ->method('isFulfilled')
            ->with($condition)
            ->willReturn($isFulfilled)
        ;

        return $evaluator;
    }
}
