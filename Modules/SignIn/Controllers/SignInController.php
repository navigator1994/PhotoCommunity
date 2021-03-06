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
        if($this->model->getStatus()) {
            header( 'Location: http://photocommunity/user' );
        }
        else {
            $this->view("signin", "index");
        }
    }

    public function loginAction()
    {
        $result = $this->model->login();
        if($result == 'ok') {
            header( 'Location: http://photocommunity/user' );
        }
        else {
            $this->view("signin", "index", $result);
        }
    }

}