<?php

namespace Havvg\Component\Lifecycle\Event\Runtime;

use Havvg\Component\Lifecycle\Event\EventInterface;
use Symfony\Component\EventDispatcher\Event;

class EventTriggeredEvent extends Event
{
    /**
     * @var EventInterface
     */
    private $event;

    /**
     * Constructor.
     *
     * @param EventInterface $event
     */
    public function __construct(EventInterface $event)
    {
        $this->event = $event;
    }

    /**
     * @return EventInterface
     */
    public function getEvent()
    {
        return $this->event;
    }
}
