<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\BorrowerModel;
use App\Models\CategoryModel;

use CodeIgniter\Controller;

class DashboardController extends BaseController
{
    public function index()
    {
        echo view('/Components/header');
        $bookModel = new BookModel();

        // Get count of existing books
        $existingBooksCount = $bookModel->selectSum('quantity')->where('quantity >', 0)->get()->getRow()->quantity;

        // Pass data to the view
        $data['existingBooksCount'] = $existingBooksCount;

        $borrowerModel = new BorrowerModel();
        $data['existingBorrowersCount'] = $borrowerModel->countAllResults();
        $data['overdueBorrowersCount'] = count($borrowerModel->getOverdueBorrowers());
        $data['countDistinctBorrowers'] = $borrowerModel->select('fullname')
            ->distinct()
            ->countAllResults();



        // Correct join query using aliases to avoid conflicts
        $categoryModel = new CategoryModel();

        $data['borrowedBooksByCategory'] = $categoryModel->select('category.cat_name, COUNT(*) as borrow_count')
            ->join('book', 'book.category_id = category.cat_id')
            ->join('borrowing_record', 'borrowing_record.book_id = book.book_id')
            ->groupBy('category.cat_name')
            ->findAll();



        // print_r($data);



        echo view('/Components/index', $data);
        echo view('/Components/dash_footer');
    }
}
