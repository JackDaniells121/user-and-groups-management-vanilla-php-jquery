<?php

namespace Controllers;
use Builders\GroupBuilder;
use Models\Group;
use Responses\Response;

class GroupController extends BaseController
{
    public function add($post)
    {
        $builder = new GroupBuilder();
        $input = $builder->create(
            $post['groupname'],
        );
        if (!$input) {
            return new Response(400, 0);
        }
        $group = new Group();
        $group->insert($input);
    }

    public function list()
    {
        $group = new Group();
//        return new Response(200, $group->list());
        return new Response(200, $group->listExtended());
    }

    public function removeGroup($id)
    {
        $group = new Group();
        $result = $group->remove($id);
        return new Response(200, $result);
    }

    public function removeUserFromGroup($post)
    {
        if (false == empty($post['userId']) &&
            false == empty($post['groupId'])) {

            $userId = $post['userId'];
            $groupId = $post['groupId'];
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