<?php
namespace QueryBuilder;

use Config\Connection;
use PDO;

class QueryBuilder 
{
    private $db;

    public function __construct()
    {
        $connection = new Connection();
        $this->db = $connection->getInstance();
    }

    public function insert($table, $data)
    {
        $fields = implode(', ', array_keys($data));
        $placeholders = rtrim(str_repeat('?, ', count($data)), ', ');
        $sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";
        $stmt = $this->db->prepare($sql);
        $values = array_values($data);
        return $stmt->execute($values);
    }

    public function emailExists($table, $email)
    {
        $query = "SELECT COUNT(*) AS count FROM $table WHERE email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$email]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        return $result['count'] > 0;
    }

    public function login($table, $username, $password)
    {
        $sql = "SELECT * FROM $table WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) { return $user; } 
        return false;
    }
    
}