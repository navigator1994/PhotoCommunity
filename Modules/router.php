<?php

namespace Modules;


class router {

    private $controller;
    private $action;
    private $route;

    function __construct()
    {
        if (!empty($_GET['route'])) {$this->route = $_GET['route'];};
        $this->getController();
    }

    private function getRoute()
    {
        return $this->route;
    }

    private function getController()
    {
        $path = trim($this->route, '/\\');
        $parts = explode('/', $path);
        $module = ucfirst($parts[0]);
        $name = ucfirst($parts[0])."Controller";
        if (empty($parts[0])) {
            $this->controller = "HomeController";
            $module = "Home";
        }
        else if (!class_exists("Modules\\$module\\$name")) {
            throw new \Exception("Can`t load controller $name", 1);
        }
        else {
            $this->controller = ucfirst($name);

        }

        $class = "Modules\\$module\\" . $this->controller;
        if (class_exists($class)) {
            $controller = new $class();
            if($this->getAction($controller)){
                $method = $this->action;
                $controller->$method();
            }
        }
    }

    private function getAction($object)
    {
        $path = trim($this->route, '/\\');
        $parts = explode('/', $path);
        $name = $parts[1];
        if ((empty($name)) && (method_exists($object, "indexAction"))) {
            $this->action = "indexAction";
        }
        else if ((empty($name)) && (!method_exists($object, "indexAction"))) {
            throw new \Exception("Controller has no such indexAction" , 3);
        }
        else if (!method_exists($object, $name."Action")) {
            throw new \Exception("Controller has no such method: ".$name."Action" , 2);
        }
        else {
            $this->action = strtolower($name) . "Action";
        }
        return true;
    }

}
