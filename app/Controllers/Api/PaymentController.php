<?php namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;

class PaymentController extends ResourceController
{
    protected $format = 'json';
    
    // System Payload Validation
    private function validatePayload()
    {
        // Example logic for systematic payloads checking API key
        $key = $this->request->getHeaderLine('X-API-KEY');
        if ($key !== 'maziska_secure_sys_key_2026') {
            return false;
        }
        return true;
    }

    public function checkout()
    {
        if (!$this->validatePayload()) {
            return $this->failUnauthorized('Invalid Systematic Payload Key');
        }

        $settingModel = new \App\Models\SettingModel();
        if ($settingModel->getSetting('midtrans_enabled') !== '1') {
            return $this->respond([
                'status'  => 'error',
                'message' => 'Payment Gateway Saat Ini Sedang Dinonaktifkan'
            ], 400);
        }

        $json = $this->request->getJSON();
        
        // 1. Save Transaction to DB depending on Type
        if(isset($json->package_id)) {
            $orderId = 'KBN-' . time() . '-' . rand(100, 999);
            $orderModel = new \App\Models\KurbanOrderModel();
            $orderModel->insert([
                'order_code'   => $orderId,
                'package_id'   => $json->package_id,
                'mudhohi_name' => $json->donor_name ?? $json->name ?? 'Hamba Allah',
                'phone'        => $json->donor_phone ?? $json->phone ?? '',
                'address'      => $json->address ?? '',
                'niat_notes'   => $json->niat_notes ?? '',
                'amount'       => $json->amount ?? 0,
                'status'       => 'midtrans-pending'
            ]);
        } else {
            $orderId = 'ZIS-' . time() . '-' . rand(100, 999);
            $transactionModel = new \App\Models\TransactionModel();
            $transactionModel->insert([
                'transaction_id' => $orderId,
                'program_id'     => $json->program_id ?? 1,
                'donor_name'     => $json->donor_name ?? $json->name ?? 'Hamba Allah',
                'donor_email'    => $json->donor_email ?? $json->email ?? '',
                'donor_phone'    => $json->donor_phone ?? $json->phone ?? '',
                'amount'         => $json->amount ?? 0,
                'payment_method' => 'Midtrans-Pending',
                'status'         => 'pending',
                'created_at'     => date('Y-m-d H:i:s')
            ]);
        }

        // 2. Midtrans Simulation
        return $this->respond([
            'status' => 'success',
            'message' => 'Token created successfully',
            'data' => [
                'token' => 'dummy_token_'.bin2hex(random_bytes(10)),
                'redirect_url' => 'https://app.sandbox.midtrans.com/snap/v2/vtweb/dummy',
                'order_id' => $orderId
            ]
        ]);
    }

    public function notification()
    {
        // Handling midtrans webhook
        $json = $this->request->getJSON();
        $orderId = $json->order_id ?? null;
        $transactionStatus = $json->transaction_status ?? null;
        
        // Handle logic saving to DB
        return $this->respond(['status' => 'ok']);
    }
}
