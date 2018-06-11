<?php

namespace Havvg\Component\Lifecycle\Event\Runtime;

use Havvg\Component\Lifecycle\Event\EventInterface;
use Symfony\Component\EventDispatcher\Event;

class EventTriggeredEvent extends Event
{
    private $event;

    public function __construct(EventInterface $event)
    {
        $this->event = $event;
    }

    public function getEvent(): EventInterface
    {
        return $this->event;
    }
}
