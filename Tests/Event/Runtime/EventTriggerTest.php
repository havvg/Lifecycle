<?php

namespace Havvg\Component\Lifecycle\Tests\Event\Runtime;

use Havvg\Component\Lifecycle\Event\EventCollection;
use Havvg\Component\Lifecycle\Event\Runtime\EventTrigger;
use Havvg\Component\Lifecycle\LifecycleEvents;
use Havvg\Component\Lifecycle\Tests\Assert\PHPUnit;

/**
 * @covers \Havvg\Component\Lifecycle\Event\Runtime\EventTrigger
 */
class EventTriggerTest extends \PHPUnit_Framework_TestCase
{
    public function testTriggerEvent()
    {
        $dispatcher = \Mockery::spy('Symfony\Component\EventDispatcher\EventDispatcherInterface');

        $event = \Mockery::mock('Havvg\Component\Lifecycle\Event\EventInterface');
        $trigger = new EventTrigger($dispatcher);
        $trigger->trigger($event);

        $dispatcher
            ->shouldHaveReceived('dispatch')
            ->once()
            ->with(LifecycleEvents::EVENT_TRIGGERED, \Mockery::on(function ($actual) use ($event) {
                return PHPUnit::evaluate($actual, PHPUnit::isInstanceOf('Havvg\Component\Lifecycle\Event\Runtime\EventTriggeredEvent'))
                    && PHPUnit::evaluate($actual->getEvent(), PHPUnit::equalTo($event))
                ;
            }))
        ;
    }

    /**
     * @depends testTriggerEvent
     */
    public function testTriggerEventCollection()
    {
        $dispatcher = \Mockery::spy('Symfony\Component\EventDispatcher\EventDispatcherInterface');

        $event = \Mockery::mock('Havvg\Component\Lifecycle\Event\EventInterface');
        $collection = new EventCollection();
        $collection->addEvent($event);

        $trigger = new EventTrigger($dispatcher);
        $trigger->all($collection);

        $dispatcher
            ->shouldHaveReceived('dispatch')
            ->once()
            ->with(LifecycleEvents::EVENT_TRIGGERED, \Mockery::on(function ($actual) use ($event) {
                return PHPUnit::evaluate($actual, PHPUnit::isInstanceOf('Havvg\Component\Lifecycle\Event\Runtime\EventTriggeredEvent'))
                    && PHPUnit::evaluate($actual->getEvent(), PHPUnit::equalTo($event))
                ;
            }))
        ;
    }
}
