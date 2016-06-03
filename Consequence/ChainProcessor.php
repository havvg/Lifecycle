<?php

namespace Havvg\Component\Lifecycle\Consequence;

class ChainProcessor implements ConsequenceProcessorInterface
{
    /**
     * @var ConsequenceProcessorInterface[]
     */
    private $processors = [];

    /**
     * Adds a processor to utilize.
     *
     * @param ConsequenceProcessorInterface $processor
     *
     * @return ChainProcessor
     */
    public function add(ConsequenceProcessorInterface $processor)
    {
        $this->processors[] = $processor;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ConsequenceInterface $consequence)
    {
        foreach ($this->processors as $eachProcessor) {
            $eachProcessor->process($consequence);
        }
    }
}
