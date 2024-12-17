<?php

use App\Controller\Auth\Dashboard;
use App\Http\Response;
use App\Controller\Pages;
use App\Controller\Pages\HomeController;
use App\Controller\Pages\AboutController;
use App\Controller\Pages\TaskController;
use App\Controller\Pages\RegisterController;
use App\Controller\Admin;

$orb->get('/', [
    function () {
        return new Response(200, HomeController::getHome());
    }
]);
$orb->get('/register', ['middlewares' => [
        'required-admin-logout'
    ],
    function ($request) {
        return new Response(200, RegisterController::getRegister($request));
    }
]);
$orb->post('/register', ['middlewares' => [
    'required-admin-logout'
],
function ($request) {
    return new Response(200, RegisterController::setRegister($request));
}
]);
$orb->get('/about', [
    function () {
        return new Response(200, AboutController::getAbout());
    }
]);
$orb->get('/tasks', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, TaskController::getTask($request));
    }
]);
$orb->get('/tasks/{id}/edit', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request,$id) {
        return new Response(200, TaskController::getEdit($request,$id));
    }
]);
$orb->post('/tasks/{id}/edit', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request,$id) {
        return new Response(200, TaskController::setEdit($request,$id));
    }
]);
$orb->get('/tasks/create', [
    'middlewares' => [
        'required-admin-login'
    ],
    function () {
        return new Response(200, TaskController::create());
    }
]);
$orb->post('/tasks/create', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, TaskController::insertTask($request));
    }
]);
$orb->get('/admin/dashboard', [
    'middlewares' => [
        'required-admin-login'
    ],
    function () {
        return new Response(200, Admin\Dashboard::getData());
    }
]);
$orb->get('/admin/login', [
    'middlewares' => [
        'required-admin-logout'
    ],
    function ($request) {
        return new Response(200, Admin\Login::getLogin($request));
    }
]);
$orb->post('/admin/login', [
    'middlewares' => [
        'required-admin-logout'
    ],
    function ($request) {
        return new Response(200, Admin\Login::setLogin($request));
    }
]);
$orb->get('/admin/logout', [
    'middlewares' => [
        'required-admin-login'
    ],
    function ($request) {
        return new Response(200, Admin\Login::setLogout($request));
    }
]);



