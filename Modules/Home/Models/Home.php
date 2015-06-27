<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 27.06.2015
 * Time: 15:20
 */

namespace Modules\Home;

use Modules\Parents\Table;
class Home {

    private $table;

    public function __construct()
    {
        $DB = new Table();
        $this->table = $DB->getTable();
    }

    public function getUsers()
    {
        $result;
        $query = $this->table->query('SELECT name,surname,avatar,id FROM users');
        while($data = $query->fetch())
        {
            $result[] = $data;
        }
        return $result;
    }
}