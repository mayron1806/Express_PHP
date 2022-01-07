<?php
namespace App;

use App\Objects\Route;

class Router{
    public static function run(array $routes, string $url, string $controllers_path = "App\\Controllers\\"){
        foreach($routes as $key => $value){
            if( $value->route == $url){
                $class = $controllers_path . ucfirst($value->controller);
                $action = $value->action;
                $controller = new $class;
                $controller->$action();
                die();
            }
        }
        throw new \Exception("url nao encontrada");
    }
}