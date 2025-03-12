<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index()
    {
        $data = [];
        helper(['form']);

        $rules = [
            'email' => 'required|min_length[6]|max_length[50]|valid_email',
            'password' => 'required|min_length[8]|max_length[255]|validateUser[email,password]',
        ];

        $errors = [
            'password' => [
                'validateUser' => 'Email or Password don\'t match'
            ]
        ];

        if (!$this->validate($rules, $errors)) {
            $data['validation'] = $this->validator;
        } else {
            $model = new UserModel();

            $user = $model->where('email', $this->request->getVar('email'))->first();

            $this->setUserSession($user);

            return redirect()->to('/dashboard');
        }

        echo view('components/login', $data);
    }

    public function newregister()
    {
        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'POST') {

            $rules = [
                'firstname' => 'required|min_length[3]|max_length[20]',
                'lastname' => 'required|min_length[3]|max_length[20]',
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[8]|max_length[255]',
                'confirm_password' => 'matches[password]',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $model = new UserModel();

                $newData = [
                    'firstname' => $this->request->getVar('firstname'),
                    'lastname' => $this->request->getVar('lastname'),
                    'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password'),
                ];

                $model->save($newData);
                $session = session();
                $session->setFlashdata('success', 'Successful Registration');
                return redirect()->to('/dashboard');
            }

            echo view('components/register', $data);
        }
    }

    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname'],
            'email' => $user['email'],
            'isLoggedIn' => true,
        ];

        session()->set($data);
        return true;
    }


    public function forgot_password_fp()
    {
        echo view('components/forgot-password');
    }
    public function reg()
    {
        echo view('components/register');
    }

    public function log()
    {
        echo view('components/login');
    }
    public function profile()
    {
        echo view('/Components/header');


        if (!session()->has('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userData = [
            'firstname' => session()->get('firstname'),
            'lastname' => session()->get('lastname'),
            'email' => session()->get('email')

        ];


        $data['user'] = $userData;


        return view('Components/profile', $data);
    }


    public function updateProfile()
    {

        if ($this->request->getMethod() == 'POST') {

            $userId = session()->get('id');


            $updatedData = [
                'firstname' => $this->request->getVar('firstname'),
                'lastname' => $this->request->getVar('lastname'),

            ];


            foreach ($updatedData as $key => $value) {
                session()->set($key, $value);
            }


            $model = new UserModel();
            $model->update($userId, $updatedData);



            $userData = [
                'firstname' => session()->get('firstname'),
                'lastname' => session()->get('lastname'),
                'email' => session()->get('email'),
            ];


            return $this->response->setJSON(['status' => 'success', 'userData' => $userData]);
        }
    }

    public function uploadProfilePicture()
    {
        if ($this->request->getMethod() == 'POST') {
            $file = $this->request->getFile('image');

            if ($file->isValid() && !$file->hasMoved()) {
                $newName = $file->getRandomName();
                $file->move('./assets/upload/', $newName);

                $profilePictureUrl = base_url('./assets/upload/' . $newName);

                $userId = session()->get('id');

                $model = new UserModel();
                $model->update($userId, ['image' => $profilePictureUrl]);

                session()->set('image', $profilePictureUrl);

                return $this->response->setJSON(['status' => 'success', 'image_url' => $profilePictureUrl]);
            }

            return $this->response->setJSON(['status' => 'error', 'errors' => $file->getErrorString()]);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Invalid request method']);
    }
}
