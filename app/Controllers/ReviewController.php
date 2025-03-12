<?php

namespace App\Controllers;

use App\Models\ReviewModel;
use CodeIgniter\Controller;

class ReviewController extends Controller
{
    public function store()
    {

        $name = $this->request->getPost('name');
        $comments = $this->request->getPost('comment');
        $rating = $this->request->getPost('rating');

        // $name = 'khitam';
        // $comments = 'gjfogjo';
        // $rating = 2.5;

        $reviewModel = new ReviewModel();

        $data = [
            'name' => $name,
            'comments' => $comments,
            'rating' => $rating
        ];

        if ($reviewModel->insert($data)) {
            return $this->response->setJSON(['status' => 'success']);
        }
        // } else {
        //     return $this->response->setJSON(['success' => false]);
        // }
    }
    public function getReviews()
    {
        $reviewModel = new ReviewModel();
        $reviews = $reviewModel->findAll(); // استرجاع كل التقييمات

        if (!empty($reviews)) {
   
            // إذا تم استرجاع التقييمات بنجاح
            return $this->response->setJSON(['status' => 'success', 'reviews' => $reviews]);
        } else {
            // إذا فشل استرجاع التقييمات
            return $this->response->setJSON(['status' => 'error', 'message' => 'No reviews found']);
        }
    }
}
