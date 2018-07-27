<?php
require ("../App/Autoloader.php");
use App\Autoloader;
use App\Controllers\Router;

// Création d'une session
session_start();

// Initialisation de l'autoloader
$autoloader = new Autoloader;
$autoloader->register();

// Initialisation du router 
$router = new Router;
$router->routerRequest();
?>
