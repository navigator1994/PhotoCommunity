<?php

namespace Modules\SignIn;

use Modules\Parents;

class SignInController extends Parents\ParentController {

    private $model;

    public function __construct()
    {
        $this->model = new SingIn();
    }

    public function indexAction()
    {
        if($this->model->login($_POST['login'],$_POST['password']))
        {
            $this->view("signin","login","");
        }
        else {
            $this->view("signin", "login", "");
        }
    }



}