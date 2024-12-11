<?php 
namespace App\Model\Entity;

use App\Database\Database;

class Task
{
    public $id;
    public $title;
    public $description;
    public $status;
    public $created;
    public $finished;

    public function store() {
        $this->id = (new Database('tasks'))->insert([
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'created' => $this->created,
            'finished' => $this->finished
        ]);
    }

}