<?php

namespace Havvg\Component\Lifecycle\Tests\Event;

use Havvg\Component\Lifecycle\Event\ChainProvider;

/**
 * @covers \Havvg\Component\Lifecycle\Event\ChainProvider
 */
class ChainProviderTest extends \PHPUnit_Framework_TestCase
{
    public function testEmptyEventCollection()
    {
        $provider = new ChainProvider();
        $events = $provider->getEvents();

        static::assertInstanceOf('Havvg\Component\Lifecycle\Event\EventCollectionInterface', $events);
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
        return \Mockery::mock('Havvg\Component\Lifecycle\Event\EventInterface');
    }

    private function createEventProvider($events = [])
    {
        $provider = \Mockery::mock('Havvg\Component\Lifecycle\Event\EventProviderInterface');
        $provider
            ->shouldReceive('getEvents')
            ->once()
            ->andReturn($events)
        ;

        return $provider;
    }
}
