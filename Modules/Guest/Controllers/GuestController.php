<?php

namespace Modules\Guest;

use Modules\Parents;

class GuestController extends Parents\ParentController {

    public function indexAction()
    {
        parent::view("Guest","index");
    }

}