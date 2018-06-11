<?php

namespace Havvg\Component\Lifecycle\Tests\Condition;

use Havvg\Component\Lifecycle\Artifact\ArtifactAwareInterface;
use Havvg\Component\Lifecycle\Artifact\ArtifactInterface;
use Havvg\Component\Lifecycle\Condition\ConditionCollection;
use Havvg\Component\Lifecycle\Condition\ConditionInterface;

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
        $artifact = \Mockery::mock(ArtifactInterface::class);

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
        $artifact = \Mockery::mock(ArtifactInterface::class);
        $condition = \Mockery::mock(implode(',', [ConditionInterface::class, ArtifactAwareInterface::class]));

        $condition
            ->shouldReceive('setArtifact')
            ->once()
            ->with($artifact)
            ->andReturnSelf()
        ;

        $collection = new ConditionCollection();
        $collection->addCondition($condition);
        $collection->setArtifact($artifact);
    }

    private function createCondition()
    {
        return $this->getMockForAbstractClass(ConditionInterface::class);
    }
}
