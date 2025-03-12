<?php

namespace App\Controllers;


class user extends BaseController
{

    public function user()
    {
        // echo view('/Components/header');
        echo view('/Components/user_interface');
        echo view('/Components/footer');
    }
}
