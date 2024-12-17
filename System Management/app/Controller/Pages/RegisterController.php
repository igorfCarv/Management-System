<?php 

namespace App\Controller\Pages;

use App\Utils\View;
use App\Model\Entity\User;
use App\Controller\Admin\Alert;

class RegisterController extends TemplateController{
    public static function getRegister($request, $errorMessage = null)
    {
        $status = $request->getPostVars()['status'] ?? '';

        $content = View::render('pages/register', [
            'status' => $status,
        ]);
        return parent::getTemplate('Cadastrar usuários', $content);
    }

    public static function setRegister($request)
    {
        $postVars = $request->getPostVars();
    
        $name = $postVars['name'] ?? '';
        $email = $postVars['email'] ?? '';
        $password = $postVars['password'] ?? '';
        $confirmPassword = $postVars['confirm_password'] ?? '';

        if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
            return self::getRegister($request, 'Todos os campos são obrigatórios!');
        }
    
        if ($password !== $confirmPassword) {
            return self::getRegister($request, 'As senhas não coincidem!');
        }
    
        $existingUser = User::getUserByEmail($email);
        if ($existingUser instanceof User) {
            return self::getRegister($request, 'Este e-mail já está registrado!');
        }
    
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $hashedPassword;
    
        if ($user->save()) {
            $request->getRouter()->redirect('/admin/login');
        } else {
            return self::getRegister($request, 'Erro ao registrar o usuário!');
        }
    }

}