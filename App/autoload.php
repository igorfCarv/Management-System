<?php 

spl_autoload_register(function ($classname){
    $file = BASEDIR . $classname . '.php';

    if(file_exists($file)){
        include $file;
    } else {
        exit ('Arquivo não encontrado. Arquivo: ' . $file);
    }
});