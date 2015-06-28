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
        if($_SESSION['id']) {
            $this->view('user', 'index', array(     "account"   => $this->model->getUserInfo(),
                                                    "images"    => $this->model->getImages(),
                                                    "access"    => true));
        }
        else {
            header('Location: http://photocommunity/SignIn');
        }
    }

    public function userAction()
    {
        $this->view('user', 'index', array( "account"   =>  $this->model->getUserInfo($this->getQption()),
                                            "images"    =>  $this->model->getImages($this->getQption()),
                                            "access"    =>  $this->model->getAccess($this->getQption())));
    }

    Public function editAction()
    {
        if($this->model->getAccess($this->getQption())) {
            $this->view('user', 'edit', array("account" => $this->model->getUserInfo($this->getQption())));
        }
        else {
            header('Location: http://photocommunity/SignIn');
        }
    }

    Public function dropAction()
    {
        if($this->model->dropSession()) {
            header('Location: http://photocommunity/SignIn');
        }
    }

    public function deleteAction($id)
    {
        $this->model->delete($this->getQption());
        header('Location: http://photocommunity/user/drop');
    }
}