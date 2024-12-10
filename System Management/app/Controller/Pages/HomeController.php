<?php

namespace App\Controller\Pages;
use App\Model\Entity\Organization;
use App\Utils\View;

class HomeController extends TemplateController
{

    public static function getHome()
    {
        $org = new Organization;
        $content =  View::render('pages/home', [
            'name' => $org->name,
            'description' => $org->description,
        ]);
        return parent::getTemplate('Management System', $content);
    }
}