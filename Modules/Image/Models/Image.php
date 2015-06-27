<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 27.06.2015
 * Time: 22:07
 */

namespace Modules\image;


use Modules\Parents\Table;

class Image {

    private $table;

    public function __construct()
    {
        $DB = new Table();
        $this->table = $DB->getTable();
    }

    public function upload()
    {
        $path = "./Public/UserFiles/Images/".$_SESSION['id'].'/'.$_FILES['file']['name'];
        mkdir("./Public/UserFiles/Images/".$_SESSION['id'], 0777);
        if(($this->table->query('INSERT INTO images (`user_id`,`link`) VALUE ("'.$_SESSION['id'].'"," http://photocommunity'.$path.'")')) && (copy($_FILES['file']['tmp_name'], $path))) {
            return true;
        }
        else{
            return false;
        }
    }
}