<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index(): string
    {
        $transactionModel = new \App\Models\TransactionModel();
        $settingModel = new \App\Models\SettingModel();

        // Get total amounts (Only SUCCESS status)
        $data = [
            'total_zakat_fitrah' => $transactionModel->where('status', 'success')->join('programs', 'programs.id = transactions.program_id')->where('programs.slug', 'zakat-fitrah')->selectSum('amount')->first()['amount'] ?? 0,
            'total_zakat_mal'    => $transactionModel->where('status', 'success')->join('programs', 'programs.id = transactions.program_id')->where('programs.slug', 'zakat-mal')->selectSum('amount')->first()['amount'] ?? 0,
            'total_zakat_profesi'=> $transactionModel->where('status', 'success')->join('programs', 'programs.id = transactions.program_id')->where('programs.slug', 'zakat-profesi')->selectSum('amount')->first()['amount'] ?? 0,
            'total_infaq'        => $transactionModel->where('status', 'success')->join('programs', 'programs.id = transactions.program_id')->where('programs.slug', 'infaq')->selectSum('amount')->first()['amount'] ?? 0,
            'total_sedekah'      => $transactionModel->where('status', 'success')->join('programs', 'programs.id = transactions.program_id')->where('programs.slug', 'sedekah')->selectSum('amount')->first()['amount'] ?? 0,
            'total_fidyah'       => $transactionModel->where('status', 'success')->join('programs', 'programs.id = transactions.program_id')->where('programs.slug', 'fidyah')->selectSum('amount')->first()['amount'] ?? 0,
            'total_zis'          => $transactionModel->where('status', 'success')->selectSum('amount')->first()['amount'] ?? 0,
            'total_pending'      => $transactionModel->where('status', 'pending')->selectSum('amount')->first()['amount'] ?? 0,
            'midtrans_status'    => $settingModel->getSetting('midtrans_enabled'),
            'recent_transactions' => $transactionModel->orderBy('created_at', 'DESC')->limit(10)->findAll(),
            'transaction_count'  => $transactionModel->countAllResults(),
        ];

        return view('admin/dashboard/index', $data);
    }

    public function toggleMidtrans()
    {
        $settingModel = new \App\Models\SettingModel();
        $current = $settingModel->getSetting('midtrans_enabled');
        $newStatus = ($current == '1') ? '0' : '1';
        
        $setting = $settingModel->where('setting_key', 'midtrans_enabled')->first();
        if ($setting) {
            $settingModel->update($setting['id'], (object)['setting_value' => $newStatus]);
        }
        
        return redirect()->to(base_url('admin'))->with('message', 'Status Midtrans Berhasil Diubah: ' . ($newStatus == '1' ? 'Enabled' : 'Disabled'));
    }

    public function pages(): string
    {
        $pageModel = new \App\Models\PageModel();
        $data['pages'] = $pageModel->findAll();
        return view('admin/dashboard/pages', $data);
    }

    public function contacts(): string
    {
        $contactModel = new \App\Models\ContactModel();
        $data['contacts'] = $contactModel->orderBy('created_at', 'DESC')->findAll();
        $data['title'] = 'Kotak Masuk Pesan';
        return view('admin/dashboard/contacts', $data);
    }

    public function contactDelete($id)
    {
        $contactModel = new \App\Models\ContactModel();
        $contactModel->delete($id);
        return redirect()->to(base_url('admin/contacts'))->with('message', 'Pesan berhasil dihapus');
    }

    public function posts(): string
    {
        $postModel = new \App\Models\PostModel();
        $data['posts'] = $postModel->orderBy('created_at', 'DESC')->findAll();
        return view('admin/dashboard/posts', $data);
    }

    public function programs(): string
    {
        $programModel = new \App\Models\ProgramModel();
        $data['programs'] = $programModel->findAll();
        return view('admin/dashboard/programs', $data);
    }

    public function transactions(): string
    {
        $transactionModel = new \App\Models\TransactionModel();
        $data['transactions'] = $transactionModel->orderBy('created_at', 'DESC')->findAll();
        return view('admin/dashboard/transactions', $data);
    }

    public function settings(): string
    {
        $settingModel = new \App\Models\SettingModel();
        $data['settings'] = $settingModel->findAll();
        $data['title'] = 'Pengaturan Sistem';
        return view('admin/dashboard/settings', $data);
    }

    // --- POSTS CRUD ---
    public function postCreate()
    {
        $db = \Config\Database::connect();
        $data['categories'] = $db->table('categories')->where('type', 'berita')->get()->getResultArray();
        $data['devices'] = \App\Helpers\BroadcastHelper::getDevices();
        $data['title'] = 'Tulis Berita Baru';
        return view('admin/dashboard/post_form', $data);
    }

    public function postEdit($id)
    {
        $postModel = new \App\Models\PostModel();
        $data['post'] = $postModel->find($id);
        if (!$data['post']) return redirect()->to(base_url('admin/posts'))->with('error', 'Post tidak ditemukan');
        
        $db = \Config\Database::connect();
        $data['categories'] = $db->table('categories')->where('type', 'berita')->get()->getResultArray();
        $data['devices'] = \App\Helpers\BroadcastHelper::getDevices();
        $data['title'] = 'Edit Berita';
        return view('admin/dashboard/post_form', $data);
    }

    public function postSave()
    {
        $postModel = new \App\Models\PostModel();
        $id = $this->request->getPost('id');
        
        $imageVal = $this->request->getPost('image') ?: 'https://images.unsplash.com/photo-1542810634-71277d95dcbb';
        $file = $this->request->getFile('image_file');
        if($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/posts', $newName);
            $imageVal = base_url('uploads/posts/' . $newName);
        }

        $data = [
            'category_id' => $this->request->getPost('category_id') ?: 1,
            'title'       => $this->request->getPost('title'),
            'slug'        => url_title($this->request->getPost('title'), '-', true),
            'image'       => $imageVal,
            'excerpt'     => $this->request->getPost('excerpt'),
            'content'     => $this->request->getPost('content'),
            'status'      => $this->request->getPost('status') ?: 'draft',
            'published_at'=> date('Y-m-d H:i:s')
        ];

        if ($id) {
            $postModel->update($id, $data);
            $msg = 'Berita berhasil diperbarui';
        } else {
            $id = $postModel->insert($data);
            $msg = 'Berita berhasil diterbitkan';
        }

        // Broadcast logic if Excel data provided and post saved successfully
        $broadcastResult = null;
        $broadcastInput = $this->request->getPost('broadcast_members');
        if($id && $broadcastInput) {
            $members = json_decode($broadcastInput, true);
            if($members && count($members) > 0) {
                // Ensure image exists, fallback to placeholder if not
                $broadcastImage = $data['image'] ?? 'https://images.bisnis.com/posts/2023/01/09/1616472/img-20230102-wa0035-1.jpg';
                
                // Prepare full text for broadcast
                $summary = $data['excerpt'] ?: $data['content'];
                $summary = strip_tags($summary);
                // WhatsApp image caption limit is 1024, leave room for header/footer
                $processedText = mb_strimwidth($summary, 0, 850, "...");
                
                // Prepare message
                $caption = "📢 *PADA KABAR MAZISKA PPDI*\n\n";
                $caption .= "*{$data['title']}*\n\n";
                $caption .= "﷽ Assalamu'alaikum Warahmatullah Wabarakatuh {title} {name}, Puji Syukur pada Allah ﷻ dan Shalawat Salam teruntuk Rasulullah ﷺ.\n\n";
                $caption .= trim($processedText) . "\n\n";
                $caption .= "Baca selengkapnya:\n" . base_url('kabar/' . $data['slug']);

                $selectedDeviceId = $this->request->getPost('device_id');
                $broadcastResult = \App\Helpers\BroadcastHelper::sendBulkMessage($members, $broadcastImage, $caption, $selectedDeviceId);
                session()->setFlashdata('broadcast_result', $broadcastResult);
            }
        }

        $finalMsg = $msg;
        if($broadcastResult) {
            $status = ($broadcastResult['status'] ?? false) ? 'Berhasil' : 'Gagal';
            $finalMsg .= " & Broadcast {$status}";
        }

        return redirect()->to(base_url('admin/posts'))->with('message', $finalMsg);
    }

    public function postDelete($id)
    {
        $postModel = new \App\Models\PostModel();
        $postModel->delete($id);
        return redirect()->to(base_url('admin/posts'))->with('message', 'Berita berhasil dihapus');
    }

    // --- PAGES CRUD ---
    public function pageCreate()
    {
        return view('admin/dashboard/page_form', ['title' => 'Tambah Halaman Baru']);
    }

    public function pageEdit($id)
    {
        $pageModel = new \App\Models\PageModel();
        $data['page'] = $pageModel->find($id);
        if (!$data['page']) return redirect()->to(base_url('admin/pages'))->with('error', 'Halaman tidak ditemukan');
        $data['title'] = 'Edit Halaman';
        return view('admin/dashboard/page_form', $data);
    }

    public function pageSave()
    {
        $pageModel = new \App\Models\PageModel();
        $id = $this->request->getPost('id');
        
        $imageVal = $this->request->getPost('image');
        $file = $this->request->getFile('image_file');
        if($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/pages', $newName);
            $imageVal = 'uploads/pages/' . $newName;
        }

        $slugInput = $this->request->getPost('slug');
        $slug = $slugInput ? url_title($slugInput, '-', true) : url_title($this->request->getPost('title'), '-', true);

        // Handle Gallery (for Struktur)
        $galleryData = [];
        $names = $this->request->getPost('gallery_name');
        if ($names) {
            $positions = $this->request->getPost('gallery_position');
            $existing_images = $this->request->getPost('existing_gallery_image');
            $gallery_files = $this->request->getFileMultiple('gallery_image');
            
            foreach ($names as $i => $name) {
                // Default to existing image
                $image_path = $existing_images[$i] ?? '';
                
                // If a new file is uploaded for this specific item
                if (isset($gallery_files[$i]) && $gallery_files[$i]->isValid() && !$gallery_files[$i]->hasMoved()) {
                    $newName = $gallery_files[$i]->getRandomName();
                    $gallery_files[$i]->move(FCPATH . 'uploads/pages/gallery', $newName);
                    $image_path = 'uploads/pages/gallery/' . $newName;
                }
                
                if($name || $image_path) {
                    $galleryData[] = [
                        'name' => $name,
                        'position' => $positions[$i] ?? '',
                        'image' => $image_path
                    ];
                }
            }
        }

        $data = [
            'title'   => $this->request->getPost('title'),
            'slug'    => $slug,
            'content' => $this->request->getPost('content'),
            'image'   => $imageVal,
            'gallery' => $galleryData ? json_encode($galleryData) : null,
            'type'    => $this->request->getPost('type') ?: 'page',
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($id) {
            $pageModel->update($id, (object)$data);
            $msg = 'Halaman berhasil diperbarui';
        } else {
            $pageModel->insert((object)$data);
            $msg = 'Halaman berhasil dibuat';
        }

        return redirect()->to(base_url('admin/pages'))->with('message', $msg);
    }

    public function pageDelete($id)
    {
        $pageModel = new \App\Models\PageModel();
        $pageModel->delete($id);
        return redirect()->to(base_url('admin/pages'))->with('message', 'Halaman berhasil dihapus');
    }

    // --- PROGRAMS CRUD ---
    public function programCreate()
    {
        return view('admin/dashboard/program_form', [
            'title' => 'Tambah Program Baru',
            'devices' => \App\Helpers\BroadcastHelper::getDevices()
        ]);
    }

    public function programEdit($id)
    {
        $programModel = new \App\Models\ProgramModel();
        $data['program'] = $programModel->find($id);
        $data['devices'] = \App\Helpers\BroadcastHelper::getDevices();
        $data['title'] = 'Edit Program';
        return view('admin/dashboard/program_form', $data);
    }

    public function programSave()
    {
        $programModel = new \App\Models\ProgramModel();
        $id = $this->request->getPost('id');
        
        $imageVal = $this->request->getPost('image');
        $file = $this->request->getFile('image_file');
        if($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/programs', $newName);
            $imageVal = base_url('uploads/programs/' . $newName);
        }

        $data = [
            'name'             => $this->request->getPost('name'),
            'slug'             => url_title($this->request->getPost('name'), '-', true),
            'type'             => $this->request->getPost('type'),
            'default_amount'   => $this->request->getPost('default_amount'),
            'target_amount'    => $this->request->getPost('target_amount'),
            'collected_amount' => $this->request->getPost('collected_amount'),
            'description'      => $this->request->getPost('description'),
            'image'            => $imageVal,
            'is_active'        => $this->request->getPost('is_active') ? 1 : 0
        ];

        if ($id) {
            $programModel->update($id, (object)$data);
        } else {
            $id = $programModel->insert((object)$data);
        }

        // Broadcast logic
        $broadcastInput = $this->request->getPost('broadcast_members');
        $broadcastResult = null;
        if($id && $broadcastInput) {
            $members = json_decode($broadcastInput, true);
            if($members && count($members) > 0) {
                $broadcastImage = $data['image'] ?? 'https://images.bisnis.com/posts/2023/01/09/1616472/img-20230102-wa0035-1.jpg';
                
                // Prepare message for program
                $caption = "✨ *PROGRAM BARU DI MAZISKA PPDI*\n\n";
                $caption .= "*{$data['name']}*\n";
                $caption .= "Tipe: " . strtoupper($data['type']) . "\n";
                if($data['target_amount'] > 0) {
                    $caption .= "Target: Rp " . number_format($data['target_amount'], 0, ',', '.') . "\n";
                }
                
                $caption .= "\n﷽ Assalamu'alaikum Warahmatullah Wabarakatuh {title} {name}, Puji Syukur pada Allah ﷻ dan Shalawat Salam teruntuk Rasulullah ﷺ.\n\n";

                // Add description (as much as possible)
                if(!empty($data['description'])) {
                    $cleanDesc = strip_tags($data['description']);
                    $longDesc = mb_strimwidth($cleanDesc, 0, 1000, "...");
                    $caption .= trim($longDesc) . "\n\n";
                }

                $caption .= "Berpartisipasi melalui website kami:\n" . base_url('program');

                $selectedDeviceId = $this->request->getPost('device_id');
                $broadcastResult = \App\Helpers\BroadcastHelper::sendBulkMessage($members, $broadcastImage, $caption, $selectedDeviceId);
                session()->setFlashdata('broadcast_result', $broadcastResult);
            }
        }

        $msg = 'Program berhasil disimpan';
        if($broadcastResult) {
            $status = ($broadcastResult['status'] ?? false) ? 'Berhasil' : 'Gagal';
            $msg .= " & Broadcast {$status}";
        }

        return redirect()->to(base_url('admin/programs'))->with('message', $msg);
    }

    public function programDelete($id)
    {
        $programModel = new \App\Models\ProgramModel();
        $programModel->delete($id);
        return redirect()->to(base_url('admin/programs'))->with('message', 'Program berhasil dihapus');
    }

    public function transactionUpdateStatus($id, $status)
    {
        $transactionModel = new \App\Models\TransactionModel();
        $transactionModel->update($id, (object)['status' => $status]);
        return redirect()->back()->with('message', 'Status transaksi berhasil diperbarui menjadi ' . strtoupper($status));
    }

    public function settingsUpdate()
    {
        $settingModel = new \App\Models\SettingModel();
        $posts = $this->request->getPost();
        
        foreach ($posts as $key => $value) {
            if ($key == 'csrf_test_name') continue;
            $setting = $settingModel->where('setting_key', $key)->first();
            if ($setting) {
                $settingModel->update($setting['id'], (object)['setting_value' => $value]);
            }
        }

        return redirect()->to(base_url('admin/settings'))->with('message', 'Pengaturan sistem berhasil diperbarui');
    }

    public function uploadFile()
    {
        $file = $this->request->getFile('file');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $path = FCPATH . 'uploads/cms';
            if (!is_dir($path)) mkdir($path, 0777, true);
            $newName = $file->getRandomName();
            $file->move($path, $newName);
            return $this->response->setJSON([
                'location' => base_url('uploads/cms/' . $newName)
            ]);
        }
        return $this->response->setStatusCode(400)->setJSON(['error' => 'Gagal mengupload file']);
    }

    public function patchDb() {
        $db = \Config\Database::connect();
        try { $db->query('ALTER TABLE programs ADD collected_amount DECIMAL(15,2) DEFAULT 0;'); echo "Added collected_amount<br>"; } catch (\Exception $e) {}
        try { $db->query('ALTER TABLE transactions ADD proof_image VARCHAR(255) NULL;'); echo "Added proof_image<br>"; } catch (\Exception $e) {}
    }

    public function devices(): string
    {
        $data['devices'] = \App\Helpers\BroadcastHelper::getDevices();
        $data['title'] = 'Status Device WhatsApp';
        return view('admin/dashboard/devices', $data);
    }
}
