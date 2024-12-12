<?php

namespace App\Controller\Admin;

use App\Http\Response;
use App\Utils\View;

class Page
{
    public static function getPage($title,$content){
        return View::render('pages/admin/page',[
            'title' => $title,
            'content' => $content
        ]);
    }
}