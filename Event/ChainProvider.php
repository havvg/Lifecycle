<?php

namespace Havvg\Component\Lifecycle\Event;

final class ChainProvider implements EventProviderInterface
{
    /**
     * @var EventProviderInterface[]
     */
    private $providers = [];

    public function add(EventProviderInterface $provider): ChainProvider
    {
        $this->providers[] = $provider;

        return $this;
    }

    public function getEvents(): EventCollectionInterface
    {
        $collection = new EventCollection();

        foreach ($this->providers as $eachProvider) {
            foreach ($eachProvider->getEvents() as $eachEvent) {
                $collection->addEvent($eachEvent);
            }
        }

        return $collection;
    }
}
