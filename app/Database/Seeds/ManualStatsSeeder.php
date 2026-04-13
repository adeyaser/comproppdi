<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ManualStatsSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'setting_key'   => 'manual_dana_tersalurkan',
                'setting_value' => '0'
            ],
            [
                'setting_key'   => 'manual_muzaki_tetap',
                'setting_value' => '0'
            ]
        ];

        foreach ($data as $item) {
            $check = $this->db->table('settings')->where('setting_key', $item['setting_key'])->get()->getRow();
            if (!$check) {
                $this->db->table('settings')->insert($item);
            }
        }
    }
}
