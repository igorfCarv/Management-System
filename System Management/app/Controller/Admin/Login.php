<?php

namespace App\Controller\Admin;

use App\Model\Entity\User;
use App\Utils\View;
use App\Session\Admin\Login as SessionLoginAdmin;

class Login extends Page
{
    public static function getLogin($request,$errorMessage = null)
    {
        $status = !is_null($errorMessage) ? Alert::getError($errorMessage) : '';

        $content = View::render('pages/admin/login', [
            'status' => $status
        ]);
        return parent::getPage('Login', $content);
    }

    public static function setLogin($request)
    {
        $postVars = $request->getPostVars();

        $email = $postVars['email'] ?? '';
        $senha = $postVars['password'] ?? '';

        $obUser = User::getUserByEmail($email);

        if (!$obUser instanceof User) {
            return self::getLogin($request,'E-mail ou senha inválidos!');
        }

        if(!password_verify($senha, $obUser->password)){
            return self::getLogin($request,'E-mail ou senha inválidos!');
        }

        SessionLoginAdmin::login($obUser);

        $request->getRouter()->redirect('/admin/dashboard');
    }

    public static function setLogout($request){
        SessionLoginAdmin::logout();

        $request->getRouter()->redirect('/admin/login');
    }
}

