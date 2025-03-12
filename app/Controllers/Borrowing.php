<?php

namespace App\Controllers;
use App\Models\BorrowerModel;
use App\Models\BookModel;
use CodeIgniter\Controller;
use CodeIgniter\Email\Email;


class Borrowing extends BaseController {
    
    
    public function addBorrower() {
        $borrowerModel = new BorrowerModel();

         $email = $this->request->getPost('email');
         $name = $this->request->getPost('name');
         $blacklistedBorrower = $borrowerModel->where('email', $email)
                                              ->where('fullname', $name)
                                              ->where('actual_return_date', null)
                                              ->where('expected_return_date <', date('Y-m-d H:i:s'))
                                              ->first();
         if ($blacklistedBorrower) {
             return $this->response->setJSON(['status' => 'error', 'message' => 'This borrower is blacklisted']);
         }



            $data = [
                'fullname' => $this->request->getPost('name'),
                'email' => $this->request->getPost('email'),
                'phone' => $this->request->getPost('phone'),
                'book_id' => $this->request->getPost('book-id'),
                // 'date_of_borrowing' => $this->request->getPost('Date_Of_Borrowing'),
                'expected_return_date' => $this->request->getPost('Expected_Return_Date'),
                // 'actual_return_date' => $this->request->getPost('Actual_Return_Date')
                'actual_return_date' => null

            ];
            
       
            $validationRules = [
                'name' => 'required|min_length[3]|max_length[255]',
                'email' => 'required|valid_email',
                'phone' => 'required|min_length[10]|max_length[15]',
                'book-id' => 'required|integer',
                // 'Date_Of_Borrowing' => 'required|valid_date',
                'Expected_Return_Date' => 'required|valid_date',
                // 'Actual_Return_Date' => 'required|valid_date'
            ];

           
            if (!$this->validate($validationRules)) {
               
                
                $errors = $this->validator->getErrors();
                
                return $this->response->setJSON(['status' => 'error', 'errors' => $errors]);

            }

           
            if ($borrowerModel->save($data)) {
                $borrowers = $borrowerModel->findAll();
                return $this->response->setJSON(['status' => 'success']);
            } else {
                
                return $this->response->setJSON(['status' => 'error', 'errors' => $borrowerModel->errors()]);
            }
         
       
    }



    
    
   
    public function fetchBorrowers() {
        $borrowerModel = new BorrowerModel();
        $bookModel = new BookModel();

        $borrowers = $borrowerModel->select('borrowing_record.*, book.title')
                                   ->join('book', 'book.book_id = borrowing_record.book_id')
                                   ->findAll(); 
    
        
        return $this->response->setJSON(['borrowers' => $borrowers]);
    }



    public function deleteBorrower() {
        $borrowerModel = new BorrowerModel();
        $borrowerId = $this->request->getPost('id'); 
        
    
       
        $borrower = $borrowerModel->find($borrowerId);
        if (!$borrower) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Borrower not found']);
        }
    
        if ($borrowerModel->delete($borrowerId)) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Borrower deleted successfully']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Failed to delete borrower']);
        }
    }

    
    public function getBorrower($id) {
        $borrowerModel = new BorrowerModel();
        $borrower = $borrowerModel->find($id);
    
        if ($borrower) {
            return $this->response->setJSON(['status' => 'success', 'borrower' => $borrower]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Borrower not found']);
        }
    }
    public function updateBorrower($id) {
        $data = [
            'fullname' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'phone' => $this->request->getPost('phone'),
            'book_id' => $this->request->getPost('book-id'),
            'date_of_borrowing' => $this->request->getPost('Date_Of_Borrowing'),
            'expected_return_date' => $this->request->getPost('Expected_Return_Date'),
            'actual_return_date' => $this->request->getPost('Actual_Return_Date')
        ];
    
        $validationRules = [
            'name' => 'required|min_length[3]|max_length[255]',
            'email' => 'required|valid_email',
            'phone' => 'required|min_length[10]|max_length[15]',
            'book-id' => 'required|integer',
            // 'Date_Of_Borrowing' => 'required|valid_date',
            'Expected_Return_Date' => 'required|valid_date',
            // 'Actual_Return_Date' => 'required|valid_date'
        ];
    
        if (!$this->validate($validationRules)) {
            $errors = $this->validator->getErrors();
            return $this->response->setJSON(['status' => 'error', 'errors' => $errors]);
        }
    
        $borrowerModel = new BorrowerModel();
        if ($borrowerModel->update($id, $data)) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'errors' => $borrowerModel->errors()]);
        }
    }





        
    public function updateActualReturnDate($id) {
        $data = [
            'actual_return_date' => $this->request->getPost('actual_return_date')
        ];

        $validationRules = [
            'actual_return_date' => 'required|valid_date'
        ];

        if (!$this->validate($validationRules)) {
            $errors = $this->validator->getErrors();
            return $this->response->setJSON(['status' => 'error', 'errors' => $errors]);
        }

        $borrowerModel = new BorrowerModel();
        if ($borrowerModel->update($id, $data)) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'errors' => $borrowerModel->errors()]);
        }
    }



    public function getLocalDateTime() {

        date_default_timezone_set('Asia/Amman');

        $localDateTime = date('Y-m-d H:i:s');
        return $this->response->setJSON(['localDateTime' => $localDateTime]);
    }

    
    
    // public function checkOverdueBorrowers()
    // {
    //     $borrowerModel = new BorrowerModel();
    //     $borrowers = $borrowerModel->findAll();

    //     foreach ($borrowers as $borrower) {
    //         if ($borrower['actual_return_date'] === null && $borrower['expected_return_date'] < date('Y-m-d')) {
    //       
    //             $borrowerModel->addToBlacklist($borrower['borrow_id']);
    //         }
    //     }
    // }


    
    public function checkOverdueBorrowers() {
        $borrowerModel = new BorrowerModel();
        $overdueBorrowers = $borrowerModel->getOverdueBorrowers();

        return $this->response->setJSON(['status' => 'success', 'data' => $overdueBorrowers]);
    }

   
    public function overdueListView() {

        echo view('Components/header');
        echo view('Components/blackList');
        echo view('Components/footer');
    }
    
    public function fetchAllNames()
    {
        $borrowerModel = new BorrowerModel();
        $names = $borrowerModel->findAll();
        $fullNames = array_column($names, 'fullname');
        return $this->response->setJSON(['names' => $fullNames]);
    }
    public function borrowerManagementView(){

      
        $bookModel = new BookModel();
        $data['books'] = $bookModel->findAll();

        echo view('Components/header');
        echo view('Components/borrowingRecord',$data);
        echo view('Components/footer');
    }



    

  
    
}
