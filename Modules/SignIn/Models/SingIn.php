<?php

namespace Modules\SignIn;

use Modules\Parents\Table;
class SingIn {

    public $table;

    function __construct()
    {
        $DB = new Table();
        $this->table = $DB->getTable();
    }

    public function login($login,$password)
    {
        if(empty($login) || empty($password))
        {
            return false;
        }
        else {
            $query = $this->table->prepare('SELECT id,password,access from users where login = :login');
            $query->execute(array('login' => $login));
            $data = $query->fetch();
            if ($data[1] == $password) {
                $_SESSION['id'] = $data[0];
                $_SESSION['access'] = $data[2];
                return true;
            } else {
                return false;
            }
        }
    }
}