<?php namespace App\Controllers;

class LayananController extends BaseController {
    public function detail($segment) { 
        if($segment === 'jemput-zakat') {
            return view('layanan/jemput_zakat');
        }
        
        if($segment === 'rekening' || $segment === 'rekening-donasi' || $segment === 'rekening-ppdi') {
            $bankModel = new \App\Models\BankAccountModel();
            $data['accounts'] = $bankModel->where('is_active', 1)->findAll();
            return view('layanan/rekening', $data);
        }

        if($segment === 'kurban-online') {
            $kurbanModel = new \App\Models\KurbanPackageModel();
            $data['packages'] = $kurbanModel->where('is_active', 1)->orderBy('id', 'ASC')->findAll();
            return view('layanan/kurban_online', $data);
        }
        
        if($segment === 'konfirmasi') {
            $programModel = new \App\Models\ProgramModel();
            $bankModel = new \App\Models\BankAccountModel();
            $data['programs'] = $programModel->where('is_active', 1)->findAll();
            $data['banks'] = $bankModel->where('is_active', 1)->findAll();
            $data['title'] = 'Konfirmasi Pembayaran Manual';
            return view('layanan/konfirmasi', $data);
        }
        
        // Cek halaman dinamis di database
        $pageModel = new \App\Models\PageModel();
        $page = $pageModel->where('slug', $segment)->where('type', 'layanan')->first();
        
        if($page) {
            return view('pages/dynamic', ['page' => $page]);
        }

        return view('pages/fallback', ['title' => 'Layanan: ' . ucwords(str_replace('-', ' ', $segment))]); 
    }

    public function storeKonfirmasi()
    {
        $transactionModel = new \App\Models\TransactionModel();
        
        $file = $this->request->getFile('proof_image');
        $proofPath = null;
        if($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/proofs', $newName);
            $proofPath = base_url('uploads/proofs/' . $newName);
        }

        $data = [
            'transaction_id'=> 'MNL-' . date('Ymd') . '-' . rand(1000, 9999),
            'program_id'  => $this->request->getPost('program_id'),
            'donor_name'  => $this->request->getPost('donor_name'),
            'donor_email' => $this->request->getPost('donor_email') ?: 'no-email@maziska.org',
            'donor_phone' => $this->request->getPost('donor_phone'),
            'amount'      => $this->request->getPost('amount'),
            'status'      => 'pending',
            'payment_method'=> 'Transfer ' . $this->request->getPost('bank_destination'),
            'proof_image' => $proofPath
        ];

        $transactionModel->insert($data);
        return redirect()->to(base_url())->with('success', 'Konfirmasi pembayaran berhasil dikirim. Menunggu verifikasi admin.');
    }

    public function pesanKurban($id)
    {
        $kurbanModel = new \App\Models\KurbanPackageModel();
        $data['package'] = $kurbanModel->find($id);

        if (!$data['package'] || !$data['package']['is_active']) {
            return redirect()->to('/layanan/kurban-online')->with('error', 'Paket kurban tidak valid atau tidak tersedia.');
        }

        $data['title'] = 'Formulir Pemesanan Kurban - ' . $data['package']['name'];
        return view('layanan/kurban_form', $data);
    }

    public function storeKurban()
    {
        $orderModel = new \App\Models\KurbanOrderModel();
        $packageModel = new \App\Models\KurbanPackageModel();

        $package_id = $this->request->getPost('package_id');
        $package = $packageModel->find($package_id);

        if (!$package) {
            return redirect()->back()->with('error', 'Paket kurban tidak valid.');
        }

        $orderCode = 'KBN-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5));

        $data = [
            'order_code'   => $orderCode,
            'package_id'   => $package_id,
            'mudhohi_name' => $this->request->getPost('mudhohi_name'),
            'phone'        => $this->request->getPost('phone'),
            'address'      => $this->request->getPost('address'),
            'niat_notes'   => $this->request->getPost('niat_notes'),
            'amount'       => $package['price'],
            'status'       => 'daftar'
        ];

        if ($orderModel->insert($data)) {
            return redirect()->to('/layanan/kurban-online/invoice/' . $orderCode)->with('success', 'Pemesanan berhasil dicatat.');
        }

        return redirect()->back()->with('error', 'Gagal memproses pemesanan.');
    }

    public function invoiceKurban($orderCode)
    {
        $orderModel = new \App\Models\KurbanOrderModel();
        $packageModel = new \App\Models\KurbanPackageModel();
        $bankModel = new \App\Models\BankAccountModel();

        $data['order'] = $orderModel->where('order_code', $orderCode)->first();
        
        if (!$data['order']) {
            return redirect()->to('/layanan/kurban-online')->with('error', 'Pesanan tidak ditemukan.');
        }

        $data['package'] = $packageModel->find($data['order']['package_id']);
        $data['banks'] = $bankModel->where('is_active', 1)->findAll();
        $data['title'] = 'Invoice & Pembayaran Kurban ' . $orderCode;

        return view('layanan/kurban_invoice', $data);
    }
    public function kalkulator() { return view('layanan/kalkulator'); }
}
