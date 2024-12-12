<?php 
namespace App\Model\Entity;

use WilliamCosta\DatabaseManager\Database;

class User
{
    public $id, $name, $email, $password;

    public static function getUserByEmail($email){
        return (new Database('users'))->select('email = "'.$email.'"')->fetchObject(self::class);
    }
}