<?php 

use App\Http\Response;
use App\Controller\Pages;
use App\Controller\Pages\HomeController;
use App\Controller\Pages\AboutController;
use App\Controller\Pages\TaskController;

$orb->get('/',[
    function(){
        return new Response(200,HomeController::getHome());
    }
]); 
$orb->get('/about',[
    function(){
        return new Response(200,AboutController::getAbout());
    }
]); 
$orb->get('/tasks',[
    function($request){
        return new Response(200,TaskController::getTask($request));
    }
]); 
$orb->get('/tasks/create',[
    function(){
        return new Response(200,TaskController::create());
    }
]); 
$orb->post('/tasks/create',[
    function($request){
        return new Response(200,TaskController::insertTask($request));
    }
]); 


