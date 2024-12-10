<?php 

use App\Controller\UserController;
use App\Controller\LoginController;

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($url)
{
    case '/':
        echo "página inicial";
    break;
    case '/login':
        LoginController::index();
    break;
    case '/user':
        UserController::index();
    break;
    case '/user/form':
        UserController::form();
    break;
    case '/user/form/save':
        UserController::save();
    break;
    case '/user/delete':
        UserController::delete();
    break;
    default:
        echo "Erro 404";
    break;
}