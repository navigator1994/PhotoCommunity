<?php
/**
 * Created by PhpStorm.
 * User: Anton
 * Date: 27.06.2015
 * Time: 16:56
 */

namespace Modules\Parents;


class Validator {

    private $error;

    public function __construct()
    {

    }

    public function isValidSignUp($login,$password, $retypepassword, $name,$surname,$bdate, $avatar = 'http://photocommunity/Public/UserFiles/defaultAvatar.jpg', $email)
    {
        $imageinfo = getimagesize($avatar);
        if((!preg_match('/[a-zA-Z]{0,1}[a-zA-Z0-9._-]$/i', $login)) || (strlen($login)<3) || (strlen($login)>15)){
            $this->error = 'wrong login';
        }
        else if((!preg_match('/[a-zA-Z]{0,1}[a-zA-Z0-9._-]$/i', $password)) || (strlen($password)<6) || (strlen($password)>15)){
            $this->error = 'wrong password';
        }
        else if($retypepassword != $password){
            $this->error = 'wrong retype password';
        }
        else if((!preg_match('/[a-zA-Z]{0,1}[a-zA-Z0-9._-]$/i', $name)) || (strlen($name)<2) || (strlen($name)>15)){
            $this->error = 'wrong name';
        }
        else if((!preg_match('/[a-zA-Z]{0,1}[a-zA-Z0-9._-]$/i', $surname)) || (strlen($surname)<2) || (strlen($surname)>15)){
            $this->error = 'wrong surname';
        }
        else if(!$bdate = '00-00-0000'){
            $this->error = 'empty date';
        }
        else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $this->error = 'wrong email';
        }
        if (($imageinfo['mime'] != 'image/gif') && ($imageinfo['mime'] != 'image/jpeg') && ($imageinfo['mime'] != 'image/png')) {
            $this->error = 'wrong image';
        }
        else{
            return true;
        }
    }

    public function isValidSingIn($login,$password)
    {
        if((!preg_match('/[a-zA-Z]{0,1}[a-zA-Z0-9._-]$/i', $login)) || (strlen($login)<3) || (strlen($login)>15)){
            $this->error = 'wrong login';
        }
        else if((!preg_match('/[a-zA-Z]{0,1}[a-zA-Z0-9._-]$/i', $password)) || (strlen($password)<6) || (strlen($password)>15)){
            $this->error = 'wrong password';
        }
        else
        {
            return true;
        }

    }

    public function isValidPhoto($file)
    {
        $imageinfo = getimagesize($file);
        if (($imageinfo['mime'] != 'image/gif') && ($imageinfo['mime'] != 'image/jpeg') && ($imageinfo['mime'] != 'image/png')) {
            $this->error = 'wrong image';
        }
        else return true;
    }

    public function isValidComments($text)
    {
        if((!empty($text)) && (strlen($text)<255)) {
            return true;
        }
    }

    public function getErrorMessage()
    {
        return $this->error;
    }



}