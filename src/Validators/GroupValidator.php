<?php

namespace Validators;

class GroupValidator extends BaseValidator
{
    public function isValid(array $group): bool
    {
        $required = [
            'group_name',
        ];

        $this->checkRequired($required, $group);

        return !(bool)$this->errors;
    }

    public function getValidated(array $group)
    {
        $fields = [
            'group_name',
        ];

        $this->normalize($fields, $group);

        return $group;
    }
}

