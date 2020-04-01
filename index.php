<?php

// показывать сообщения об ошибках
ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ROOT', dirname(__FILE__));

require_once ROOT.'/components/Db.php';
require_once ROOT.'/components/ApiRouter.php';
require_once ROOT.'/controllers/UserController.php';


if (UserController::checkAuth()){
    $router = new ApiRouter();
    $router->run();
}else{
    die();
}








