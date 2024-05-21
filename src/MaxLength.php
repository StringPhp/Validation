<?php

namespace StringPhp\Validation;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
class MaxLength extends Validator
{
    /**
     * @param string $message You can use {max} in the message to show the max length
     */
    public function __construct(
        string $message,
        public readonly int $max
    ) {
        parent::__construct(str_replace('{max}', $max, $message));
    }

    /**
     * @param string $value
     */
    public function validate(mixed $value, callable $fail): void
    {
        if (empty($value)) {
            return;
        }

        if (mb_strlen($value) > $this->max) {
            $fail($this->message);
        }
    }
}
