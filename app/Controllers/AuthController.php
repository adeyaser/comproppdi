<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) return redirect()->to(base_url('admin'));
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $userModel = new \App\Models\UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->set([
                'id'         => $user['id'],
                'username'   => $user['username'],
                'role'       => $user['role'],
                'isLoggedIn' => true,
            ]);
            return redirect()->to(base_url('admin'));
        }

        return redirect()->back()->with('error', 'Username atau Password salah.');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }
}
