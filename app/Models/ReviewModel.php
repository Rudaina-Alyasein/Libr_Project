<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table = 'book_review';
    protected $primaryKey = 'review_id';
    protected $allowedFields = ['name', 'comments', 'rating'];
}
