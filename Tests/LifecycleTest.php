<?php

namespace Havvg\Component\Lifecycle\Tests;

use Havvg\Component\Lifecycle\Event\Runtime\EventTriggeredEvent;
use Havvg\Component\Lifecycle\Lifecycle;
use Havvg\Component\Lifecycle\LifecycleEvents;

/**
 * @covers \Havvg\Component\Lifecycle\Lifecycle
 */
class LifecycleTest extends \PHPUnit_Framework_TestCase
{
    public function testHandle()
    {
        $event = \Mockery::mock('Havvg\Component\Lifecycle\Event\EventInterface');
        $provider = \Mockery::mock('Havvg\Component\Lifecycle\Event\EventProviderInterface');
        $provider->shouldReceive('getEvents')->andReturn([$event]);
        $processor = \Mockery::spy('Havvg\Component\Lifecycle\Event\EventProcessorInterface');

        $lifecycle = new Lifecycle($provider, $processor);
        $lifecycle->handle();

        $processor->shouldHaveReceived('process')->once()->with($event);
    }

    public function testEventSubscription()
    {
        static::assertArrayHasKey(LifecycleEvents::EVENT_TRIGGERED, Lifecycle::getSubscribedEvents());
    }

    public function testEventTriggered()
    {
        $event = \Mockery::mock('Havvg\Component\Lifecycle\Event\EventInterface');
        $provider = \Mockery::mock('Havvg\Component\Lifecycle\Event\EventProviderInterface');
        $processor = \Mockery::spy('Havvg\Component\Lifecycle\Event\EventProcessorInterface');

        $lifecycle = new Lifecycle($provider, $processor);
        $lifecycle->onEventTriggered(new EventTriggeredEvent($event));

        $processor->shouldHaveReceived('process')->once()->with($event);
    }
}
