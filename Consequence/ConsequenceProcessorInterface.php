<?php

namespace Havvg\Component\Lifecycle\Consequence;

interface ConsequenceProcessorInterface
{
    /**
     * Processes the given consequence.
     *
     * @param ConsequenceInterface $consequence
     */
    public function process(ConsequenceInterface $consequence);
}
