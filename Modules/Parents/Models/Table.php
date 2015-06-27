<?php

namespace Modules\Parents;


class Table {

    protected $table;

    public function __construct()
    {
        $dsn = "mysql:host=$host;dbname=photocommunity";
        $opt = array(
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_NUM
        );
        $this->table = new \PDO('mysql:host=127.0.0.1;dbname=photocommunity', 'root', '', $opt);
        if(!$this->table) {throw new \Exception("Error conection to db" , 4);}
    }

    public function getTable()
    {
        return $this->table;
    }



}