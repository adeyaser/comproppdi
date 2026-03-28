<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BankAccountModel;

class AdminRekeningController extends BaseController
{
    public function index()
    {
        $model = new BankAccountModel();
        $data['accounts'] = $model->orderBy('id', 'DESC')->findAll();
        $data['title'] = 'Kelola Rekening Bank';
        return view('admin/rekening/index', $data);
    }

    public function create()
    {
        return view('admin/rekening/create', ['title' => 'Tambah Rekening Baru']);
    }

    public function store()
    {
        $model = new BankAccountModel();
        
        $data = [
            'bank_name'      => $this->request->getPost('bank_name'),
            'account_number' => $this->request->getPost('account_number'),
            'account_name'   => $this->request->getPost('account_name'),
            'category'       => $this->request->getPost('category'),
            'logo_url'       => $this->request->getPost('logo_url'),
            'is_active'      => $this->request->getPost('is_active') ? 1 : 0
        ];

        if($model->insert($data)){
             return redirect()->to('/admin/rekening')->with('success', 'Rekening berhasil ditambahkan.');
        }
        
        return redirect()->back()->with('error', 'Gagal menambahkan rekening.');
    }

    public function edit($id)
    {
        $model = new BankAccountModel();
        $data['account'] = $model->find($id);
        
        if(!$data['account']) {
             return redirect()->to('/admin/rekening')->with('error', 'Rekening tidak ditemukan.');
        }

        $data['title'] = 'Edit Rekening Bank';
        return view('admin/rekening/edit', $data);
    }

    public function update($id)
    {
        $model = new BankAccountModel();
        
        $data = [
            'bank_name'      => $this->request->getPost('bank_name'),
            'account_number' => $this->request->getPost('account_number'),
            'account_name'   => $this->request->getPost('account_name'),
            'category'       => $this->request->getPost('category'),
            'logo_url'       => $this->request->getPost('logo_url'),
            'is_active'      => $this->request->getPost('is_active') ? 1 : 0
        ];

        if($model->update($id, $data)){
             return redirect()->to('/admin/rekening')->with('success', 'Rekening berhasil diperbarui.');
        }
        
        return redirect()->back()->with('error', 'Gagal memperbarui rekening.');
    }

    public function delete($id)
    {
        $model = new BankAccountModel();
        if($model->delete($id)){
            return redirect()->to('/admin/rekening')->with('success', 'Rekening berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Gagal menghapus rekening.');
    }

    public function toggleStatus($id)
    {
        $model = new BankAccountModel();
        $account = $model->find($id);
        
        if($account) {
            $newStatus = $account['is_active'] ? 0 : 1;
            $model->update($id, ['is_active' => $newStatus]);
            return redirect()->to('/admin/rekening')->with('success', 'Status rekening berhasil diubah.');
        }
        
        return redirect()->to('/admin/rekening')->with('error', 'Rekening tidak ditemukan.');
    }
}
