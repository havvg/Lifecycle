<?php

namespace Havvg\Component\Lifecycle\Event;

use Havvg\Component\Lifecycle\Condition\ConditionCollectionInterface;
use Havvg\Component\Lifecycle\Consequence\ConsequenceCollectionInterface;

interface EventInterface
{
    /**
     * Returns the conditions to trigger this event.
     *
     * @return ConditionCollectionInterface
     */
    public function getConditions();

    /**
     * Returns the consequences that arise from this event.
     *
     * @return ConsequenceCollectionInterface
     */
    public function getConsequences();
}
