<?php namespace App\Controllers;

class ZakatController extends BaseController {
    public function detail($segment) { 
        $pageModel = new \App\Models\PageModel();
        $page = $pageModel->where('slug', $segment)->where('type', 'zakat')->first();
        
        if(!$page) {
            return view('pages/fallback', ['title' => 'Zakat: ' . ucwords(str_replace('-', ' ', $segment))]); 
        }

        return view('pages/dynamic', ['page' => $page]);
    }
    public function bayar() { 
        $programModel = new \App\Models\ProgramModel();
        $bankModel = new \App\Models\BankAccountModel();
        
        $typeFilter = $this->request->getGet('type');
        $query = $programModel->where('is_active', 1);
        
        if($typeFilter === 'zakat') {
            $query->where('type', 'zakat');
        }

        $data['programs'] = $query->findAll();
        $data['banks'] = $bankModel->where('is_active', 1)->findAll();
        return view('layanan/bayar_zakat', $data); 
    }
}
