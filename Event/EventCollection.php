<?php

namespace Havvg\Component\Lifecycle\Event;

class EventCollection implements \IteratorAggregate, EventCollectionInterface
{
    /**
     * @var EventInterface[]
     */
    private $events = [];

    public function addEvent(EventInterface $event): EventCollectionInterface
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * @return EventInterface[]|\Traversable
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->events);
    }

    public function count()
    {
        return count($this->events);
    }
}
