<?php

namespace App\Controller;

use App\Model\Login;

class LoginController extends Controller
{
    public static function index()
    {
        $model = new Login();
        parent::render('Templates/Login',$model);
    }
}