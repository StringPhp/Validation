<?php

namespace StringPhp\Validation;

class Matches extends Validator
{
    public function __construct(
        string $message = 'Values do not match.',
        public readonly mixed $value = null,
        public readonly bool $strict = true
    ) {
        parent::__construct($message);
    }

    public function validate(mixed $value, callable $fail): void
    {
        if ($this->strict) {
            if ($value !== $this->value) {
                $fail($this->message);
            }

            return;
        }

        if ($value != $this->value) {
            $fail($this->message);
        }
    }
}
