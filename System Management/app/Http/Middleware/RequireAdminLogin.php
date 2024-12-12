<?php 

namespace App\Http\Middleware;

use \App\Session\Admin\Login as SessionLoginAdmin;

class RequireAdminLogin
{
    public function handle($request,$next){
        if(!SessionLoginAdmin::isLogged()){
            $request->getRouter()->redirect('/admin/login');
        }
        return $next($request);
    }
}