<?php

namespace App\Controller\Admin;

use App\Http\Response;
use App\Utils\View;

class Page
{
    private static function getHeader(){
        return View::render('components/header');
    }
    private static function getFooter(){
        return View::render('components/footer');
    }
    public static function getPage($title,$content){
        return View::render('pages/admin/page',[
            'title' => $title,
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter()
        ]);
    }
}