<?php

namespace Modules\Parents;


abstract class ParentController {


    abstract function indexAction();

    function view($file,$action,$data)
    {
        $View = new View($file,$action,$data);
    }


}