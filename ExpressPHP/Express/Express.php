<?php
    namespace ExpressPHP\Express;
    use ExpressPHP\Objects\Route;
    use ExpressPHP\Router;

class Express{
    // array para armazenar todas as rotas da aplicação
    private array $routes = array();
    // o caminho onde o controlador de todos o caminhos esta
   

    public function __construct(
        private string $controllers_path = "DEFAULT",
        private string $default_page = "ExpressPHP\\Controllers\\IndexController",
        private string $default_action = "index"
    ){}

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
            if($this->controllers_path === "DEFAULT"){
                $this->runDefault();
            }
            else{
                $this->run(routes: $this->routes, url: $url, controllers_path: $this->controllers_path);
            }
        }
        catch (\Exception $e){
            echo "Erro na conexão com a rota : " . $e->getMessage();
        }
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
                    }
                }
            }
        }
        throw new \Exception("a rota solicitada não existe.");
    }
    private function runDefault(){
        $class = $this->default_page;
        $action = $this->default_action;
        $controller = new $class;
        $controller->$action();
    }
}
