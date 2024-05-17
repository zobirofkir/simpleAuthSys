<?php
namespace Controller;

use Model\Register;

class RegisterController 
{
    private $db;

    private $username;
    private $email;
    private $password;

    public function __construct()
    {
        $this->db = new Register();   
    }

    public function create()
    {
        if (!$_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $response = ['success'=>false];
            echo json_encode($response);
            return;
        }

        $data = file_get_contents("php://input");
        $array = json_decode($data, true);

        if (!isset($array['username']) && !isset($array['email']) && !isset($array['password']))
        {
            $response = ['success'=>false];
            echo json_encode($response);
            return;
        }
        
        $this->username = htmlentities($array["username"]);
        $this->email = htmlentities($array["email"]);
        $this->password = password_hash($array["password"], true);

        if ($this->db->existingEmail($this->email)) {
            $response = ['success'=>false, 'message'=>'Email already exists'];
            echo json_encode($response);
            return;
        }

        if (empty($this->username) || empty($this->email) || empty($this->password))
        {
            $response = ['success'=>false, 'message'=>'All fields are required'];
            echo json_encode($response);
            return;
        }

        $handle = $this->db->create($this->username, $this->email, $this->password);

        if ($handle)
        {
            $response = ['success'=>true];
            echo json_encode($response);
            return;
        }

    }
}