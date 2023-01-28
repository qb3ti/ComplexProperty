<?php

namespace Qb3ti\ComplexProperty\Exception;

use Exception;

use function \sprintf;

class PropertyNotFoundException extends Exception
{
    public static function NotFound(string $className, string $propertyName): PropertyNotFoundException
    {
        return new self(sprintf("Property not found in %s:%s", $className, $propertyName));
    }
}