<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NavigationSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        // 1. Pages Data
        $pages = [
            ['slug' => 'profile', 'title' => 'Profile', 'type' => 'tentang'],
            ['slug' => 'struktur', 'title' => 'Struktur Organisasi', 'type' => 'tentang'],
            ['slug' => 'piagam', 'title' => 'Piagam & Penghargaan', 'type' => 'tentang'],
            ['slug' => 'mitra', 'title' => 'Mitra', 'type' => 'tentang'],
            ['slug' => 'pemberitahuan', 'title' => 'Pemberitahuan', 'type' => 'tentang'],
            ['slug' => 'karir', 'title' => 'Karir', 'type' => 'tentang'],
            ['slug' => 'tentang', 'title' => 'Tentang Zakat', 'type' => 'zakat'],
            ['slug' => 'fitrah', 'title' => 'Zakat Fitrah', 'type' => 'zakat'],
            ['slug' => 'mal', 'title' => 'Zakat Mal', 'type' => 'zakat'],
            ['slug' => 'infak', 'title' => 'Infak', 'type' => 'zakat'],
            ['slug' => 'sedekah', 'title' => 'Sedekah', 'type' => 'zakat'],
            ['slug' => 'fidyah', 'title' => 'Fidyah', 'type' => 'zakat'],
            ['slug' => 'upz', 'title' => 'UPZ', 'type' => 'layanan'],
            ['slug' => 'zakat-karyawan', 'title' => 'Zakat Karyawan', 'type' => 'layanan'],
        ];

        foreach ($pages as $p) {
            $exists = $db->table('pages')->where('slug', $p['slug'])->where('type', $p['type'])->get()->getRow();
            if (!$exists) {
                $p['content'] = '<p>Konten untuk ' . $p['title'] . ' sedang disiapkan.</p>';
                $p['created_at'] = date('Y-m-d H:i:s');
                $db->table('pages')->insert($p);
            }
        }

        // 2. Programs Data
        $programs = [
            ['slug' => 'kemanusiaan', 'name' => 'Kemanusiaan', 'type' => 'donasi'],
            ['slug' => 'kesehatan', 'name' => 'Kesehatan', 'type' => 'donasi'],
            ['slug' => 'pendidikan-dakwah', 'name' => 'Pendidikan & Dakwah', 'type' => 'donasi'],
            ['slug' => 'kebencanaan', 'name' => 'Kebencanaan', 'type' => 'donasi'],
            ['slug' => 'ekonomi', 'name' => 'Ekonomi', 'type' => 'donasi'],
        ];

        foreach ($programs as $prog) {
            $exists = $db->table('programs')->where('slug', $prog['slug'])->get()->getRow();
            if (!$exists) {
                $prog['description'] = '<p>Program ' . $prog['name'] . ' mendukung kemaslahatan ummat.</p>';
                $prog['is_active'] = 1;
                $prog['created_at'] = date('Y-m-d H:i:s');
                $db->table('programs')->insert($prog);
            }
        }
    }
}
