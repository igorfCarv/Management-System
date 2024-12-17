<?php

namespace App\Controller\Pages;
use App\Utils\View;
use App\Session\Admin\Login as SessionLoginAdmin;

class TemplateController
{

    public static function getPaginate($request,$obPaginate){
        $pages = $obPaginate->getPages();
        if(count($pages)<=1) return '';
        $links = '';
        $url = $request->getRouter()->getCurrentUrl();
        
        $queryParams = $request->getQueryParams();
       
        foreach($pages as $page){
            $queryParams['page'] = $page['page'];

            $link = $url.'?'.http_build_query($queryParams);
           
            $links .= View::render('pages/pagination/link',[
                'page' => $page['page'],
                'link' => $link,
                'active' => $page['current'] ? 'active' : ''
            ]);

        }
        return View::render('pages/pagination/box',[
            'links' => $links
        ]);
    }

    private static function getHeader(){
        return View::render('components/header');
    }
    private static function getHead(){
        if(SessionLoginAdmin::isLogged()){
            return View::render('components/header-admin');
        }
        return View::render('components/header'); 
    }
    private static function getFooter(){
        return View::render('components/footer');
    }
    public static function getTemplate($title,$content)
    {
        return View::render('pages/theme', [
            'title' => $title,
            'header' => self::getHead(),
            'content' => $content,
            'footer' => self::getFooter()
        ]);
    }
}