<?php

namespace Havvg\Component\Lifecycle\Tests\Artifact;

use Havvg\Component\Lifecycle\Artifact\ArtifactAwareTrait;

/**
 * @covers \Havvg\Component\Lifecycle\Artifact\ArtifactAwareTrait
 */
class ArtifactAwareTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructWithoutArtifact()
    {
        $object = $this->createArtifactAware();

        static::assertNull($object->getArtifact());
    }

    /**
     * @depends testConstructWithoutArtifact
     */
    public function testSetAndUnsetArtifact()
    {
        $artifact = \Mockery::mock('Havvg\Component\Lifecycle\Artifact\ArtifactInterface');

        $object = $this->createArtifactAware();

        $object->setArtifact($artifact);
        static::assertSame($artifact, $object->getArtifact());

        $object->setArtifact(null);
        static::assertNull($object->getArtifact());
    }

    /**
     * @return ArtifactAwareTrait
     */
    private function createArtifactAware()
    {
        return $this->getMockForTrait('Havvg\Component\Lifecycle\Artifact\ArtifactAwareTrait');
    }
}
