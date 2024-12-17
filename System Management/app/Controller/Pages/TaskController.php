<?php

namespace App\Controller\Pages;
use App\Model\Entity\Task;
use App\Utils\View;
use \WilliamCosta\DatabaseManager\Pagination;
use App\Session\Admin\Login as AdminLogin;

class TaskController extends TemplateController
{

    private static function getTaskItems($request, &$obPaginate)
    {
        $items = '';
        $userId = AdminLogin::isLogged() ? $_SESSION['admin']['user']['id'] : null;

        $quantity = Task::getTask("user_id = $userId", null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

        $queryParams = $request->getQueryParams();
        $currentPage = $queryParams['page'] ?? 1;

        $obPaginate = new Pagination($quantity, $currentPage, 3);

        if (isset($userId)) {
            $results = Task::getTask("user_id = $userId", 'id DESC', $obPaginate->getLimit());
        } else {
            $results = null;
        }

        while ($obTask = $results->fetchObject(Task::class)) {
            $items .= View::render('pages/task/item', [
                'id' => $obTask->id,
                'title' => $obTask->title,
                'description' => $obTask->description,
                'status' => $obTask->status,
                'created' => date('d/m/Y', strtotime($obTask->created)),
                'finished' => date('d/m/Y', strtotime($obTask->finished)),
            ]);
        }
        return $items;
    }
    public static function getTask($request)
    {
        $content = View::render('pages/task/show', [
            'items' => self::getTaskItems($request, $obpaginate),
            'pagination' => parent::getPaginate($request, $obpaginate)
        ]);
        
        return parent::getTemplate('Listagem de Tarefas', $content);
    }

    public static function create()
    {
        $content = View::render('pages/task/create', [
            'name' => 'Sobre o sistema',
            'description' => 'Especificações do Projeto',
        ]);
        return parent::getTemplate('Adicionar uma tarefa', $content);
    }
    public static function insertTask($request)
    {
        $userId = AdminLogin::isLogged() ? $_SESSION['admin']['user']['id'] : null;
        $postVars = $request->getPostVars();

        $obTask = new Task;
        $obTask->user_id = $userId;
        $obTask->title = $postVars['title'];
        $obTask->description = $postVars['description'];
        $obTask->status = $postVars['status'];
        $obTask->created = \DateTime::createFromFormat('d/m/Y', $postVars['created'])->format('Y-m-d');
        $obTask->finished = \DateTime::createFromFormat('d/m/Y', $postVars['finished'])->format('Y-m-d');
        $obTask->store();

        return self::getTask($request);
    }

    public static function getEdit($request,$id)
    {
        $obTask = Task::getTaskById($id);

        if(!$obTask instanceof Task){
            $request->getRouter()->redirect('/tasks');
        }

        $content = View::render('pages/task/edit', [
            'title' => $obTask->title,
            'description' => $obTask->description,
            'status' => $obTask->status,
            'created' => $obTask->created,
            'finished' => $obTask->finished
        ]);
        return parent::getTemplate('Editar uma tarefa', $content);
    }

    public static function setEdit($request,$id)
    {
        $obTask = Task::getTaskById($id);

        if(!$obTask instanceof Task){
            $request->getRouter()->redirect('/task');
        }

        $postVars = $request->getPostVars();
        $obTask->title = $postVars['title'] ?? $obTask->title;
        $obTask->description = $postVars['description'] ?? $obTask->description;
        $obTask->status = $postVars['status'] ?? $obTask->status;
        $obTask->created = \DateTime::createFromFormat('d/m/Y', $postVars['created'])->format('Y-m-d') ?? $obTask->created;
        $obTask->finished = \DateTime::createFromFormat('d/m/Y', $postVars['finished'])->format('Y-m-d') ?? $obTask->finished;

        $obTask->update();
    }
}