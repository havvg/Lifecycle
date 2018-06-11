<?php

namespace Havvg\Component\Lifecycle\Consequence;

class ChainProcessor implements ConsequenceProcessorInterface
{
    /**
     * @var ConsequenceProcessorInterface[]
     */
    private $processors = [];

    public function add(ConsequenceProcessorInterface $processor): ChainProcessor
    {
        $this->processors[] = $processor;

        return $this;
    }

    public function process(ConsequenceInterface $consequence): void
    {
        foreach ($this->processors as $eachProcessor) {
            $eachProcessor->process($consequence);
        }
    }
}
