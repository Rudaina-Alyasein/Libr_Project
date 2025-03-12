<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ReviewModel;

class CommentController extends Controller
{
    public function submitComment()
    {
        $request = service('request');
        $name = $request->getPost('name');
        $comment = $request->getPost('comment');
        $rating = $request->getPost('rating');
        $book_id = 1; // Assuming a fixed book_id for this example. You can modify as needed.

        $reviewModel = new ReviewModel();
        $data = [
            'book_id' => $book_id,
            'name' => $name,
            'comments' => $comment,
            'rating' => $rating
        ];

        if ($reviewModel->insert($data)) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error']);
        }
    }

    public function fetchComments()
    {
        $reviewModel = new ReviewModel();
        $comments = $reviewModel->where('book_id', 1)->findAll(); // Assuming a fixed book_id for this example.

        return $this->response->setJSON($comments);
    }
}
