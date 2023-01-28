<?php

namespace Qb3ti\ComplexProperty\Validator;

use Attribute;
use Qb3ti\ComplexProperty\Contract\ValueValidatorContract;
use Qb3ti\ComplexProperty\Exception\InvalidTypeException;

use function is_numeric;
use function is_string;
use function preg_match;

#[Attribute(Attribute::TARGET_PROPERTY)]
class RegexValidator implements ValueValidatorContract 
{
    public function __construct(private string $regex) { }

    public function validate(mixed $data): bool
    {
        if (is_string($data) == false && is_numeric($data)) {
            throw InvalidTypeException::InvalidType("string|number", gettype($data));
        }

        return preg_match($this->regex, $data);
    }
}