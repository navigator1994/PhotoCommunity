<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 27.06.2015
 * Time: 14:47
 */

namespace Modules\Home;

use Modules\Parents\ParentController;
class HomeController extends ParentController{

    private $model;

    public function __construct()
    {
        $this->model = new Home();
    }
    public function indexAction()
    {
        $this->view('home','index',$this->model->getUsers());
    }

}