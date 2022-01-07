<?php
    namespace App\Objects;
    
    class Route{
        private string $route;
        private string $controller;
        private string $action;

        public function __get($name)
        {
            return $this->$name;
        }
        public function __set($name, $value)
        {
            $this->$name = $value;
        }
    }