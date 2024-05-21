<?php

namespace StringPhp\Validation;

use Attribute;
use Closure;

#[Attribute(Attribute::TARGET_PROPERTY)]
class Callback extends Validator
{
    public function __construct(
        string $message,
        public readonly Closure $callback
    ) {
        parent::__construct($message);
    }

    public function validate(mixed $value, callable $fail): void
    {
        if (!($this->callback)($value)) {
            $fail($this->message);
        }
    }
}
