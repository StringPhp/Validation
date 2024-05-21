<?php

namespace StringPhp\Validation;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class FilterVar extends Validator
{
    public function __construct(
        protected string $message,
        protected int $filter,
        protected array|int $options = 0,
    ) {
        parent::__construct($message);
    }

    public function validate(mixed $value, callable $fail): void
    {
        if (filter_var($value, $this->filter, $this->options) === false) {
            $fail($this->message);
        }
    }
}
