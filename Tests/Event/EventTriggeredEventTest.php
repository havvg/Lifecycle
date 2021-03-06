<?php

namespace Havvg\Component\Lifecycle\Tests\Event;

use Havvg\Component\Lifecycle\Event\EventInterface;
use Havvg\Component\Lifecycle\Event\Runtime\EventTriggeredEvent;

/**
 * @covers \Havvg\Component\Lifecycle\Event\Runtime\EventTriggeredEvent
 */
class EventTriggeredEventTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $lifecycleEvent = \Mockery::mock(EventInterface::class);

        $event = new EventTriggeredEvent($lifecycleEvent);

        static::assertSame($lifecycleEvent, $event->getEvent());
    }
}
