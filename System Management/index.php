<?php

use App\Controller\Pages\HomeController;
use App\Http\Router;
use App\Http\Response;

require __DIR__.'/vendor/autoload.php';

echo HomeController::getHome();
define('URL','http://localhost:8000');

$orb = new Router(URL);
$orb->get('/',[
    function(){
        return new Response(200,HomeController::getHome());
    }
]);
