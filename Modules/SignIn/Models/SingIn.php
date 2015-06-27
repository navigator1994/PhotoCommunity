<?php

namespace Modules\SignIn;

use Modules\Parents\Table;
use Modules\Parents\Validator;

class SingIn {

    private $table;
    private $validator;

    function __construct()
    {
        $DB = new Table();
        $this->table = $DB->getTable();
        $this->validator = new Validator();
    }

    public function login()
    {
        if($this->validator->isValidSingIn($_POST['login'],$_POST['password']))
        {
            $query = $this->table->query('SELECT id,password,access from users where login = "'.$_POST['login'].'"')->fetch();
            if ($query[1] == md5($_POST['password'])) {
                $_SESSION['id'] = $query[0];
                $_SESSION['access'] = $query[2];
                return 'ok';
            } else {
                return 'wrong login or password';
            }
        }
        else{
            return $this->validator->getErrorMessage();
        }
    }
}