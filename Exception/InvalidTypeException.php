<?php

namespace Qb3ti\ComplexProperty\Exception;

use Exception;

class InvalidTypeException extends Exception
{
    public static function InvalidType(string $expected, string $got): InvalidTypeException
    {
        return new self(sprintf("Invalid type. Expected `%s` got `%s`", $expected, $got));
    }
}