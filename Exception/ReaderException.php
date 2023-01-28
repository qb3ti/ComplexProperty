<?php

namespace Qb3ti\ComplexProperty\Exception;

use Exception;

class ReaderException extends Exception
{
    public static function ClassNotFound(string $className): ReaderException
    {
        return new self(sprintf("Class `%s` not found.", $className));
    }
}