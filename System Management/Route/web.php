<?php

use App\Controller\Auth\Dashboard;
use App\Http\Response;
use App\Controller\Pages;
use App\Controller\Pages\HomeController;
use App\Controller\Pages\AboutController;
use App\Controller\Pages\TaskController;
use App\Controller\Admin;

$orb->get('/', [
    function () {
        return new Response(200, HomeController::getHome());
    }
]);
$orb->get('/about', [
    function () {
        return new Response(200, AboutController::getAbout());
    }
]);
$orb->get('/tasks', [
    function ($request) {
        return new Response(200, TaskController::getTask($request));
    }
]);
$orb->get('/tasks/create', [
    function () {
        return new Response(200, TaskController::create());
    }
]);
$orb->post('/tasks/create', [
    function ($request) {
        return new Response(200, TaskController::insertTask($request));
    }
]);
$orb->get('/admin', [
    'middlewares' => [
        'required-admin-login'
    ],
    function () {
        return new Response(200, 'admin');
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



