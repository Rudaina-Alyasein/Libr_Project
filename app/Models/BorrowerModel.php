<?php

namespace App\Models;

use CodeIgniter\Model;

class BorrowerModel extends Model
{
    protected $table = 'borrowing_record';

    protected $primaryKey = 'borrow_id';
    protected $allowedFields = ['fullname', 'phone', 'email', 'book_id', 'date_of_borrowing', 'expected_return_date', 'actual_return_date'];


    public function getOverdueBorrowers()
    {
        return $this->where('expected_return_date <', date('Y-m-d H:i:s'))
            ->where('actual_return_date', NULL)
            ->findAll();
    }



    public function isBlacklisted($email)
    {
        return $this->where('email', $email)
            ->where('expected_return_date <', date('Y-m-d H:i:s'))
            ->where('actual_return_date', NULL)
            ->countAllResults() > 0;
    }



    // public function countAllBorrowRecords()
    // {
    //     return $this->countAllResults();
    // }
}

    
    


