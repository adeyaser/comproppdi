<?php

namespace App\Controllers;

class Setup extends BaseController
{
    public function index()
    {
        $userModel = new \App\Models\UserModel();
        
        // Check if admin exists
        if ($userModel->where('username', 'admin')->first()) {
            return "Admin already exists!";
        }

        $userModel->insert([
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role'     => 'admin',
            'full_name' => 'Administrator Maziska',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return "Admin user created! <br> Username: admin <br> Password: admin123 <br><br> <a href='".base_url('login')."'>Go to Login</a>";
    }
}
