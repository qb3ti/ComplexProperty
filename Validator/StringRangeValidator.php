<?php

namespace Qb3ti\ComplexProperty\Validator;

use Attribute;
use Qb3ti\ComplexProperty\Contract\ValueValidatorContract;
use Qb3ti\ComplexProperty\Exception\InvalidTypeException;

use function is_string;
use function strlen;

#[Attribute(Attribute::TARGET_PROPERTY)]
class StringRangeValidator implements ValueValidatorContract 
{
    public function __construct(private int $maxRange, private int $minRange = 0) { }

    public function validate(mixed $data): bool
    {
        if (is_string($data) == false) {
            throw InvalidTypeException::InvalidType("string", gettype($data));
        }

        $length = strlen($data);

        return $length >= $this->minRange && $length <= $this->maxRange;
    }
}