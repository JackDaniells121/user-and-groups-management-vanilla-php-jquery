<?php

namespace Controllers;

use Builders\UserBuilder;
use Models\User;
use Responses\Response;

class UserController extends BaseController
{
    public function add()
    {
        $builder = new UserBuilder();
        $input = $builder->create(
            $this->post['username'],
            $this->post['password'],
            $this->post['firstName'],
            $this->post['lastName'],
            $this->post['birthDate']
        );
        if (!$input) {
            return new Response(400, ['message'=>'validation failed']);
        }

        $user = new User();
        $result = $user->insert($input);

        if (!$result) {
            return new Response(400, ['message'=>'Not unique username']);
        }

        return new Response(200);
    }

    public function list()
    {
        $user = new User();
        if (false == empty($this->post['groupId'])) {
            return new Response(200,
                $user->getUsersFromGroup($this->post['groupId']));
        }
        else {
            return new Response(200, $user->list());
        }
    }

    public function getUser()
    {
        $user = new User();
        if (false == empty($this->post['userId'])) {
            $result = $user->selectRow($this->post['userId']);
            return new Response(200, $result);
        }
        else {
            return new Response(400);
        }
    }
    public function removeUser()
    {
        $user = new User();
        $result = $user->remove($this->post['id']);
        return new Response(200, $result);
    }

    public function editUser()
    {
        $builder = new UserBuilder();
        $input = $builder->create(
            $this->post['userName'],
            $this->post['password'],
            $this->post['firstName'],
            $this->post['lastName'],
            $this->post['birthDate']
        );
        if (!$input) {
            return new Response(400, 0);
        }
        $input['id'] = $this->post['userId'];
        $user = new User();
        $user->update($input);
    }

    public function addUserToGroup()
    {
        $user = new User();
        $result = $user->addToGroup($this->post);
        if ($result) {
            return new Response(200, $result);
        }
        else {
            return new Response(400);
        }
    }

    public function getUserGroups()
    {
        $user = new User();
        $result = $user->getUserGroups($this->post);
        return new Response(200, $result);
    }
}