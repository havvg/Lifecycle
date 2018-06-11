<?php

namespace Havvg\Component\Lifecycle\Tests;

use Havvg\Component\Lifecycle\Event\EventCollection;
use Havvg\Component\Lifecycle\Event\EventInterface;
use Havvg\Component\Lifecycle\Event\EventProcessorInterface;
use Havvg\Component\Lifecycle\Event\EventProviderInterface;
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
        $event = \Mockery::mock(EventInterface::class);
        $provider = \Mockery::mock(EventProviderInterface::class);
        $provider->shouldReceive('getEvents')->andReturn((new EventCollection())->addEvent($event));
        $processor = \Mockery::spy(EventProcessorInterface::class);

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
        $event = \Mockery::mock(EventInterface::class);
        $provider = \Mockery::mock(EventProviderInterface::class);
        $processor = \Mockery::spy(EventProcessorInterface::class);

        $lifecycle = new Lifecycle($provider, $processor);
        $lifecycle->onEventTriggered(new EventTriggeredEvent($event));

        $processor->shouldHaveReceived('process')->once()->with($event);
    }
}
