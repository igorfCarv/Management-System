<?php

namespace App\Controller\Pages;
use App\Model\Entity\Organization;
use App\Utils\View;

class TaskController extends TemplateController
{

    public static function getTask()
    {
        $content =  View::render('pages/task/show', [
            'name' => 'Sobre o sistema',
            'description' => 'Especificações do Projeto',
        ]);
        return parent::getTemplate('Listagem de Tarefas', $content);
    }

    public static function create()
    {
        $content =  View::render('pages/task/create', [
        ]);
        return parent::getTemplate('Adicionar uma tarefa', $content);
    }
}