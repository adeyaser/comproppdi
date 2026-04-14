<?php namespace App\Controllers;

class ProgramController extends BaseController {
    public function index()
    {
        $programModel = new \App\Models\ProgramModel();
        $transactionModel = new \App\Models\TransactionModel();

        $programs = $programModel->where('is_active', 1)->findAll();
        foreach ($programs as &$prog) {
            $amount = $transactionModel->where('program_id', $prog['id'])->where('status', 'success')->selectSum('amount')->first()['amount'] ?? 0;
            $total_collected = $amount + $prog['collected_amount'];
            $prog['actual_collected'] = $total_collected;
            $prog['progress_percentage'] = ($prog['target_amount'] > 0) ? min(100, round(($total_collected / $prog['target_amount']) * 100)) : 0;
        }

        // Pin 'Sucikan Harta dari Riba' as 1st, 'Pelindo Mengaji' as 2nd, and 'Sunatan' as 3rd
        usort($programs, function($a, $b) {
            $isARiba = (stripos($a['name'], 'riba') !== false) || (stripos($a['name'], 'sucikan harta') !== false);
            $isBRiba = (stripos($b['name'], 'riba') !== false) || (stripos($b['name'], 'sucikan harta') !== false);
            
            $isAMengaji = stripos($a['name'], 'mengaji') !== false;
            $isBMengaji = stripos($b['name'], 'mengaji') !== false;

            $isASunatan = (stripos($a['name'], 'sunat') !== false) || (stripos($a['name'], 'khitan') !== false);
            $isBSunatan = (stripos($b['name'], 'sunat') !== false) || (stripos($b['name'], 'khitan') !== false);

            if ($isARiba && !$isBRiba) return -1;
            if (!$isARiba && $isBRiba) return 1;
            
            if ($isAMengaji && !$isBMengaji) return -1;
            if (!$isAMengaji && $isBMengaji) return 1;

            if ($isASunatan && !$isBSunatan) return -1;
            if (!$isASunatan && $isBSunatan) return 1;

            return $b['id'] <=> $a['id']; // newest first for others
        });

        $data['programs'] = $programs;
        $data['title'] = 'Program Sosial & Kemanusiaan';

        return view('program/index', $data);
    }

    public function detail($segment)
    {
        $programModel = new \App\Models\ProgramModel();
        $transactionModel = new \App\Models\TransactionModel();

        $program = $programModel->where('slug', $segment)->first();
        if (!$program) {
            return view('pages/fallback', ['title' => 'Program: ' . ucwords(str_replace('-', ' ', $segment))]);
        }

        // Calculate progress tracking
        $amount = $transactionModel->where('program_id', $program['id'])->where('status', 'success')->selectSum('amount')->first()['amount'] ?? 0;
        $total_collected = $amount + $program['collected_amount'];
        $program['actual_collected'] = $total_collected;
        $program['progress_percentage'] = ($program['target_amount'] > 0) ? min(100, round(($total_collected / $program['target_amount']) * 100)) : 0;

        $data['program'] = $program;
        $data['title'] = $program['name'];

        return view('program/detail', $data);
    }
}
