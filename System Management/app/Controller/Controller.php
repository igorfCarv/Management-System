<?php 

namespace App\Controller;

class Controller
{
    protected static function render($view, $model = null)
    {
        //$file = "View/$view.php";
        $file = VIEWS . $view . ".php";

        if(file_exists($file)){
            include $file;  
        } else {
            exit('Arquivo da view não encontrada. Arquivo: ' . $view);
        }
    }
}