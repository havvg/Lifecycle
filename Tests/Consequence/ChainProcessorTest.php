<?php

namespace Havvg\Component\Lifecycle\Tests\Consequence;

use Havvg\Component\Lifecycle\Consequence\ChainProcessor;

/**
 * @covers \Havvg\Component\Lifecycle\Consequence\ChainProcessor
 */
class ChainProcessorTest extends \PHPUnit_Framework_TestCase
{
    public function testAddProcessor()
    {
        $processor = new ChainProcessor();
        $processor->add($this->getMockProcessor());
    }

    public function testProcessorsAreChained()
    {
        $consequence = $this->getMockConsequence();

        $processor = new ChainProcessor();

        $processor->add($this->getMockProcessor($consequence));
        $processor->add($this->getMockProcessor($consequence));
        $processor->add($this->getMockProcessor($consequence));

        $processor->process($consequence);
    }

    private function getMockConsequence()
    {
        return \Mockery::mock('Havvg\Component\Lifecycle\Consequence\ConsequenceInterface');
    }

    private function getMockProcessor($consequence = null)
    {
        $processor = $this->getMockForAbstractClass('Havvg\Component\Lifecycle\Consequence\ConsequenceProcessorInterface');
        if ($consequence) {
            $processor
                ->expects($this->once())
                ->method('process')
                ->with($consequence);
        }

        return $processor;
    }
}
