<?php

namespace Havvg\Component\Lifecycle\Event;

class EventCollection implements \IteratorAggregate, EventCollectionInterface
{
    /**
     * @var EventInterface[]
     */
    private $events = [];

    /**
     * {@inheritdoc}
     */
    public function addEvent(EventInterface $event)
    {
        $this->events[] = $event;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->events);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->events);
    }
}
