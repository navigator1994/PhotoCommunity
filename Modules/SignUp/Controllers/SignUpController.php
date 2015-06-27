<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 27.06.2015
 * Time: 16:13
 */

namespace Modules\SignUp;

use Modules\Parents\ParentController;
class SignUpController extends ParentController{

    private $model;

    public function __construct()
    {
        $this->model = new SignUp();
    }

    public function indexAction()
    {
        $this->view('signup','index');
    }

    public function submitAction()
    {
        $result = $this->model->submit();
        if ($result == 'ok') {
            header('Location: http://photocommunity/SignIn');
        }
        else{
            $this->view('signup','index',$result);
        }
    }

}