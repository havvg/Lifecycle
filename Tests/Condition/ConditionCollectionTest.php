<?php

namespace Havvg\Component\Lifecycle\Tests\Condition;

use Havvg\Component\Lifecycle\Condition\ConditionCollection;

/**
 * @covers \Havvg\Component\Lifecycle\Condition\ConditionCollection
 */
class ConditionCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructEmpty()
    {
        $collection = new ConditionCollection();

        static::assertCount(0, $collection);
    }

    /**
     * @depends testConstructEmpty
     */
    public function testAddCondition()
    {
        $collection = new ConditionCollection();

        static::assertSame($collection, $collection->addCondition($this->createCondition()));
        static::assertCount(1, $collection);
    }

    /**
     * @depends testAddCondition
     */
    public function testIterator()
    {
        $condition = $this->createCondition();

        $collection = new ConditionCollection();
        $collection->addCondition($condition);

        static::assertContains($condition, $collection);
    }

    /**
     * @depends testConstructEmpty
     */
    public function testIsArtifactAware()
    {
        $artifact = \Mockery::mock('Havvg\Component\Lifecycle\Artifact\ArtifactInterface');

        $collection = new ConditionCollection();
        $collection->setArtifact($artifact);

        static::assertSame($artifact, $collection->getArtifact());
    }

    /**
     * @depends testAddCondition
     * @depends testIsArtifactAware
     */
    public function testSettingArtifactAppliesToConditions()
    {
        $artifact = \Mockery::mock('Havvg\Component\Lifecycle\Artifact\ArtifactInterface');
        $condition = \Mockery::spy('Havvg\Component\Lifecycle\Condition\ConditionInterface, Havvg\Component\Lifecycle\Artifact\ArtifactAwareInterface');

        $collection = new ConditionCollection();
        $collection->addCondition($condition);
        $collection->setArtifact($artifact);

        $condition
            ->shouldHaveReceived('setArtifact')
            ->once()
            ->with($artifact)
        ;
    }

    private function createCondition()
    {
        return $this->getMockForAbstractClass('Havvg\Component\Lifecycle\Condition\ConditionInterface');
    }
}
