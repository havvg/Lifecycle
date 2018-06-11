<?php

namespace Havvg\Component\Lifecycle\Tests\Event;

use Havvg\Component\Lifecycle\Event\ChainProvider;
use Havvg\Component\Lifecycle\Event\EventCollection;
use Havvg\Component\Lifecycle\Event\EventCollectionInterface;
use Havvg\Component\Lifecycle\Event\EventInterface;
use Havvg\Component\Lifecycle\Event\EventProviderInterface;

/**
 * @covers \Havvg\Component\Lifecycle\Event\ChainProvider
 */
class ChainProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyEventCollection()
    {
        $provider = new ChainProvider();
        $events = $provider->getEvents();

        static::assertInstanceOf(EventCollectionInterface::class, $events);
        static::assertCount(0, $events);
    }

    /**
     * @depends testEmptyEventCollection
     */
    public function testProvidersAreChained()
    {
        $event1 = $this->createEvent();
        $event2 = $this->createEvent();

        $provider = new ChainProvider();

        $provider->add($this->createEventProvider());
        $provider->add($this->createEventProvider([$event1]));
        $provider->add($this->createEventProvider([$event2]));

        $events = $provider->getEvents();

        static::assertCount(2, $events);
        static::assertContains($event1, $events);
        static::assertContains($event2, $events);
    }

    private function createEvent()
    {
        return \Mockery::mock(EventInterface::class);
    }

    private function createEventProvider($events = [])
    {
        $collection = new EventCollection();
        foreach ($events as $event) {
            $collection->addEvent($event);
        }

        $provider = \Mockery::mock(EventProviderInterface::class);
        $provider
            ->shouldReceive('getEvents')
            ->once()
            ->andReturn($collection)
        ;

        return $provider;
    }
}
