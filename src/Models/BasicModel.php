<?php

namespace Models;
use mysqli;
require "config.php";

class BasicModel
{
    protected $conn;
    protected string $tableName;
    protected array $fields = [];

    public function __construct()
    {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function selectRow($id)
    {
        $query = "SELECT * FROM $this->tableName WHERE id = $id";

        $result = $this->conn->query($query);

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function list()
    {
        $result = $this->conn->query("SELECT * FROM $this->tableName");
        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function insert($array)
    {
        $fieldNames = rtrim(implode(',', array_keys($array)), ',');
        $values = rtrim(str_repeat('?,',count($array)),',');
        $statement = "INSERT INTO $this->tableName ($fieldNames) VALUES ($values)";

        $stmt = $this->conn->prepare($statement);
        $stmt->bind_param(
            str_repeat('s', count($array)),
            ...array_values($array)
        );

        return $stmt->execute();
    }

    public function remove($id)
    {
        return $this->conn->query("DELETE FROM $this->tableName WHERE id = $id");
    }

    // Edit user
    public function update($array)
    {
        $id = $array['id'];
        unset($array['id']);

        $fieldNames = rtrim(implode('=?,', array_keys($array)), ',');
        $values = rtrim(str_repeat('?,',count($array)),',');
        $statement = "UPDATE $this->tableName SET $fieldNames =? WHERE id=$id";
        $stmt = $this->conn->prepare($statement);

        $stmt->bind_param(
            str_repeat('s', count($array)),
            ...array_values($array)
        );
        return $stmt->execute();
    }


    public function __destruct()
    {
        // Close the database connection
        function closeConnection()
        {
            global $conn;
            $conn->close();
        }
    }
}