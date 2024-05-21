<?php

namespace StringPhp\Validation;

use StringPhp\Models\Model;

abstract class ValidatableModel extends Model {
    public function validate(): array
    {
        return validateArray(
            getValidators(static::class),
            $this->jsonSerialize()
        );
    }
}