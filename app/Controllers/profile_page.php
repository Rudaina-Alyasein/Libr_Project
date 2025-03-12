<?php

namespace App\Controllers;


class profile_page extends BaseController
{

    public function profile_page()
    {
        echo view('/Components/header');
        echo view('/Components/profile');
        echo view('/Components/footer');
    }
}
