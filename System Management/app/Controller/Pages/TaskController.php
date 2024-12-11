<?php

namespace App\Controller\Pages;
use App\Model\Entity\Task as EntityTask;
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
            'name' => 'Sobre o sistema',
            'description' => 'Especificações do Projeto',
        ]);
        return parent::getTemplate('Adicionar uma tarefa', $content);
    }
    public static function insertTask($request)
    {
        $postVars = $request->getPostVars();

        $obTask = new EntityTask;
        $obTask->title = $postVars['title'];
        $obTask->description = $postVars['description'];
        $obTask->status = $postVars['status'];
        $obTask->created = $postVars['created'];
        $obTask->finished = $postVars['finished'];
        $obTask->store();
        
        return self::getTask();
    }
}