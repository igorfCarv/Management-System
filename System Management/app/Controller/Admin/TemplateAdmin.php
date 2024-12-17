<?php

namespace App\Controller\Admin;

use App\Http\Response;
use App\Utils\View;

class TemplateAdmin
{
    private static function getHeader(){
        return View::render('components/header-admin');
    }
    private static function getFooter(){
        return View::render('components/footer');
    }
    public static function getTemplate($title,$content){
        return View::render('pages/admin/page',[
            'title' => $title,
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter()
        ]);
    }
}