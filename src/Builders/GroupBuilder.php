<?php

namespace Builders;

use Validators\GroupValidator;

class GroupBuilder
{
    public function create(
        string $name
    )
    {
        $group['group_name'] = $name;

        $validator = new GroupValidator();

        if (false == $validator->isValid($group))
            return false;

        return $validator->getValidated($group);
    }
}