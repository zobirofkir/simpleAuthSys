<?php

use Config\Connection;
use Controller\LoginController;
use Controller\RegisterController;

error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/vendor/autoload.php';

class Index
{
    private $controller;
    private $login;
    public function __construct()
    {
        $this->controller = new RegisterController();
        $this->login = new LoginController();
    }

    public function register() { if ($_SERVER['REQUEST_URI'] === '/users/register') { $this->controller->create(); } }
    public function log() { if ($_SERVER['REQUEST_URI'] === '/users/login') { $this->login->login(); } }
}

$store = new Index();
$store->register();
$store->log();