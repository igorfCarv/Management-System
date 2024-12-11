<?php

namespace App\Controller\Pages;
use App\Model\Entity\Organization;
use App\Utils\View;

class AboutController extends TemplateController
{

    public static function getAbout()
    {
        $org = new Organization;
        $content =  View::render('pages/about', [
            'name' => 'Sobre o sistema',
            'description' => 'Especificações do Projeto',
        ]);
        return parent::getTemplate('About System', $content);
    }
}