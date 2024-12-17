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
        // Obtém os dados do formulário
        $postVars = $request->getPostVars();
    
        $name = $postVars['name'] ?? '';
        $email = $postVars['email'] ?? '';
        $password = $postVars['password'] ?? '';
        $confirmPassword = $postVars['confirm_password'] ?? '';
    
        // Verifica se todos os campos foram preenchidos
        if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
            return self::getRegister($request, 'Todos os campos são obrigatórios!');
        }
    
        // Verifica se as senhas coincidem
        if ($password !== $confirmPassword) {
            return self::getRegister($request, 'As senhas não coincidem!');
        }
    
        // Verifica se o e-mail já está registrado
        $existingUser = User::getUserByEmail($email);
        if ($existingUser instanceof User) {
            return self::getRegister($request, 'Este e-mail já está registrado!');
        }
    
        // Cria o hash da senha
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
        // Registra o novo usuário
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $hashedPassword;
    
        if ($user->save()) {
            // Redireciona para a página de login ou dashboard
            $request->getRouter()->redirect('/admin/login');
        } else {
            return self::getRegister($request, 'Erro ao registrar o usuário!');
        }
    }

}