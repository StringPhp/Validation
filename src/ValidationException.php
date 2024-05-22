<?php

namespace StringPhp\Validation;

use Exception;

class ValidationException extends Exception
{
    public function __construct(
        public readonly array $errors
    ) {
        parent::__construct();
    }
}
