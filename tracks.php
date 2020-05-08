<?php
use Illuminate\Session\Middleware\StartSession;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
include 'methods.php';
$authenticate = new Method();
$data = $authenticate->BeforeLogIn();


