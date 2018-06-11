<?php

namespace Havvg\Component\Lifecycle\Tests\Event;

use Havvg\Component\Lifecycle\Artifact\ArtifactAwareInterface;
use Havvg\Component\Lifecycle\Artifact\ArtifactInterface;
use Havvg\Component\Lifecycle\Condition\ConditionInterface;
use Havvg\Component\Lifecycle\Consequence\ConsequenceInterface;
use Havvg\Component\Lifecycle\Event\Event;

/**
 * @covers \Havvg\Component\Lifecycle\Event\Event
 */
class EventTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructEmpty()
    {
        $event = new Event();

        static::assertCount(0, $event->getConditions());
        static::assertCount(0, $event->getConsequences());
    }

    /**
     * @depends testConstructEmpty
     */
    public function testAddCondition()
    {
        $condition = \Mockery::mock(ConditionInterface::class);

        $event = new Event();

        static::assertSame($event, $event->addCondition($condition));
        static::assertCount(1, $event->getConditions());
        static::assertContains($condition, $event->getConditions());
    }

    /**
     * @depends testConstructEmpty
     */
    public function testAddConsequence()
    {
        $consequence = \Mockery::mock(ConsequenceInterface::class);

        $event = new Event();

        static::assertSame($event, $event->addConsequence($consequence));
        static::assertCount(1, $event->getConsequences());
        static::assertContains($consequence, $event->getConsequences());
    }

    /**
     * @depends testConstructEmpty
     */
    public function testIsArtifactAware()
    {
        $artifact = \Mockery::mock(ArtifactInterface::class);

        $event = new Event();
        $event->setArtifact($artifact);

        static::assertSame($artifact, $event->getArtifact());
    }

    /**
     * @depends testAddCondition
     * @depends testAddConsequence
     */
    public function testSetArtifactOnConditionsAndConsequences()
    {
        $artifact = \Mockery::mock(ArtifactInterface::class);

        $condition = \Mockery::mock(implode(',', [ConditionInterface::class, ArtifactAwareInterface::class]));
        $consequence = \Mockery::mock(implode(',', [ConsequenceInterface::class, ArtifactAwareInterface::class]));

        $condition->shouldReceive('setArtifact')->once()->with($artifact)->andReturnSelf();
        $consequence->shouldReceive('setArtifact')->once()->with($artifact)->andReturnSelf();

        $event = new Event();
        $event->addCondition($condition);
        $event->addConsequence($consequence);
        $event->setArtifact($artifact);
    }
}
