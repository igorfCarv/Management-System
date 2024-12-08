<?php 

use App\Controller\UserController;

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($url)
{
    case '/':
        echo "página inicial";
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