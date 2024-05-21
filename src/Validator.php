<?php

namespace StringPhp\Validation;

abstract class Validator
{
    public function __construct(
        protected string $message
    ) {
    }

    public function getDefaultErrorMessage(): string
    {
        return $this->message;
    }

    abstract public function validate(mixed $value, callable $fail): void;
}
