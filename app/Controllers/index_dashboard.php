<?php

namespace App\Controllers;


class profile_page extends BaseController
{

    public function dashboard()
    {
        echo view('/Components/header');
        echo view('/Components/index');
        // echo view('/Components/charts');
        echo view('/Components/footer');
    }

    
}
