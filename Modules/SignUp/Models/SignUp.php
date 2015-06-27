<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 27.06.2015
 * Time: 16:24
 */

namespace Modules\SignUp;

use Modules\Parents\Table;
use Modules\Parents\Validator;

class SignUp {

    private $table;
    private $validator;

    public function __construct()
    {
        $DB = new Table();
        $this->table = $DB->getTable();
        $this->validator = new Validator();
    }

    public function submit(){
        if ($this->table->query('SELECT id FROM `users` WHERE login = "'.$_POST['login'].'"')->fetch()) {
            return 'login already used';
        }
        else {
            if ($this->validator->isValidSignUp($_POST['login'], $_POST['password'], $_POST['retype-password'], $_POST['name'], $_POST['surname'], $_POST['date'], $_FILES['file']['name'], $_POST['email'])) {
                return $this->sent();
            } else {
                return $this->validator->getErrorMessage();
            }
        }
    }

    public function sent(){
        if ($_FILES['file']['name']) {
            $avatar = "http://photocommunity/Public/UserFiles/Avatars/" . $_FILES['file']['name'];
        }
        else{
            $avatar = "http://photocommunity/Public/UserFiles/defaultAvatar.jpg";
        }
            if(($this->table->query('INSERT INTO users (`login`,`password`,`name`, `surname`, `email`,`date`,`avatar`,`access`) VALUE ("' . $_POST['login'] . '","' . md5($_POST['password']) . '","' . $_POST['name'] . '","' . $_POST['surname'] . '","' . $_POST['email'] . '","' . $_POST['date'] . '","'.$avatar.'","1")')) && (copy($_FILES['file']['tmp_name'],"./Public/UserFiles/Avatars/".$_FILES['file']['name']))){
                return 'ok';
            }
    }

}