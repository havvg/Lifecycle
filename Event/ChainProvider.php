<?php

namespace Havvg\Component\Lifecycle\Event;

class ChainProvider implements EventProviderInterface
{
    /**
     * @var EventProviderInterface[]
     */
    private $providers = [];

    /**
     * Adds a provider to utilize.
     *
     * @param EventProviderInterface $provider
     *
     * @return ChainProvider
     */
    public function add(EventProviderInterface $provider)
    {
        $this->providers[] = $provider;

        return $this;
    }

    /**
     * Provides a complete list of all lifecycle events provided by the set providers.
     *
     * @return EventCollectionInterface
     */
    public function getEvents()
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
