<?php

namespace Havvg\Component\Lifecycle\Tests\Consequence;

use Havvg\Component\Lifecycle\Consequence\ConsequenceCollection;

/**
 * @covers \Havvg\Component\Lifecycle\Consequence\ConsequenceCollection
 */
class ConsequenceCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructEmpty()
    {
        $collection = new ConsequenceCollection();

        static::assertCount(0, $collection);
    }

    /**
     * @depends testConstructEmpty
     */
    public function testAddConsequence()
    {
        $collection = new ConsequenceCollection();

        static::assertSame($collection, $collection->addConsequence($this->createConsequence()));
        static::assertCount(1, $collection);
    }

    /**
     * @depends testAddConsequence
     */
    public function testIterator()
    {
        $consequence = $this->createConsequence();

        $collection = new ConsequenceCollection();
        $collection->addConsequence($consequence);

        static::assertContains($consequence, $collection);
    }

    /**
     * @depends testConstructEmpty
     */
    public function testIsArtifactAware()
    {
        $artifact = \Mockery::mock('Havvg\Component\Lifecycle\Artifact\ArtifactInterface');

        $collection = new ConsequenceCollection();
        $collection->setArtifact($artifact);

        static::assertSame($artifact, $collection->getArtifact());
    }

    /**
     * @depends testAddConsequence
     * @depends testIsArtifactAware
     */
    public function testSettingArtifactAppliesToConsequences()
    {
        $artifact = \Mockery::mock('Havvg\Component\Lifecycle\Artifact\ArtifactInterface');
        $consequence = \Mockery::spy('Havvg\Component\Lifecycle\Consequence\ConsequenceInterface, Havvg\Component\Lifecycle\Artifact\ArtifactAwareInterface');

        $collection = new ConsequenceCollection();
        $collection->addConsequence($consequence);
        $collection->setArtifact($artifact);

        $consequence
            ->shouldHaveReceived('setArtifact')
            ->once()
            ->with($artifact)
        ;
    }

    private function createConsequence()
    {
        return $this->getMockForAbstractClass('Havvg\Component\Lifecycle\Consequence\ConsequenceInterface');
    }
}
