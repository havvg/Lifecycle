<?php

namespace Havvg\Component\Lifecycle\Event\Runtime;

use Havvg\Component\Lifecycle\Event\EventInterface;

interface EventTriggerInterface
{
    /**
     * Triggers a runtime based lifecycle event.
     *
     * @param EventInterface $event
     *
     * @return EventTriggerInterface
     */
    public function trigger(EventInterface $event);
}
