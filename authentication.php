<?php

use Illuminate\Session\Middleware\StartSession;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include 'methods.php';
$authenticate = new Method();
$parameters = json_decode(file_get_contents("php://input"), true);
$authenticate->setUserName($parameters['username']);
$authenticate->setPass($parameters['password']);
$data = $authenticate->Creds();
