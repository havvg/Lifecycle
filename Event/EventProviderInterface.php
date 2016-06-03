<?php

namespace Havvg\Component\Lifecycle\Event;

interface EventProviderInterface
{
    /**
     * Provides a list of lifecycle events.
     *
     * @return EventCollectionInterface
     */
    public function getEvents();
}
