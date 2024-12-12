<?php 
namespace App\Http;


use App\Http\Middleware\Queue as MiddlewareQueue;
use \Closure;
use \Exception;
use \ReflectionFunction;

class Router{
    private $url = '';
    private $prefix = '';
    private $routes = [];
    private $request;

    public function __construct($url){
        $this->request = new Request($this);
        $this->url = $url;
        $this->setPrefix();
    }

    private function setPrefix(){
        $parseUrl = parse_url($this->url);

        //define o prefixo
        $this->prefix = $parseUrl['path'] ?? '';
    }

    private function addRoute($method,$route,$params = []){
        //valida os parametros
        foreach($params as $key=>$value){
            if($value instanceof Closure){
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        $params['middlewares'] = $params['middlewares'] ?? [];

        //variaveis da rota
        $params['variables'] = [];

        //padrao de validação das variaveis das rotas
        $patternVariable = '/{(.*?)}/';
        if(preg_match_all($patternVariable,$route,$matches)){
            $route = preg_replace($patternVariable,'(.*?)',$route);
            $params['variables'] = $matches[1];
        }

        //padrão de validação da URL
        $patternRoute = '/^'.str_replace('/','\/',$route).'$/';

        //adiciona a rota na classe
        $this->routes[$patternRoute][$method] = $params;
    }

    public function get($route, $params = []) {
        return $this->addRoute('GET',$route,$params);
    }
    public function post($route, $params = []) {
        return $this->addRoute('POST',$route,$params);
    }
    public function put($route, $params = []) {
        return $this->addRoute('PUT',$route,$params);
    }
    public function delete($route, $params = []) {
        return $this->addRoute('DELETE',$route,$params);
    }

    private function getUri():string{
        $uri = $this->request->getUri();

        $xUri = strlen($this->prefix) ? explode($this->prefix,$uri) : [$uri];

        return end($xUri);
    }

    private function getRoute():array{
        //uri
        $uri = $this->getUri();

        //method
        $httpMethod = $this->request->getHttpMethod();

        //valida as rotas
        foreach($this->routes as $patternRoute=>$methods){
            //verificando se a uri está no padrão
            if(preg_match($patternRoute,$uri,$matches)){
                if(isset($methods[$httpMethod])){
                    unset($matches[0]);
                    
                    //variaveis processadas
                    $keys = $methods[$httpMethod]['variables'];
                    $methods[$httpMethod]['variables'] = array_combine($keys,$matches);
                    $methods[$httpMethod]['variables']['request'] = $this->request;

                    return $methods[$httpMethod];
                }
                throw new Exception("Método não permitido", 405);
            }
        }
        throw new Exception("Url não encontrada",404);
    }

    public function run () {
        try{
            //rota atual
            $route = $this->getRoute();

            //verifica o controlador
            if(!isset($route['controller'])){
                throw new Exception("A URL não pode ser processada",500);
            }

            //argumentos da função
            $args = [];

             //reflection function
             $reflection = new ReflectionFunction($route['controller']);
             foreach($reflection->getParameters() as $parameters){
                 $name = $parameters->getName();
                 $args[$name] = $route['variables'][$name] ?? '';
             }
             
             return (new MiddlewareQueue($route['middlewares'],$route['controller'],$args))->next($this->request);
        }catch(Exception $e){
            return new Response($e->getCode(), $e->getMessage());
        }
    }

    public function getCurrentUrl(){
        return $this->url.$this->getUri();
    }

    public function redirect($route){
        $url = $this->url.$route;
        header('location: '.$url);
        exit;
    }
}