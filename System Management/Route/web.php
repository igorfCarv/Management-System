<?php 

use App\Http\Response;
use App\Controller\Pages;
use App\Controller\Pages\HomeController;
use App\Controller\Pages\AboutController;

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
$orb->get('/page/{id}/{action}',[
    function($id, $action){
        return new Response(200,'Página '.$id.' - '.$action);
    }
]); 
