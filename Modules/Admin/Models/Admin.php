<?php

namespace Modules\Admin;


use Modules\Parents\Table;

class Admin {

    public $table;

    public function __construct()
    {
        $DB = new Table();
        $this->table = $DB->getTable();
    }

    public function getAccess()
    {
        if($_SESSION['access'] == '2')
        {
            return true;
        }
    }

    public function getUsers()
    {
        $result;
        $query = $this->table->query('select * FROM `users`');
        return $query->fetchAll();
    }

}