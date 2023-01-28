<?php

namespace Qb3ti\ComplexProperty\Contract;

interface ComplexPropertyContract
{
    /**
     * Assings value to property
     * 
     * @var string $propertyName
     * @var mixed $value
     * 
     * @throws ComplexPropertyException If passed value is not assignable to property
     * @return void
     */
    public function set(string $propertyName, mixed $value);
}