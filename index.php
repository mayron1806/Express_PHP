<?php
    require_once __DIR__. "/vendor/autoload.php";
    use ExpressPHP\Express\Express;
    
    $app = new Express();
    $app->get("/", "IndexController", "index");

    //$app->setControllersPath("MyApp\\Controllers\\");

    $app->listen();

