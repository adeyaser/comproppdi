<?php namespace App\Controllers;

class PageController extends BaseController {
    public function tentang($segment) { 
        $pageModel = new \App\Models\PageModel();
        $page = $pageModel->where('slug', $segment)->first();
        if(!$page) return view('pages/fallback', ['title' => 'Tentang ' . ucfirst(str_replace('-', ' ', $segment))]);
        return view('pages/dynamic', ['page' => $page]); 
    }
    public function karir() { 
        $pageModel = new \App\Models\PageModel();
        $page = $pageModel->where('slug', 'karir')->first();
        if(!$page) return view('pages/fallback', ['title' => 'Karir di Maziska PPDI']);
        return view('pages/dynamic', ['page' => $page]);
    }
    public function kontak() { 
        $pageModel = new \App\Models\PageModel();
        $data['page'] = $pageModel->where('slug', 'kontak')->first();
        return view('pages/kontak', $data); 
    }

    public function sendContact()
    {
        $db = \Config\Database::connect();
        $data = [
            'name'       => $this->request->getPost('name'),
            'email'      => $this->request->getPost('email'),
            'subject'    => $this->request->getPost('subject'),
            'message'    => $this->request->getPost('message'),
            'status'     => 'unread',
            'created_at' => date('Y-m-d H:i:s')
        ];

        $db->table('contacts')->insert($data);

        return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim. Kami akan segera menghubungi Anda.');
    }
}
