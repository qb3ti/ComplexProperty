<?php

namespace Qb3ti\ComplexProperty;

use Qb3ti\ComplexProperty\Contract\ValueValidatorContract;
use Qb3ti\ComplexProperty\Exception\ReaderException;
use ReflectionClass;

use function in_array;
use function class_implements;
use function class_exists;

class AttributeReader
{
    private ReflectionClass $reflection;
    
    public function __construct(string $className)
    {
        if (class_exists($className) == false) {
            throw ReaderException::ClassNotFound($className);
        }

        $this->reflection = new ReflectionClass($className);
    }
    
    /**
     * Reads attributes that implement ValueValidatorContract from property
     * 
     * @param string $propertyName
     * 
     * @return ValueValidatorContract[]
     */
    public function getAttributes(string $propertyName): array
    {
        $result = [];

        $attributes = $this->reflection->getProperty($propertyName)->getAttributes();

        foreach ($attributes as $attribute) {
            if (in_array(ValueValidatorContract::class, class_implements($attribute->getName()))) {
                $result[] = $attribute->newInstance();
            }
        }

        return $result;
    }
}