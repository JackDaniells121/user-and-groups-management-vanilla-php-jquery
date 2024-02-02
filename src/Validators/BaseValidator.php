<?php

namespace Validators;
class BaseValidator
{
    public array $errors = [];

    public function checkRequired(array $required, array $array)
    {

        foreach ($required as $property) {
            if (empty($array[$property])) {
                $this->errors[$property] = "$property is required.";
            }
        }
    }

    public function normalize(array $fields, array &$array)
    {
        foreach ($fields as $property) {
            $array[$property] = htmlspecialchars($array[$property], ENT_QUOTES, 'UTF-8');
        }
        return $array;
    }
}