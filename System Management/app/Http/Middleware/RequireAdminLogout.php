<?php 

namespace App\Http\Middleware;

use \App\Session\Admin\Login as SessionLoginAdmin;

class RequireAdminLogout
{
    public function handle($request,$next){
        if(SessionLoginAdmin::isLogged()){
            $request->getRouter()->redirect('/admin/dashboard');
        }
        return $next($request);
    }
}