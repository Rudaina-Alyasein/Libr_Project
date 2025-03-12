<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'cat_id'; 
    protected $allowedFields = ['cat_name'];

    
}