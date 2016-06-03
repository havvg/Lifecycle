<?php

namespace Havvg\Component\Lifecycle\Event;

interface EventCollectionInterface extends \Traversable, \Countable
{
    /**
     * Adds an event to this collection.
     *
     * @param EventInterface $event
     *
     * @return EventCollectionInterface
     */
    public function addEvent(EventInterface $event);
}
