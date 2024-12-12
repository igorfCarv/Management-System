<?php 

namespace App\Http\Middleware;

class Maintenance
{
    public function handle($request,$next)
    {
        
        if($_ENV['MAINTENANCE'] == 'true'){
            throw new \Exception("Página em manutenção, tente mais tarde",200);
        };
        
        
        return $next($request);

    }
}