<?php

namespace Havvg\Component\Lifecycle\Event\Runtime;

use Havvg\Component\Lifecycle\Event\EventCollectionInterface;

interface CollectionAwareTriggerInterface extends EventTriggerInterface
{
    /**
     * Triggers all events in the given collection.
     *
     * @param EventCollectionInterface $events
     *
     * @return CollectionAwareTriggerInterface
     */
    public function all(EventCollectionInterface $events);
}
