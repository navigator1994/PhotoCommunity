<?php

namespace Modules\Admin;

use Modules\Parents;

class AdminController extends Parents\ParentController  {

    private $model;

    function __construct()
    {
        $this->model = new Admin();
    }

    function indexAction()
    {
        if($this->model->getAccess()) {
            $this->view("admin", "index",$this->model->getUsers());
        }
        else {
            throw new \Exception('Access deny');
        }
    }

    function deleteAction()
    {
        if($this->model->getAccess()) {
        $this->view("admin","delete");
        }
        else {
            throw new \Exception('Access deny');
        }
    }
}