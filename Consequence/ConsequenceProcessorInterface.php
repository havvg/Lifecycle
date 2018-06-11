<?php

namespace Havvg\Component\Lifecycle\Consequence;

interface ConsequenceProcessorInterface
{
    public function process(ConsequenceInterface $consequence): void;
}
