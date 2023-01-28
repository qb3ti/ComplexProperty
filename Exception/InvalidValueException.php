<?php

namespace Qb3ti\ComplexProperty\Exception;

use Exception;

use function \sprintf;

class InvalidValueException extends Exception
{
    public static function InvalidValue(string $className, string $propertyName): InvalidValueException
    {
        return new self(sprintf("Tried to assign an invalid value to variable %s:%s", $className, $propertyName));
    }
}