<?php 
namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;
use App\Session\Admin\Login as AdminLogin;

class Task
{
    public $user_id;
    public $id;
    public $title;
    public $description;
    public $status;
    public $created;
    public $finished;

    public function store() {
        $userId = AdminLogin::isLogged() ? $_SESSION['admin']['user']['id'] : null;
        if (!$userId) {
            throw new \Exception("Usuário não está logado ou ID não está definido.");
        }
        $this->id = (new Database('tasks'))->insert([
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'created' => $this->created,
            'finished' => $this->finished,
            'user_id'     => $userId
        ]);
        
        return true;
    }

    public function update() {
        $userId = AdminLogin::isLogged() ? $_SESSION['admin']['user']['id'] : null;
        if (!$userId) {
            throw new \Exception("Usuário não está logado ou ID não está definido.");
        }
        return (new Database('tasks'))->update( 'id = '.$this->id,[
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'created' => $this->created,
            'finished' => $this->finished,
            'user_id'     => $userId
        ]);

    }

    public static function getTaskById($id){
        return self::getTask('id = ' . $id)->fetchObject(self::class);
    }

    public static function getTask($where = null, $order = null, $limit = null, $field = '*'){
        return (new Database('tasks'))->select($where,$order,$limit,$field);
    }

}