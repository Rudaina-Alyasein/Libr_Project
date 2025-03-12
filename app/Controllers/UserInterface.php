<?php

namespace App\Controllers;

class UserInterface extends BaseController
{
    public function index()
    {
       echo view('/UserInterface/header');
       echo view('/UserInterface/home');
       echo view('/UserInterface/footer');

    }



    
}
