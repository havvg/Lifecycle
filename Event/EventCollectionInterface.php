<?php

namespace Havvg\Component\Lifecycle\Event;

interface EventCollectionInterface extends \Traversable, \Countable
{
    public function addEvent(EventInterface $event): EventCollectionInterface;
}
