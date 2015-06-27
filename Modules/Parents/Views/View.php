<?php

namespace Modules\Parents;

class view
{
    function __construct($module,$action,$data)
    {
        $content = "./Modules/$module/Views/$action"."View.phtml";
        require_once('./Public/Teamplates/Standart.phtml');
    }
}




