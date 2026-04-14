<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AddMustahikSetting extends Seeder
{
    public function run()
    {
        // Check if setting already exists
        $builder = $this->db->table('settings');
        $exists = $builder->where('setting_key', 'manual_mustahik')->countAllResults() > 0;

        if (!$exists) {
            $builder->insert([
                'setting_key'   => 'manual_mustahik',
                'setting_value' => '0',
            ]);
        }
    }
}
