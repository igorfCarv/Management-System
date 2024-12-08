<?php

namespace App\Controller;

use App\Model\User;

class UserController extends Controller
{
    public static function index()
    {
        $model = new User();
        $model->getAllRows();

        parent::render('User/List',$model);
    }
    public static function form()
    {
        $model = new User();

        if(isset($_GET['id'])){
            $model = $model->getById( (int) $_GET['id']);
        }

        parent::render('User/Form',$model);
    }
    public static function save()
    {
        $model = new User();

        $model->id = $_POST['id'];
        $model->name = $_POST['name'];
        $model->email = $_POST['email'];
        $model->password = $_POST['password'];

        $model->save();

        header("Location: /user");
    }

    public static function delete()
    {
        $model = new User();

        $model->delete((int) $_GET['id']);

        header("Location: /user");
    }

}