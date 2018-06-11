<?php

namespace Havvg\Component\Lifecycle\Event\Runtime;

use Havvg\Component\Lifecycle\Event\EventInterface;

interface EventTriggerInterface
{
    public function trigger(EventInterface $event): EventTriggerInterface;
}
