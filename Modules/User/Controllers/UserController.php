<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 27.06.2015
 * Time: 20:47
 */

namespace Modules\User;

use Modules\Parents\ParentController;

class UserController extends ParentController{

    public $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function indexAction()
    {
        $this->view('user', 'index', array( "account"   =>  $this->model->getUserInfo(),
                                            "images"    =>  $this->model->getImages()));
    }
}