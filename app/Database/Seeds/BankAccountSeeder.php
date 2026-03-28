<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BankAccountSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'bank_name' => 'BSI',
                'account_number' => '9555555400',
                'account_name' => 'MAZISKA PPDI',
                'category' => 'zakat',
                'is_active' => 1,
            ],
            [
                'bank_name' => 'Mandiri',
                'account_number' => '0700001855555',
                'account_name' => 'MAZISKA PPDI',
                'category' => 'zakat',
                'is_active' => 1,
            ],
            [
                'bank_name' => 'BCA',
                'account_number' => '6860148755',
                'account_name' => 'MAZISKA PPDI',
                'category' => 'zakat',
                'is_active' => 1,
            ],
            [
                'bank_name' => 'BRI',
                'account_number' => '050401000239300',
                'account_name' => 'MAZISKA PPDI',
                'category' => 'zakat',
                'is_active' => 1,
            ],
            [
                'bank_name' => 'BNI',
                'account_number' => '5555505027',
                'account_name' => 'MAZISKA PPDI',
                'category' => 'zakat',
                'is_active' => 1,
            ],
            [
                'bank_name' => 'BSN',
                'account_number' => '7011001155',
                'account_name' => 'MAZISKA PPDI',
                'category' => 'zakat',
                'is_active' => 1,
            ],
        ];

        // Using Query Builder
        $this->db->table('bank_accounts')->insertBatch($data);
    }
}
