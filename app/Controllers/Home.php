<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $programModel = new \App\Models\ProgramModel();
        $postModel = new \App\Models\PostModel();
        $transactionModel = new \App\Models\TransactionModel();

        $allActive = $programModel->where('is_active', 1)->findAll();
        $zakat_items = [];
        $program_items = [];
        
        foreach($allActive as $prog) {
            $collected = clone $transactionModel;
            $amount = $collected->where('program_id', $prog['id'])->where('status', 'success')->selectSum('amount')->first()['amount'] ?? 0;
            $total_collected = $amount + $prog['collected_amount'];
            $prog['collected_amount'] = $total_collected;
            $prog['progress_percentage'] = ($prog['target_amount'] > 0) ? min(100, round(($total_collected / $prog['target_amount']) * 100)) : 0;
            
            if($prog['type'] == 'zakat') {
                $zakat_items[] = $prog;
            } else {
                $program_items[] = $prog;
            }
        }
        
        // Also keep the limited 'programs' for the cards below the hero
        $programs = array_slice($program_items, 0, 3);

        $bankModel = new \App\Models\BankAccountModel();
        
        $data = [
            'programs' => $programs,
            'news'     => $postModel->where('status', 'published')->orderBy('created_at', 'DESC')->limit(4)->findAll(),
            'total_danaterkumpul' => $transactionModel->where('status', 'success')->selectSum('amount')->first()['amount'] ?? 0,
            'total_muzaki'        => $transactionModel->where('status', 'success')->countAllResults(),
            'banks'               => $bankModel->where('is_active', 1)->findAll(),
            'zakat_items'         => $zakat_items,
            'program_items'       => $program_items,
        ];

        return view('home/index', $data);
    }
}
