<?php

namespace Builders;

use Validators\UserValidator;

class UserBuilder
{
    public function create(
        string $username,
        string $password,
        string $first_name,
        string $last_name,
        string $birth_date
    )
    {
        $user['username'] = $username;
        $user['password'] = $password;
        $user['first_name'] = $first_name;
        $user['last_name'] = $last_name;
        $user['birth_date'] = $birth_date;

        $validator = new UserValidator();
        if (false == $validator->isValid($user))
            return false;

        return $validator->getValidated($user);
    }
}