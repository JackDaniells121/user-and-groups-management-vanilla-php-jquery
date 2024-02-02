<?php

namespace Controllers;

use Builders\UserBuilder;
use Models\User;
use Responses\Response;

class UserController extends BaseController
{
    public function add($post)
    {
        $builder = new UserBuilder();
        $input = $builder->create(
            $post['username'],
            $post['password'],
            $post['firstName'],
            $post['lastName'],
            $post['birthDate']
        );
        if (!$input) {
            return new Response(400, 0);
        }
        $user = new User();
        $user->insert($input);
    }

    public function list(array $post)
    {
        $user = new User();
        if (false == empty($post['groupId'])) {
            return new Response(200,
                $user->getUsersFromGroup($post['groupId']));
        }
        else {
            return new Response(200, $user->list());
        }
    }

    public function getUser(array $post)
    {
        $user = new User();
        if (false == empty($post['userId'])) {
            $result = $user->selectRow($post['userId']);
            return new Response(200, $result);
        }
        else {
            return new Response(400);
        }
    }
    public function removeUser(int $id)
    {
        $user = new User();
        $result = $user->remove($id);
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