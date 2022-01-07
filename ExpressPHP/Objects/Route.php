<?php
    namespace ExpressPHP\Objects;
    // objeto para levar de cada rota
    class Route{
        // rota (ex: '/home')
        private string $route;
        // controlador da rota (ex: IndexController)
        private string $controller;
        // ação da rota, representa o metodo que sera executado (ex: home())
        private string $action;

        public function __get($name){
            return $this->$name;
        }
        public function __set($name, $value){
            $this->$name = $value;
        }
    }