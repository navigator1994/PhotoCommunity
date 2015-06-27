<?php

namespace Modules\Parents;


abstract class ParentController {


    abstract function indexAction();

    function view($file,$action,$data = null)
    {
        $View = new View($file,$action,$data);
    }

    public function getQption()
    {
        $option;
        $path = trim($this->route = $_GET['route'], '/\\');
        $parts = explode('/',$path);
        if (empty($parts[2]))
        {
            $option = '1';
        } else{
            $option = $parts[2];
        }
        return $option;
    }


}