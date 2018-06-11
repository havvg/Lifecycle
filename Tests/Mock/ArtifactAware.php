<?php

declare(strict_types=1);

namespace Havvg\Component\Lifecycle\Tests\Mock;

use Havvg\Component\Lifecycle\Artifact\ArtifactAwareInterface;
use Havvg\Component\Lifecycle\Artifact\ArtifactAwareTrait;

final class ArtifactAware implements ArtifactAwareInterface
{
    use ArtifactAwareTrait;
}
