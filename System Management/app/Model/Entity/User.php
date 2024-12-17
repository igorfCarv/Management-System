<?php 
namespace App\Model\Entity;

use WilliamCosta\DatabaseManager\Database;

class User
{
    public $id, $name, $email, $password;

    public static function register($name, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $db = new Database('users');
        $db->insert([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        return true;
    }

    public static function getUserById($id)
    {
        $result = (new Database('users'))->select('id = ?', [$id]);
        return $result->fetchObject(self::class); 
    }
    public static function getUserByEmail($email){
        return (new Database('users'))->select('email = "'.$email.'"')->fetchObject(self::class);
    }
    public function save()
    {
        $db = new Database('users');
        return $db->insert([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ]);
    }
}