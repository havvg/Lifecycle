<?php

namespace Havvg\Component\Lifecycle\Tests\Event;

use Havvg\Component\Lifecycle\Event\Event;

/**
 * @covers \Havvg\Component\Lifecycle\Event\Event
 */
class EventTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructEmpty()
    {
        $event = new Event();

        static::assertInstanceOf('Havvg\Component\Lifecycle\Condition\ConditionCollectionInterface', $event->getConditions());
        static::assertInstanceOf('Havvg\Component\Lifecycle\Consequence\ConsequenceCollectionInterface', $event->getConsequences());
    }

    /**
     * @depends testConstructEmpty
     */
    public function testAddCondition()
    {
        $condition = \Mockery::mock('Havvg\Component\Lifecycle\Condition\ConditionInterface');

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
        $consequence = \Mockery::mock('Havvg\Component\Lifecycle\Consequence\ConsequenceInterface');

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
        $artifact = \Mockery::mock('Havvg\Component\Lifecycle\Artifact\ArtifactInterface');

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
        $artifact = \Mockery::mock('Havvg\Component\Lifecycle\Artifact\ArtifactInterface');

        $condition = \Mockery::spy('Havvg\Component\Lifecycle\Condition\ConditionInterface, Havvg\Component\Lifecycle\Artifact\ArtifactAwareInterface');
        $consequence = \Mockery::spy('Havvg\Component\Lifecycle\Consequence\ConsequenceInterface, Havvg\Component\Lifecycle\Artifact\ArtifactAwareInterface');

        $event = new Event();
        $event->addCondition($condition);
        $event->addConsequence($consequence);
        $event->setArtifact($artifact);

        $condition->shouldHaveReceived('setArtifact')->once()->with($artifact);
        $consequence->shouldHaveReceived('setArtifact')->once()->with($artifact);
    }
}
