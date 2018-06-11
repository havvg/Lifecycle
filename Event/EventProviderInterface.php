<?php

namespace Havvg\Component\Lifecycle\Event;

interface EventProviderInterface
{
    public function getEvents(): EventCollectionInterface;
}
