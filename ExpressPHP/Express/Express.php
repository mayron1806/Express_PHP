<?php
    namespace ExpressPHP\Express;
    use ExpressPHP\Objects\Route;
    use ExpressPHP\Router;

class Express{
    // array para armazenar todas as rotas da aplicação
    private array $routes = array();
    // o caminho onde o controlador de todos o caminhos esta
    private string $controllers_path;

    // define o caminho onde os controladores estão
    public function setControllersPath(string $path){
        $this->controllers_path = $path;
    }

    // retorna uma string com a rota atual
    public function getUrl() :string{
        return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    }

    // cria um objeto de rota
    public function get(string $route, string $controller, string $action){
        try{
            // se nenhum dos parametros estiverem vazios
            if(!empty($route) && !empty($controller) && !empty($action)){
                // cria um objeto para receber os parametros
                $route_obj = new Route();

                $route_obj->route = $route;
                $route_obj->controller = $controller;
                $route_obj->action = $action;

                // adiciona este objeto no array de rotas
                array_push($this->routes, $route_obj);
            }else{
                throw new \Exception("Um parametro de rota esta vazio");
            }
            
        }catch (\Exception $e){
            return "Erro na pre-criação da rota : " . $e->getMessage();
        }
    }
   
    // inicia os serviços
    public function listen(){
        try{
            // pega a rota atual
            $url = $this->getUrl();
            // se nenhum caminho alternativo para os controllers foi criado ele procura um controller interno 
            if(empty($this->controllers_path)){
                Router::runDefault();
            }
            else{
                Router::run(routes: $this->routes, url: $url, controllers_path: $this->controllers_path);
            }
        }
        catch (\Exception $e){
            echo "Erro na conexão com a rota : " . $e->getMessage();
        }
    }
}