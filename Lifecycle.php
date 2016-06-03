<?php

namespace Havvg\Component\Lifecycle;

use Havvg\Component\Lifecycle\Event\EventInterface;
use Havvg\Component\Lifecycle\Event\EventProcessorInterface;
use Havvg\Component\Lifecycle\Event\EventProviderInterface;
use Havvg\Component\Lifecycle\Event\Runtime\EventTriggeredEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Lifecycle implements EventSubscriberInterface
{
    /**
     * @var EventProviderInterface
     */
    private $provider;

    /**
     * @var EventProcessorInterface
     */
    private $processor;

    /**
     * Constructor.
     *
     * @param EventProviderInterface  $provider
     * @param EventProcessorInterface $processor
     */
    public function __construct(EventProviderInterface $provider, EventProcessorInterface $processor)
    {
        $this->provider = $provider;
        $this->processor = $processor;
    }

    /**
     * Handles the lifecycle resulting by the provided data.
     */
    public function handle()
    {
        foreach ($this->provider->getEvents() as $eachEvent) {
            $this->process($eachEvent);
        }
    }

    /**
     * A lifecycle event has been triggered.
     *
     * @param EventTriggeredEvent $event
     */
    public function onEventTriggered(EventTriggeredEvent $event)
    {
        $this->process($event->getEvent());
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            LifecycleEvents::EVENT_TRIGGERED => 'onEventTriggered',
        ];
    }

    /**
     * Processes the given Event.
     *
     * @param EventInterface $event
     */
    private function process(EventInterface $event)
    {
        $this->processor->process($event);
    }
}
