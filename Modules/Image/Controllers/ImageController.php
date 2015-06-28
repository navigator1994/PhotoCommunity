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

    public function showAction()
    {
        $option = $this->getQption();
        $this->view('image','show', array(  'image'     =>  $this->model->getImage($option),
                                            'comments'  =>  $this->model->getComments($option)));
    }

    public function commentAction()
    {
        $this->model->comment($this->getQption());
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function deleteAction()
    {
        $this->model->delete($this->getQption());
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public function likeAction()
    {
        $like = $this->model->like($this->getQption(),'like');
        if (!$like) {
            throw new \Exception('you have already voted');
        }
        else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

    public function disLikeAction()
    {
        $dislike = $this->model->like($this->getQption(),'dislike');
        if (!$dislike) {
            throw new \Exception('you have already voted');
        }
        else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }
    }

}