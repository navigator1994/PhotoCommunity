<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 27.06.2015
 * Time: 22:07
 */

namespace Modules\image;


use Modules\Parents\Table;
use Modules\Parents\Validator;

class Image {

    private $table;
    private $validator;
    public function __construct()
    {
        $DB = new Table();
        $this->table = $DB->getTable();
        $this->validator = new Validator();
    }

    public function upload()
    {
        if ($this->validator->isValidPhoto($_FILES['file']['tmp_name'])) {
            $path = "./Public/UserFiles/Images/" . $_SESSION['id'] . '/' . $_FILES['file']['name'];
            mkdir("./Public/UserFiles/Images/" . $_SESSION['id'], 0777);
            if (($this->table->query('INSERT INTO images (`user_id`,`link`) VALUE ("' . $_SESSION['id'] . '"," http://photocommunity' . $path . '")')) && (copy($_FILES['file']['tmp_name'], $path))) {
                return true;
            } else {
                return false;
            }
        }
        else return $this->validator->getErrorMessage();
    }

    public function getImage($image)
    {
        return $this->table->query('SELECT * FROM images WHERE id = '.$image)->fetch();
    }

    public function getComments($image)
    {
        $result;
        $query = $this->table->query('SELECT `users`.`avatar`, `users`.`name` ,`comments`.`text`,`users`.`id` FROM `users` INNER JOIN `comments` ON `users`.`id` = `comments`.`id` WHERE `photo_id` = '.$image);
        while($data = $query->fetch())
        {
            $result[] = $data;
        }
        return(array_reverse($result));
    }

    public function comment($image)
    {
        $validator = new Validator();
        if($validator->isValidComments($_POST['comment']))
        {
            $this->table->query('INSERT INTO `comments`(`id`,`photo_id`,`text`) VALUE ("'.$_SESSION['id'].'","'.$image.'","'.$_POST['comment'].'")');
        }
    }

    public function delete($id)
    {
        if(($_SESSION['access'] == 2) || ($_SESSION['id'] == $this->table->query('SELECT `user_id` FROM `images` WHERE `id` = '.$id)->fetch()[0])) {
            unlink(trim(str_replace("http://photocommunity", "", $this->table->query('SELECT `link` FROM `images` WHERE `id` = ' . $id . '; DELETE FROM `images` WHERE `id` =' . $id)->fetch()[0])));
        }
        else die('access deny');
    }

    public function like($id, $type)
    {
        if($this->table->query('SELECT `like_id` FROM `images` WHERE id = '.$id)->fetch()[0] != $_SESSION['id']) {
            return $this->table->query('INSERT INTO `like` (`user_id`,`photo_id`) VALUE ("' . $_SESSION['id'] . '","' . $id . '"); UPDATE `images` SET `' . $type . '` = `' . $type . '` + 1, `like_id` = ' . $_SESSION['id'] . ' WHERE `id` = ' . $id);
        }
    }


}