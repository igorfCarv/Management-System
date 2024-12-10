<?php

namespace App\Controller\Pages;
use App\Utils\View;

class TemplateController
{

    private static function getHeader(){
        return View::render('components/header');
    }
    private static function getFooter(){
        return View::render('components/footer');
    }
    public static function getTemplate($title,$content)
    {
        return View::render('pages/theme', [
            'title' => $title,
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter()
        ]);
    }
}