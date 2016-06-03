<?php

namespace Havvg\Component\Lifecycle\Tests\Event;

use Havvg\Component\Lifecycle\Event\EventCollection;

/**
 * @covers \Havvg\Component\Lifecycle\Event\EventCollection
 */
class EventCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructEmpty()
    {
        $collection = new EventCollection();

        static::assertCount(0, $collection);
    }

    /**
     * @depends testConstructEmpty
     */
    public function testAddEvent()
    {
        $collection = new EventCollection();

        static::assertSame($collection, $collection->addEvent($this->createEvent()));
        static::assertCount(1, $collection);
    }

    /**
     * @depends testAddEvent
     */
    public function testIterator()
    {
        $event = $this->createEvent();

        $collection = new EventCollection();
        $collection->addEvent($event);

        static::assertContains($event, $collection);
    }

    private function createEvent()
    {
        return $this->getMockForAbstractClass('Havvg\Component\Lifecycle\Event\EventInterface');
    }
}
