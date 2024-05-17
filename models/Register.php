<?php
namespace Model;

use Model\Model;

class Register extends Model
{
    private $table = 'users';

    public function create($username, $email, $password)
    {
        $fields = [
            'username' => $username,
            'email' => $email,
            'password' => $password
        ];

        return $this->store($this->table, $fields);
    }

    public function existingEmail($email)
    {
        return $this->emailExist($this->table, $email);
    }

}
?>
