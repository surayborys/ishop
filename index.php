<?php

//FRONT CONTROLLER

#1 common options

#2 connect to required files

#3 connect to db

#4 run router


//display errors in dev environment
ini_set('display_errors', 1);
error_reporting(E_ALL);

/**
 * @const ROOT determines root directory of the project
 */
define('ROOT', dirname(__FILE__));

//connect to Router
require_once ROOT.'/components/Router.php';

//connect to DB
require_once ROOT . '/components/DbConnect.php';

//call Router
$router = new Router();
$router->run();  

