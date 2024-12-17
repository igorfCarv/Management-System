<?php 

namespace App\Controller\Admin;

use \App\Utils\View;

class Alert
{
    public static function getError($message){
        return View::render('pages/admin/status',[
            'tipo' => 'danger',
            'mensagem' => $message
        ]);
    }
    public static function getSuccess($message){
        return View::render('pages/admin/status',[
            'tipo' => 'success',
            'mensagem' => $message
        ]);
    }
}