<?php

namespace Validators;

class UserValidator extends BaseValidator
{

    public function isValid(array $user): bool
    {
        $required = [
            'username',
            'password',
            'first_name',
            'last_name',
            'birth_date'
        ];

        $this->checkRequired($required, $user);

        return !(bool)$this->errors;
    }

    public function getValidated(array $user): array
    {
        $fields = [
            'username',
            'password',
            'first_name',
            'last_name',
            'birth_date'
        ];

        $this->normalize($fields, $user);

        return $user;
    }
}

