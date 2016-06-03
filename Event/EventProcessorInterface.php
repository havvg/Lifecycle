<?php

namespace Havvg\Component\Lifecycle\Event;

interface EventProcessorInterface
{
    /**
     * Processes the given event.
     *
     * @param EventInterface $event
     */
    public function process(EventInterface $event);
}
