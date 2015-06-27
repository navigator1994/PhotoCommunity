<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 27.06.2015
 * Time: 22:07
 */

namespace Modules\Image;


use Modules\Parents\ParentController;

class ImageController extends ParentController{

    private $model;

    public function __construct()
    {
        $this->model = new Image();
    }
    public function indexAction(){}

    public function uploadAction()
    {
        if($this->model->upload()){
            header('Location: http://photocommunity/User');
        }
    }

}