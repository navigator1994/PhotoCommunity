<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 27.06.2015
 * Time: 20:47
 */

namespace Modules\User;

use Modules\Parents\Table;
use Modules\Parents\Validator;

class UserModel {

    private $table;
    private $validator;

    public function __construct()
    {
        $DB = new Table();
        $this->table = $DB->getTable();
        $this->validator = new Validator();
    }

    public function getUserInfo($id = null)
    {
        $id = $id == null ? $_SESSION['id'] : $id;
        return $this->table->query('SELECT * FROM users WHERE id = '.$id)->fetch();
    }

    public function getImages($id = null)
    {
        $id = $id == null ? $_SESSION['id'] : $id;

        $result;
        $query = $this->table->query('SELECT * FROM images WHERE user_id = "'.$id.'"');
        while($data = $query->fetch())
        {
            $result[] = $data;
        }
        return array_reverse($result);
    }

    public function getAccess($id)
    {
        if(($id == $_SESSION['id']) || ($_SESSION['access'] == '2')){
            return true;
        }
    }

    public function dropSession()
    {
        return session_destroy();
    }

    public function delete($id)
    {
        if ($this->table->query('DELETE FROM `users` WHERE `id` = '.$id)) {
            $path = './Public/UserFiles/Images/'.$id;
            if ($objs = glob($path . "/*")) {
                foreach ($objs as $obj) {
                    unlink($obj);
                }
            }
            rmdir($path);
        }
    }

    public function edit($id)
    {
        if ($this->validator->isValidSignUp($_POST['login'], $_POST['password'] == null ? 'password' : $_POST['password'], $_POST['retype-password'] == null ? 'password' : $_POST['retype-password'], $_POST['name'], $_POST['surname'], $_POST['date'], $_FILES['file']['tmp_name'], $_POST['email']) === true) {
            $this->table->query('UPDATE `users` SET `login` = "'.$_POST['login'].'", `name` = "'.$_POST['name'].'", `surname` = "'.$_POST['surname'].'", `date` = "'.$_POST['date'].'", `email` = "'.$_POST['email'].'" WHERE `id` = "'.$id.'"');
        }
        else {
            return $this->validator->getErrorMessage();
        }
    }

}