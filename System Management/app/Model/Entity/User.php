<?php 
namespace App\Model\Entity;

use WilliamCosta\DatabaseManager\Database;

class User
{
    public $id, $name, $email, $password;

    public static function register($name, $email, $password)
    {
        // Hash da senha
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Inserir no banco de dados
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
        return $result->fetchObject(self::class); // Retorna o objeto User.
    }
    public static function getUserByEmail($email){
        return (new Database('users'))->select('email = "'.$email.'"')->fetchObject(self::class);
    }
    public function save()
    {
        // Insere o novo usuário no banco de dados
        $db = new Database('users');
        return $db->insert([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ]);
    }
}