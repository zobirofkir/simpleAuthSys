<?php
namespace Controller;

use HandleError\HandleError;
use Model\Login;
use Model\Register;

class Controller 
{
    protected $model;
    protected array $array = [];
    protected $data;
    protected $db;
    protected $handleRequest;

    public function __construct()
    {
        $this->model = new Login();
        $this->db = new Register();  
        $this->handleRequest = new HandleError(); 

    }

    public function create()
    {
        if (!$_SERVER['REQUEST_METHOD'] === 'POST')
        {
            $response = ['success' => false];
            echo json_encode($response);
            return;
        }
        $this->data = file_get_contents("php://input");
        $this->array = json_decode($this->data, true);
    }

    public function login()
    {
        if (!$_SERVER['REQUEST_METHOD'] === "POST")
        {
            return false;
        }
        $this->data = file_get_contents('php://input');
        $this->array = json_decode($this->data, true);
    }
}