<?php
require ("../App/Autoloader.php");
use App\Autoloader;
use App\Controllers\Router;

session_start();

$autoloader = new Autoloader;
$autoloader->register();


$router = new Router;
$router->routerRequest();
?>
