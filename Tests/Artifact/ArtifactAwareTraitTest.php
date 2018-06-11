<?php

namespace Havvg\Component\Lifecycle\Tests\Artifact;

use Havvg\Component\Lifecycle\Artifact\ArtifactInterface;
use Havvg\Component\Lifecycle\Tests\Mock\ArtifactAware;

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
        $artifact = \Mockery::mock(ArtifactInterface::class);

        $object = $this->createArtifactAware();

        $object->setArtifact($artifact);
        static::assertSame($artifact, $object->getArtifact());

        $object->setArtifact(null);
        static::assertNull($object->getArtifact());
    }

    private function createArtifactAware()
    {
        return new ArtifactAware();
    }
}
