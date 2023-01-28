<?php

use PHPUnit\Framework\TestCase;
use Qb3ti\ComplexProperty\AbstractComplexProperty;
use Qb3ti\ComplexProperty\AttributeReader;
use Qb3ti\ComplexProperty\Exception\InvalidValueException;
use Qb3ti\ComplexProperty\Exception\PropertyNotFoundException;
use Qb3ti\ComplexProperty\Trait\ComplexPropertyTrait;
use Qb3ti\ComplexProperty\Validator\RegexValidator;
use Qb3ti\ComplexProperty\Validator\StringRangeValidator;

class ComplexPropertyTest extends TestCase
{
    public function testAssignValue()
    {
        $testObject = new class extends AbstractComplexProperty {

            #[StringRangeValidator(32, 2)]
            protected string $name;

            #[StringRangeValidator(32)]
            protected string $title;

            #[RegexValidator("/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/")]
            protected string $email;

            public function getName(): string
            {
                return $this->name;
            }

            public function getTitle(): string
            {
                return $this->title;
            }

            public function getEmail(): string
            {
                return $this->email;
            }
        };

        $testObject->name = "test";
        $testObject->title = "";
        $testObject->email = "test@test.com";

        $this->assertEquals( [
            "test",
            "",
            "test@test.com"
        ], [
            $testObject->getName(),
            $testObject->getTitle(),
            $testObject->getEmail()
        ]);
    }

    public function testAssignInvalidValue()
    {
        $this->expectException(InvalidValueException::class);

        $testObject = new class extends AbstractComplexProperty {

            #[StringRangeValidator(32, 2)]
            protected string $name;

            public function getName(): string
            {
                return $this->name;
            }
        };

        $testObject->name = "T";
    }

    public function testPropertyNotFound()
    {
        $this->expectException(PropertyNotFoundException::class);

        $testObject = new class extends AbstractComplexProperty {};

        $testObject->name = "test";
    }
} 