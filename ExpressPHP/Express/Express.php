<?php
    namespace ExpressPHP\Express;
    use ExpressPHP\Objects\Route;

class Express{
    // array para armazenar todas as rotas da aplicação
    private array $routes = array();
    // a rota padrao que sera carregada quando uma rota desconhecida for chamada
    private Route $defaultRoute;
    // o caminho onde o controlador de todos o caminhos esta
    
    public function __construct( private string $controllers_path ){}
    
    // define o caminho onde os controladores estão
    public function setControllersPath(string $path){
        $this->controllers_path = $path;
    }

    // retorna uma string com a rota atual
    public function getUrl() :string{
        return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    }

    // cria um objeto de rota
    public function addRoute(string $route, string $controller, string $action, bool $is_default_route = false){
        // verifica se nenhum dos parametros estiverem vazios
        if(!empty($route) && !empty($controller) && !empty($action)){
            // cria um objeto para receber os parametros
            $route_obj = new Route();

            $route_obj->route = $route;
            $route_obj->controller = $controller;
            $route_obj->action = $action;

            // adiciona este objeto no array de rotas
            array_push($this->routes, $route_obj);
            // verifica se e a rota definida como default e se a rota default está vazia
            if($is_default_route && empty($this->defaultRoute)){
                $this->defaultRoute = new Route;
                $this->defaultRoute->route = $route;
                $this->defaultRoute->controller = $controller;
                $this->defaultRoute->action = $action;

            }else if($is_default_route && !empty($this->defaultRoute)){
                throw new \Exception("Você está definindo mais de uma rota como padrão");
            }
        }else{
            throw new \Exception("Um parametro de rota esta vazio");
        }
    }
   
    // inicia os serviços
    public function listen(){
        if(empty($this->defaultRoute)){
            throw new \Exception("Nenhuma rota foi definida como padrão");
        }
        if(empty($this->controllers_path)){
            throw new \Exception("O caminho para os controladores está vazio");
        }
        // pega a rota atual
        $url = $this->getUrl();
        // se nenhum caminho alternativo para os controllers foi criado ele procura um controller interno 
        $this->run(routes: $this->routes, url: $url, controllers_path: $this->controllers_path);
    }

    private function run(array $routes, string $url, string $controllers_path){
        // verifica qual a rota que esta ativa
        foreach($routes as $key => $value){
            if( $value->route == $url){
                // instancia uma classe do controller daquela rota
                $class = $controllers_path . ucfirst($value->controller);
                $action = $value->action;
                // verifica se a classe existe
                if(class_exists($class)){
                    $controller = new $class;
                    // verifica se o metedo existe
                    if(method_exists($controller, $action)){
                        $controller->$action();
                        die();
                    }else{
                        throw new \Exception("A action '{$action}' que esta sendo requisitada não existe, ou não foi encontrada");
                    }
                }else{
                    throw new \Exception("O controlador '{$class}' que esta sendo requisitado não existe, ou não foi encontrado");
                }
            }
        }
        $this->runDefault();
    }

    // executa a rota defaut
    private function runDefault(){
        $class = $this->controllers_path . ucfirst($this->defaultRoute->controller);
        $action = $this->defaultRoute->action;
        $controller = new $class;
        $controller->$action();
    }
}
