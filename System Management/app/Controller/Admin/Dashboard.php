<?php

namespace App\Controller\Admin;
use App\Utils\View;
use App\Model\Entity\User;
use App\Session\Admin\Login as AdminLogin;


class Dashboard extends TemplateAdmin
{

    public static function getData()
    {

        $userName = AdminLogin::isLogged() ? $_SESSION['admin']['user']['name'] : 'Visitante';

        $content = View::render('pages/admin/dashboard', [
            'name' => $userName
        ]);
        return parent::getTemplate('Painel Administrativo', $content);
    }
}