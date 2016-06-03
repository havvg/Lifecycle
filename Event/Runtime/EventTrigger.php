<?php

namespace Havvg\Component\Lifecycle\Event\Runtime;

use Havvg\Component\Lifecycle\Event\EventCollectionInterface;
use Havvg\Component\Lifecycle\Event\EventInterface;
use Havvg\Component\Lifecycle\LifecycleEvents;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class EventTrigger implements CollectionAwareTriggerInterface
{
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    /**
     * Constructor.
     *
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function all(EventCollectionInterface $events)
    {
        foreach ($events as $eachEvent) {
            $this->trigger($eachEvent);
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function trigger(EventInterface $event)
    {
        $triggerEvent = new EventTriggeredEvent($event);
        $this->dispatcher->dispatch(LifecycleEvents::EVENT_TRIGGERED, $triggerEvent);

        return $this;
    }
}
