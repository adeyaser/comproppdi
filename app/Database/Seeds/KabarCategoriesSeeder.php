<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KabarCategoriesSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Kemanusiaan',
            'Kesehatan',
            'Pendidikan dan Dakwah',
            'Kebencanaan',
            'Ekonomi Pedesaan',
            'Ekonomi Perkotaan',
            'Optimasi Publik'
        ];

        $data = [];
        foreach ($categories as $cat) {
            $data[] = [
                'name' => $cat,
                'slug' => url_title($cat, '-', true),
                'type' => 'berita'
            ];
        }

        // We can just ignore duplicates if they exist, but simple insertBatch is fine
        // clear existing berita categories first if we want
        $this->db->table('categories')->where('type', 'berita')->delete();
        $this->db->table('categories')->insertBatch($data);
    }
}
