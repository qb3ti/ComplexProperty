<?php

namespace Qb3ti\ComplexProperty;

use Qb3ti\ComplexProperty\Contract\ComplexPropertyContract;
use Qb3ti\ComplexProperty\Trait\ComplexPropertyTrait;

abstract class AbstractComplexProperty implements ComplexPropertyContract
{
    use ComplexPropertyTrait;

    public function __construct()
    {
        $this->attributeReader = new AttributeReader($this::class);
    }

    public function __set(string $propertyName, mixed $value)
    {
        $this->set($propertyName, $value);
    }
}