<?php

namespace Models;

class Group extends BasicModel
{
    public string $tableName = 'user_groups';
    public array $fields = [
        'group_name',
    ];

    public function removeUserFromGroup($userId, $groupId)
    {
        return $this->conn->query("DELETE FROM group_user_assignment WHERE user_id = $userId AND group_id = $groupId");
    }

    public function listExtended()
    {
        $query = "SELECT *, 
                    (SELECT COUNT(*) FROM group_user_assignment as t2 WHERE t2.group_id = t1.id) AS memberCount 
                    FROM `user_groups` as t1";

        $result = $this->conn->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

}