<?php

namespace StringPhp\Validation;

use ReflectionAttribute;
use ReflectionClass;
use Throwable;

function getValidators(string $class): array
{
    $reflection = (new ReflectionClass($class));
    $properties = $reflection->getProperties();

    $validators = [];
    foreach ($properties as $property) {
        $key = $property->getName();

        $validators[$key] = array_map(
            static fn (ReflectionAttribute $attribute) => $attribute->newInstance(),
            $property->getAttributes(Validator::class, ReflectionAttribute::IS_INSTANCEOF)
        );
    }

    return $validators;
}

function validateArray(array $body, array $data): array
{
    $errors = [];

    foreach ($body as $property => $validators) {
        /** @var Validator $validator */
        foreach ($validators as $validator) {
            if (!isset($data[$property])) {
                $data[$property] = null;
            }

            try {
                $validator->validate($data[$property], static function (string $message) use (&$errors, $property) {
                    $errors[$property] ??= [];
                    $errors[$property][] = $message;
                });
            } catch (Throwable $e) {
                $errors[] = $e->getMessage();
            }
        }
    }

    return $errors;
}
