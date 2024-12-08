<?php

namespace App\DAO;

use App\Model\User;
use \PDO;

class UserDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }
    public function insert(User $model)
    {
        $sql = "INSERT INTO users (name,email,password) VALUES (?,?,?) ";

        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue(1,$model->name);
        $stmt->bindValue(2,$model->email);
        $stmt->bindValue(3,$model->password);
        
        $stmt->execute();
    }
    public function update(User $model)
    {
        $sql = "UPDATE users SET name=?, email=?, password=? WHERE id=? ";

        $stmt = $this->connection->prepare($sql);

        $stmt->bindValue(1,$model->name);
        $stmt->bindValue(2,$model->email);
        $stmt->bindValue(3,$model->password);
        $stmt->bindValue(4,$model->id);
        
        $stmt->execute();
    }
    public function select()
    {
        $sql = "SELECT * FROM users";

        $stmt = $this->connection->query($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }
    public function seletById(int $id)
    {
        $sql = "SELECT * FROM users WHERE id = ?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchObject("App\Model\User");
    }
    public function delete(int $id)
    {
        $sql = "DELETE FROM users WHERE id = ?";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }
}