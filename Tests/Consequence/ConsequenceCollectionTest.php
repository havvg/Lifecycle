<?php

namespace Havvg\Component\Lifecycle\Tests\Consequence;

use Havvg\Component\Lifecycle\Artifact\ArtifactAwareInterface;
use Havvg\Component\Lifecycle\Artifact\ArtifactInterface;
use Havvg\Component\Lifecycle\Consequence\ConsequenceCollection;
use Havvg\Component\Lifecycle\Consequence\ConsequenceInterface;

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
        $artifact = \Mockery::mock(ArtifactInterface::class);

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
        $artifact = \Mockery::mock(ArtifactInterface::class);
        $consequence = \Mockery::mock(implode(',', [ConsequenceInterface::class, ArtifactAwareInterface::class]));

        $consequence
            ->shouldReceive('setArtifact')
            ->once()
            ->with($artifact)
            ->andReturnSelf()
        ;

        $collection = new ConsequenceCollection();
        $collection->addConsequence($consequence);
        $collection->setArtifact($artifact);
    }

    private function createConsequence()
    {
        return $this->getMockForAbstractClass(ConsequenceInterface::class);
    }
}
