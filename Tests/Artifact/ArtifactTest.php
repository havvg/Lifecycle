<?php

namespace Havvg\Component\Lifecycle\Tests\Artifact;

use Havvg\Component\Lifecycle\Artifact\Artifact;

/**
 * @covers \Havvg\Component\Lifecycle\Artifact\Artifact
 */
class ArtifactTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructEmptyData()
    {
        $artifact = new Artifact();

        static::assertInternalType('array', $artifact->all());
        static::assertCount(0, $artifact->all());
    }

    /**
     * @depends testConstructEmptyData
     */
    public function testGetUnsetDataReturnsNull()
    {
        $artifact = new Artifact();

        static::assertNull($artifact->get('invalid'));
    }

    /**
     * @depends testConstructEmptyData
     */
    public function testGetSetData()
    {
        $artifact = new Artifact();

        $artifact->set('key', 'value');
        static::assertEquals('value', $artifact->get('key'));

        $artifact->set('key', 'another_value');
        static::assertEquals('another_value', $artifact->get('key'));
    }

    /**
     * @depends testGetSetData
     */
    public function testAllWithData()
    {
        $artifact = new Artifact();
        $artifact->set('key', 'value');

        static::assertEquals(['key' => 'value'], $artifact->all());
    }
}
