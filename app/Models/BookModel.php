<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table = 'book';
    protected $primaryKey = 'book_id';
    protected $allowedFields = ['book_cover', 'title', 'category_id', 'author', 'publish_date', 'quantity' , '	qr_code'];
    protected $returnType = 'object'; // Ensure objects are returned to access relationships
 



    // public function countExistingBooks()
    // {
    //     return $this->selectSum('quantity')->where('quantity >', 0)->get()->getRow()->quantity;
    // }

    // Method to count all books
    public function countAllBooks()
    {
        return $this->countAllResults();
    }

}
