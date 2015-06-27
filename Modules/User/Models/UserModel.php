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

    public function getUserInfo()
    {
        return $this->table->query('SELECT * FROM users WHERE id = '.$_SESSION['id'])->fetch();
    }

    public function getImages()
    {
        $result;
        $query = $this->table->query('SELECT * FROM images WHERE user_id = "'.$_SESSION['id'].'"');
        while($data = $query->fetch())
        {
            $result[] = $data;
        }
        return array_reverse($result);
    }

}