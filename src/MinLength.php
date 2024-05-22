<?php

namespace StringPhp\Validation;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class MinLength extends Validator
{
    /**
     * @param string $message You can use {min} in the message to show the min length
     */
    public function __construct(
        string $message,
        public readonly int $min
    ) {
        parent::__construct(str_replace('{min}', $min, $message));
    }

    public function validate(mixed $value, callable $fail): void
    {
        if (mb_strlen($value) < $this->min) {
            $fail($this->message);
        }
    }
}
