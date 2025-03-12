<?php

namespace App\Controllers;


class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }


    public function scanBook()
    {
        return view('/Components/scan_book');
    }
    public function login()
    {
        // echo view('/Components/header');
        // echo view('/Components/borrowingRecord');
        // echo view('/Components/footer');
        echo view('/Components/login');
    }
    // public function sidebar()
    // {
    //     echo view('/Components/header');
    //     echo view('/Components/borrowingRecord');
    //     echo view('/Components/footer');
    // }
    public function profile()
    {
        echo view('/Components/header');
        echo view('/Components/profile');
        echo view('/Components/footer');
    }
    public function user()
    {
        // echo view('/Components/header');
        echo view('/Components/user_interface');
        echo view('/Components/footer');
    }
    public function dashboard()
    {
        echo view('/Components/header');
        echo view('/Components/index');
        // echo view('/Components/charts');
        echo view('/Components/footer');
    }
    public function forget_password()
    {
        echo view('/Components/forgot-password');
    }
}
