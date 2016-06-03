<?php

namespace Havvg\Component\Lifecycle\Consequence;

interface ConsequenceCollectionInterface extends \Traversable, \Countable
{
    /**
     * Adds a consequence to this collection.
     *
     * @param ConsequenceInterface $consequence
     *
     * @return ConsequenceCollectionInterface
     */
    public function addConsequence(ConsequenceInterface $consequence);
}
