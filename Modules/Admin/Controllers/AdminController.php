<?php

namespace Modules\Admin;

use Modules\Parents;

class AdminController extends Parents\ParentController  {

    private $Model;

    function __construct()
    {
        $this->Model = new Admin();
    }

    function indexAction()
    {
        $this->view("admin","index","data");
    }

    function deleteAction()
    {
        $this->view("admin","delete","data");
    }
}