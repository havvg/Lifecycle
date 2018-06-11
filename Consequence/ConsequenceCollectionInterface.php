<?php

namespace Havvg\Component\Lifecycle\Consequence;

interface ConsequenceCollectionInterface extends \Traversable, \Countable
{
    public function addConsequence(ConsequenceInterface $consequence): ConsequenceCollectionInterface;
}
