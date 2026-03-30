<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KurbanPackageModel;

class AdminKurbanController extends BaseController
{
    public function index()
    {
        $model = new KurbanPackageModel();
        $data['packages'] = $model->orderBy('id', 'ASC')->findAll();
        $data['title'] = 'Kelola Paket Kurban';
        return view('admin/kurban/index', $data);
    }

    public function create()
    {
        return view('admin/kurban/create', ['title' => 'Tambah Paket Kurban']);
    }

    public function store()
    {
        $model = new KurbanPackageModel();
        
        $imageVal = $this->request->getPost('image') ?: 'https://images.unsplash.com/photo-1542810634-71277d95dcbb?w=800';
        $file = $this->request->getFile('image_file');
        if($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/kurban', $newName);
            $imageVal = base_url('uploads/kurban/' . $newName);
        }
        
        $data = [
            'name'         => $this->request->getPost('name'),
            'type'         => $this->request->getPost('type'),
            'price'        => $this->request->getPost('price'),
            'weight_range' => $this->request->getPost('weight_range'),
            'description'  => $this->request->getPost('description'),
            'image'        => $imageVal,
            'is_active'    => $this->request->getPost('is_active') ? 1 : 0
        ];

        if($model->insert($data)){
             return redirect()->to('/admin/kurban')->with('success', 'Paket Kurban berhasil ditambahkan.');
        }
        
        return redirect()->back()->with('error', 'Gagal menambahkan Paket Kurban.');
    }

    public function edit($id)
    {
        $model = new KurbanPackageModel();
        $data['package'] = $model->find($id);
        
        if(!$data['package']) {
             return redirect()->to('/admin/kurban')->with('error', 'Paket Kurban tidak ditemukan.');
        }

        $data['title'] = 'Edit Paket Kurban';
        return view('admin/kurban/edit', $data);
    }

    public function update($id)
    {
        $model = new KurbanPackageModel();
        
        $imageVal = $this->request->getPost('image');
        $file = $this->request->getFile('image_file');
        if($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/kurban', $newName);
            $imageVal = base_url('uploads/kurban/' . $newName);
        }

        $data = [
            'name'         => $this->request->getPost('name'),
            'type'         => $this->request->getPost('type'),
            'price'        => $this->request->getPost('price'),
            'weight_range' => $this->request->getPost('weight_range'),
            'description'  => $this->request->getPost('description'),
            'image'        => $imageVal,
            'is_active'    => $this->request->getPost('is_active') ? 1 : 0
        ];

        if($model->update($id, $data)){
             return redirect()->to('/admin/kurban')->with('success', 'Paket Kurban berhasil diperbarui.');
        }
        
        return redirect()->back()->with('error', 'Gagal memperbarui Paket Kurban.');
    }

    public function delete($id)
    {
        $model = new KurbanPackageModel();
        if($model->delete($id)){
            return redirect()->to('/admin/kurban')->with('success', 'Paket Kurban berhasil dihapus.');
        }
        return redirect()->back()->with('error', 'Gagal menghapus Paket Kurban.');
    }

    public function toggleStatus($id)
    {
        $model = new KurbanPackageModel();
        $package = $model->find($id);
        
        if($package) {
            $newStatus = $package['is_active'] ? 0 : 1;
            $model->update($id, ['is_active' => $newStatus]);
            return redirect()->to('/admin/kurban')->with('success', 'Status Paket Kurban berhasil diubah.');
        }
        
        return redirect()->to('/admin/kurban')->with('error', 'Paket Kurban tidak ditemukan.');
    }

    public function orders()
    {
        $orderModel = new \App\Models\KurbanOrderModel();
        
        $db = \Config\Database::connect();
        $builder = $db->table('kurban_orders');
        $builder->select('kurban_orders.*, kurban_packages.name as package_name');
        $builder->join('kurban_packages', 'kurban_packages.id = kurban_orders.package_id');
        $builder->orderBy('kurban_orders.id', 'DESC');
        $data['orders'] = $builder->get()->getResultArray();
        
        $data['title'] = 'Data Pesanan Kurban';
        return view('admin/kurban/orders', $data);
    }

    public function updateOrderStatus($id)
    {
        $orderModel = new \App\Models\KurbanOrderModel();
        $newStatus = $this->request->getPost('status');
        
        if (in_array($newStatus, ['daftar', 'konfirmasi', 'kurban'])) {
            $orderModel->update($id, ['status' => $newStatus]);
            return redirect()->to('/admin/kurban/orders')->with('success', 'Status pesanan berhasil diperbarui.');
        }
        
        return redirect()->back()->with('error', 'Status tidak valid.');
    }

    public function certificate($id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kurban_orders');
        $builder->select('kurban_orders.*, kurban_packages.name as package_name, kurban_packages.type as package_type');
        $builder->join('kurban_packages', 'kurban_packages.id = kurban_orders.package_id');
        $builder->where('kurban_orders.id', $id);
        $data['order'] = $builder->get()->getRowArray();

        if (!$data['order']) {
            return redirect()->back()->with('error', 'Data pesanan tidak ditemukan.');
        }

        $data['title'] = 'Sertifikat Kurban - ' . $data['order']['mudhohi_name'];
        return view('admin/kurban/certificate', $data);
    }
    public function quickUpdateStatus($id, $status)
    {
        $orderModel = new \App\Models\KurbanOrderModel();
        
        if (in_array($status, ['daftar', 'konfirmasi', 'kurban'])) {
            $orderModel->update($id, ['status' => $status]);
            return redirect()->to('/admin/kurban/orders')->with('success', 'Status pesanan kurban berhasil diperbarui menjadi ' . ucfirst($status) . '.');
        }
        
        return redirect()->to('/admin/kurban/orders')->with('error', 'Status pesanan tidak valid.');
    }
}
