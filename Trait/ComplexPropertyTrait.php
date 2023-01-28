<?php

namespace Qb3ti\ComplexProperty\Trait;

use Qb3ti\ComplexProperty\Exception\InvalidValueException;
use Qb3ti\ComplexProperty\Exception\PropertyNotFoundException;
use Qb3ti\ComplexProperty\AttributeReader;

trait ComplexPropertyTrait
{
    private ?AttributeReader $attributeReader;

    public function set(string $propertyName, mixed $value) 
    {
        if (property_exists($this, $propertyName) == false) {
            throw PropertyNotFoundException::NotFound($this::class, $propertyName);
        }

        if ($this->attributeReader) {
            $attributes = $this->attributeReader->getAttributes($propertyName);
            foreach ($attributes as $attribute) {
                if ($attribute->validate($value) == false) {
                    throw InvalidValueException::InvalidValue($this::class, $propertyName);
                }
            }
        } 

        $this->{$propertyName} = $value;
    }
}