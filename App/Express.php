<?php
    namespace App;
    use App\Objects\Route;
    use App\Router;

class Express{
    private array $routes = array();
    private string $controllers_path;

    public function setControllersPath(string $path){
        $this->controllers_path = $path;
    }
    
    private function getUrl() :string{
        return parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
    }

    public function get(string $route, string $controller, string $action){
        try{
            if(!empty($route) && !empty($controller) && !empty($action)){
                $route_obj = new Route();

                $route_obj->route = $route;
                $route_obj->controller = $controller;
                $route_obj->action = $action;

                array_push($this->routes, $route_obj);
            }else{
                throw new \Exception("Um parametro de rota esta vazio");
            }
            
        }catch (\Exception $e){
            return "Erro na pre-criação da rota : " . $e->getMessage();
        }
    }
   
    public function listen(){
        try{
            $url = $this->getUrl();
            if(empty($this->controllers_path)){
                Router::run(routes: $this->routes, url: $url);
            }
            else{
                Router::run(routes: $this->routes, url: $url, controllers_path: $this->controllers_path);
            }
        }
        catch (\Exception $e){
            echo "Erro na url : " . $e->getMessage();
        }
    }
}
