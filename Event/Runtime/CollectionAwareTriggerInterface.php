<?php

namespace Havvg\Component\Lifecycle\Event\Runtime;

use Havvg\Component\Lifecycle\Event\EventCollectionInterface;

interface CollectionAwareTriggerInterface extends EventTriggerInterface
{
    public function all(EventCollectionInterface $events): CollectionAwareTriggerInterface;
}
