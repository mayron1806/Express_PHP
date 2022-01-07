<?php
require_once __DIR__."/../vendor/autoload.php";

use App\Express;

$app = new Express();

$app->get(route:"/", controller:"indexController", action:"index");

$app->get(route:"/teste1", controller:"indexController", action:"teste1");

$app->get(route:"/teste2", controller:"indexController", action:"teste2");

$app->setControllersPath("App\\Controllers\\Other\\");

$app->listen();