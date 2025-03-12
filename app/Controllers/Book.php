<?php


namespace App\Controllers;

use App\Models\BookModel;
use App\Models\CategoryModel;
use CodeIgniter\Controller;

class Book extends BaseController

{


    public function addBook() {


        $bookModel = new BookModel();


            $data = [

                'title' => $this->request->getPost('title'),
                'category_id' => $this->request->getPost('cat_id'),
                'author' => $this->request->getPost('author'),
                'publish_date' => $this->request->getPost('publish'),
                'quantity' => $this->request->getPost('quantity'),
            ];


            if ($imageFile = $this->request->getFile('book_cover')) {
                if ($imageFile->isValid() && !$imageFile->hasMoved()) {
                    $newName = $imageFile->getRandomName();
                    $imageFile->move(FCPATH . '/assets/uploads', $newName);     
                    $data['book_cover'] = $newName;
                }
            

            }


            $qrCode = $this->generateQRCode($data['title']); // Assuming title as QR content, you can change this
            $data['qr_code'] = $qrCode;
            $validationRules = [


                
                'title' => 'required|min_length[3]|max_length[255]',
                'cat_id' => 'required',
                'author' => 'required|min_length[3]|max_length[255]',
                'publish' => 'required|valid_date',
                'quantity' => 'required|integer',
                // 'bookcover' => 'uploaded[bookcover]|is_image[bookcover]|max_size[bookcover,2048]',


                'bookcover' => 'if_exist|is_image[bookcover]|max_size[bookcover,2048]'

            ];


    
            if (!$this->validate($validationRules)) {

                $errors = $this->validator->getErrors();
                return $this->response->setJSON(['status' => 'error', 'errors' => $errors]);
            }
    
            if ($bookModel->save($data)) {

                return $this->response->setJSON(['status' => 'success', 'message' => 'New book added successfully']);
            } else {
                return $this->response->setJSON(['status' => 'error', 'errors' => $bookModel->errors()]);
            }
        
    


 

}






public function fetchBooks() {
    $bookModel = new BookModel();
    $categoryModel = new CategoryModel();
    
    $books = $bookModel->select('book.*, category.cat_name')
                      ->join('category', 'category.cat_id = book.category_id')
                      ->findAll();
    
    return $this->response->setJSON(['books' => $books]);
}



public function bookManagementView(){

      
    $catModel = new CategoryModel();
    $data['cates'] = $catModel->findAll();

    echo view('Components/header');
    echo view('Components/bookManagement',$data);
    echo view('Components/footer');
}


public function deleteBook() {
    $bookModel = new BookModel();
    $bookId = $this->request->getPost('id'); 
    

   
    $book = $bookModel->find($bookId);
    if (!$book) {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Book not found']);
    }

    if ($bookModel->delete($bookId)) {
        return $this->response->setJSON(['status' => 'success', 'message' => 'Book deleted successfully']);
    } else {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete book']);
    }
}



public function getBook($id) {
    $bookModel = new BookModel();
    $book = $bookModel->find($id);

    if ($book) {
        return $this->response->setJSON(['status' => 'success', 'book' => $book]);
    } else {
        return $this->response->setJSON(['status' => 'error', 'message' => 'Book not found']);
    }
}
public function updateBook($id) {

    $data = [
        'title' => $this->request->getPost('title'),
        'category_id' => $this->request->getPost('cat_id'),
        'author' => $this->request->getPost('author'),
        'publish_date' => $this->request->getPost('publish'),
        'quantity' => $this->request->getPost('quantity'),
    ];


    
    if ($imageFile = $this->request->getFile('book_cover')) {
        if ($imageFile->isValid() && !$imageFile->hasMoved()) {
            $newName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . '/assets/uploads', $newName);     
            $data['book_cover'] = $newName;
        }
    }

    $validationRules = [
        'title' => 'required|min_length[3]|max_length[255]',
        'cat_id' => 'required',
        'author' => 'required|min_length[3]|max_length[255]',
        'publish' => 'required|valid_date',
        'quantity' => 'required|integer',
        'bookcover' => 'if_exist|is_image[bookcover]|max_size[bookcover,2048]'
    ];

    if (!$this->validate($validationRules)) {
        $errors = $this->validator->getErrors();
        return $this->response->setJSON(['status' => 'error', 'errors' => $errors]);
    }

    $bookModel = new BookModel();
    if ($bookModel->update($id, $data)) {
        return $this->response->setJSON(['status' => 'success']);
    } else {
        return $this->response->setJSON(['status' => 'error', 'errors' => $bookModel->errors()]);
    }
}


public function updateQuantity($id)
    {
        $bookModel = new BookModel();
        $quantity = $this->request->getPost('quantity');

        if ($bookModel->update($id, ['quantity' => $quantity])) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Quantity updated successfully']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to update quantity']);
        }
    }


    // public function updateQuantityByBorrower($id){
    //     $bookModel = new BookModel();
    //     $borrowerModel = new BorrowerModel();

    //     $quantity = $this->request->getPost('quantity');

    //     $book = 


        
    // }





}
