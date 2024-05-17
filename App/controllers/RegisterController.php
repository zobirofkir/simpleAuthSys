<?php
namespace Controller;

use Controller\Controller;
use HandleError\HandleError;
use Model\Register;

class RegisterController extends Controller
{
    protected $username;
    protected $email;
    protected $password;

    public function create()
    {
        parent::register();
        
        $this->username = htmlspecialchars($this->array["username"]);
        $this->email = htmlspecialchars($this->array["email"]);
        $this->password = password_hash($this->array["password"], true);

        if ($this->db->existingEmail($this->email)) {
            $this->handleRequest->handleMessage(false);
            return;
        }

        $handle = $this->db->create($this->username, $this->email, $this->password);

        if ($handle)
        {
            $this->handleRequest->handleMessage(true);
            $this->sendEm->sendEmail();
            return;
        }
    }
}