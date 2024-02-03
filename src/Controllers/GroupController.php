<?php

namespace Controllers;
use Builders\GroupBuilder;
use Models\Group;
use Responses\Response;

class GroupController extends BaseController
{
    public function add()
    {
        $builder = new GroupBuilder();
        $input = $builder->create(
            $this->post['groupname'],
        );
        if (!$input) {
            return new Response(400,['message'=>'validation failed']);
        }

        $group = new Group();
        $result = $group->insert($input);

        if (false == $result) {
            return new Response(400, ['message'=>'failed to insert new group']);
        }

        return new Response(200);
    }

    public function list()
    {
        $group = new Group();
        return new Response(200, $group->listExtended());
    }

    public function removeGroup()
    {
        $group = new Group();
        if (false == empty($this->post['id'])) {
            $result = $group->remove($this->post['id']);
            return new Response(200, $result);
        }
        return new Response(400);
    }

    public function removeUserFromGroup()
    {
        if (false == empty($this->post['userId']) &&
            false == empty($this->post['groupId'])) {

            $userId = $this->post['userId'];
            $groupId = $this->post['groupId'];
            $group = new Group();
            $result = $group->removeUserFromGroup($userId, $groupId);
            return new Response(200, $result);
        }
        return new Response(400);
    }

    public function editGroup()
    {
        $input['id'] = $this->post['groupId'];
        $input['group_name'] = $this->post['groupName'];
        $group = new Group();
        $result = $group->update($input);
        return new Response(200, $result);
    }

    public function getGroup()
    {
        $groupId =$this->post['groupId'];
        $group = new Group();
        return new Response(200, $group->selectRow($groupId));
    }
}