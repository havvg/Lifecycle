<?php

namespace Havvg\Component\Lifecycle\Tests\Assert;

class PHPUnit extends \PHPUnit_Framework_Assert
{
    /**
     * Evaluates a constraint for the given value.
     *
     * @param mixed                         $value
     * @param \PHPUnit_Framework_Constraint $constraint
     * @param string                        $message
     *
     * @return bool
     */
    public static function evaluate($value, \PHPUnit_Framework_Constraint $constraint, $message = '')
    {
        return $constraint->evaluate($value, $message, true);
    }
}
