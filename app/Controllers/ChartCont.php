<?php

namespace App\Controllers;

use App\Models\BorrowerModel;

class BorrowingController extends BaseController
{
    public function index()
    {
        $borrowerModel = new BorrowerModel();
        $data['borrowedBooksByCategory'] = $borrowerModel->getBorrowedBooksByCategory();

        return view('borrowing_view', $data);
    }
}
