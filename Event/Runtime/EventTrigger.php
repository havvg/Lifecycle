<?php

namespace Havvg\Component\Lifecycle\Event\Runtime;

use Havvg\Component\Lifecycle\Event\EventCollectionInterface;
use Havvg\Component\Lifecycle\Event\EventInterface;
use Havvg\Component\Lifecycle\LifecycleEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class EventTrigger implements CollectionAwareTriggerInterface
{
    private $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    public function all(EventCollectionInterface $events): CollectionAwareTriggerInterface
    {
        foreach ($events as $eachEvent) {
            $this->trigger($eachEvent);
        }

        return $this;
    }

    public function trigger(EventInterface $event): EventTriggerInterface
    {
        $triggerEvent = new EventTriggeredEvent($event);
        $this->dispatcher->dispatch(LifecycleEvents::EVENT_TRIGGERED, $triggerEvent);

        return $this;
    }
}
