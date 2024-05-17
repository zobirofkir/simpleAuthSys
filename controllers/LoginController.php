<?php
namespace Controller;

use Model\Login;

class LoginController 
{
    private $model;
    public function __construct()
    {
        $this->model = new Login();
    }

    public function login()
    {
        if (!$_SERVER['REQUEST_METHOD'] === "POST")
        {
            return false;
        }
        $data = file_get_contents('php://input');
        $array = json_decode($data, true);
        $username = htmlspecialchars($array['username']);
        $password = $array['password'];
        $handleLogin = $this->model->login($username, $password);
        if ($handleLogin)
        {
            $response = ['success'=>true];
            echo json_encode($response);
            return;
        }
        $response = ['success'=>false];
        echo json_encode($response);
        return;
    }
}