<?php
namespace Model;

use QueryBuilder\QueryBuilder;

class Model 
{
    private $query;
    public function __construct()
    {
        $this->query = new QueryBuilder();
    }
    public function register($table, $data)
    {
        return $this->query->insert($table, $data);
    }

    public function emailExist($table, $email)
    {
        return $this->query->emailExists($table, $email);
    }

    public function loginUser($table, $username, $password)
    {
        return $this->query->login($table, $username, $password);
    }

}