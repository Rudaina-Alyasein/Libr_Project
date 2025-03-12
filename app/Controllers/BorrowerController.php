<?php

namespace App\Controllers;

use App\Models\BorrowerModel;
use CodeIgniter\Controller;

class BorrowerController extends BaseController

{
    public function index()
    {
        echo view('/Components/header');
        $borrowerModel = new BorrowerModel();

        // Get count of existing books
        $existingBorrowerCount = $borrowerModel-> countAllBorrowRecords();

        // Pass data to the view
        $data['existingBorrowerCount'] = $existingBorrowerCount;

        echo view('/Components/index', $data);
        return  view('/Components/footer');
    }
}
