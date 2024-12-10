<?php 

namespace App\Model;

use App\DAO\UserDAO;
class User extends Model
{
    public $id, $name, $email, $password;

    public function save()
    {
        $dao = new UserDAO();

        if(empty($this->id))
        {
            $dao->insert($this);
        } else {
            $dao->update($this);
        } 
    }

    public function getAllRows()
    {
        $dao = new UserDAO();

        $this->rows = $dao->select();
    }

    public function getById(int $id)
    {
        $dao = new UserDAO();

        $obj = $dao->seletById($id);

        return ($obj) ? $obj : new User();
    }

    public function delete(int $id)
    {
        $dao = new UserDAO();

        $dao->delete($id);
    }
}