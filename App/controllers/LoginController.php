<?php
namespace Controller;

use Controller\Controller;

class LoginController extends Controller
{
    
    public function login()
    {      
        parent::login();  
        $username = htmlspecialchars($this->array["username"]);
        $password = $this->array["password"];
        $handleLogin = $this->model->login($username, $password);
        if ($handleLogin)
        {
            $this->handleRequest->handleMessage(true);
            return;
        }
        $this->handleRequest->handleMessage(false);
        return;
    }
}
