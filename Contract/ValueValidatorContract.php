<?php

namespace Qb3ti\ComplexProperty\Contract;

interface ValueValidatorContract
{
    public function validate(mixed $data): bool;
}