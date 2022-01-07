<?php
namespace ExpressPHP;

use Exception;
use ExpressPHP\Objects\Route;

class Router{
    // inicia a rota
    public static function run(array $routes, string $url, string $controllers_path){
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
        throw new Exception("a rota solicitada não existe");
    }
    public static function runDefault(){
        $class = "ExpressPHP\\Controllers\\IndexController";
        $action = "index";
        $controller = new $class;
        $controller->$action();
    }
}