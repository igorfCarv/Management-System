<?php

namespace App\Controller\Pages;
use App\Model\Entity\Task;
use App\Utils\View;
use \WilliamCosta\DatabaseManager\Pagination;

class TaskController extends TemplateController
{

    private static function getTaskItems($request)
    {
        $items = '';

        $quantity = Task::getTask(null,null,null,'COUNT(*) as qtd')->fetchObject()->qtd;

        $queryParams = $request->getQueryParams();
        $currentPage = $queryParams['page'] ?? 1;

        $obPaginate = new Pagination($quantity,$currentPage,1);

        $results = Task::getTask(null,'id DESC',$obPaginate->getLimit(2));

        while($obTask = $results->fetchObject(Task::class)){
            $items .= View::render('pages/task/item', [
                'title' => $obTask->title,
                'description' => $obTask->description,
                'status' => $obTask->status,
                'created' => date('d/m/Y',strtotime($obTask->created)),
                'finished' => date('d/m/Y',strtotime($obTask->finished)),
            ]);
    
        }

        
        return $items;
    }
    public static function getTask($request)
    {
        $content =  View::render('pages/task/show', [
            'items' => self::getTaskItems($request),
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

        $obTask = new Task;
        $obTask->title = $postVars['title'];
        $obTask->description = $postVars['description'];
        $obTask->status = $postVars['status'];
        $obTask->created = \DateTime::createFromFormat('d/m/Y', $postVars['created'])->format('Y-m-d');
        $obTask->finished = \DateTime::createFromFormat('d/m/Y', $postVars['finished'])->format('Y-m-d');
        $obTask->store();
        
        return self::getTask($request);
    }
}