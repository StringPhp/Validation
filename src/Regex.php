<?php

namespace StringPhp\Validation;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Regex extends Validator
{
    public function __construct(
        string $message,
        public readonly string $rule
    ) {
        parent::__construct($message);
    }

    public function validate(mixed $value, callable $fail): void
    {
        if (!is_string($value) || preg_match($this->rule, $value) !== 1) {
            $fail($this->message);
        }
    }
}
