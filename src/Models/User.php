<?php

namespace Models;

use http\Env\Response;

class User extends BasicModel
{
    protected string $tableName = 'users';
    protected array $fields = [
        'username',
        'password',
        'first_name',
        'last_name',
        'birth_date'
    ];

    public function getUsersFromGroup($groupId)
    {
        $query = "SELECT * FROM `users` t1 
                    JOIN `group_user_assignment` t2 ON t2.user_id = t1.id 
                    -- JOIN `users` 
                    WHERE t2.`group_id` = $groupId";

        $result = $this->conn->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addToGroup($post)
    {
        $groupId = $post['groupId'];
        $userId = $post['userId'];
        $userGroups = $this->getUserGroups($post);
        $userGroupsIds = array_column($userGroups, 'group_id');

        if (!in_array($post['groupId'], $userGroupsIds)) {
            $query = "INSERT INTO group_user_assignment (group_id, user_id) VALUES ($groupId, $userId)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
        }
        else {
            return false;
        }
    }

    public function getUserGroups($post)
    {
        $userId = $post['userId'];
        $query = "SELECT t2.group_name, t1.group_id FROM group_user_assignment t1
                    JOIN user_groups t2 ON t2.id = t1.group_id
                    WHERE t1.`user_id` = $userId";

        $result = $this->conn->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

}