<?php
namespace Model;

use Model\Model;

class Login extends Model
{
    private $table = 'users';

    public function login($username, $password)
    {
        ['username'=>$username,'password'=>$password ];

        return $this->loginUser($this->table, $username, $password);
    }
}