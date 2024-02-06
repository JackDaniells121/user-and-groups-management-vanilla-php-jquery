<?php

namespace Models;

class Group extends BasicModel
{
    protected string $tableName = 'user_groups';
    protected array $fields = [
        'group_name',
    ];

    public function removeUserFromGroup($userId, $groupId)
    {
        $query = "DELETE FROM group_user_assignment WHERE user_id = ? AND group_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $userId, $groupId);
        return $stmt->execute();
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