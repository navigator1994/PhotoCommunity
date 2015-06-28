<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 27.06.2015
 * Time: 20:47
 */

namespace Modules\User;

use Modules\Parents\Table;
class UserModel {

    private $table;

    public function __construct()
    {
        $DB = new Table();
        $this->table = $DB->getTable();
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

}