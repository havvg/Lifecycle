<?php

namespace Havvg\Component\Lifecycle\Event;

use Havvg\Component\Lifecycle\Condition\ConditionCollectionInterface;
use Havvg\Component\Lifecycle\Consequence\ConsequenceCollectionInterface;

interface EventInterface
{
    public function getConditions(): ConditionCollectionInterface;

    public function getConsequences(): ConsequenceCollectionInterface;
}
