<?php


//FRONT CONTROLLER

#1 common options

#2 connect to required files

#3 connect to db

#4 run router


//display errors in dev environment
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

/**
 * @const ROOT determines root directory of the project
 */
define('ROOT', dirname(__FILE__));

require_once ROOT.'/vendor/autoload.php';
use Components\Router; 
use Components\DbConnect;


//call Router
$router = new Router();
$router->run();  

