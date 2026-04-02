<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MaziskaSeeder extends Seeder
{
    public function run()
    {
        // 1. Initial User
        $userData = [
            'username' => 'admin',
            'email'    => 'admin@maziska.org',
            'password' => password_hash('admin123', PASSWORD_BCRYPT),
            'role'     => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->db->table('users')->insert($userData);

        // 2. Default Settings
        $settingsData = [
            ['setting_key' => 'site_name', 'setting_value' => 'Maziska PPDI'],
            ['setting_key' => 'midtrans_enabled', 'setting_value' => '1'],
            ['setting_key' => 'midtrans_server_key', 'setting_value' => 'SB-Mid-server-xxxxxxxxxxxx'],
            ['setting_key' => 'midtrans_client_key', 'setting_value' => 'SB-Mid-client-xxxxxxxxxxxx'],
            ['setting_key' => 'is_production', 'setting_value' => '0'],
            ['setting_key' => 'api_gateway_key', 'setting_value' => 'maziska_secure_sys_key_2026'],
            ['setting_key' => 'contact_email', 'setting_value' => 'info@maziska-ppdi.org'],
            ['setting_key' => 'contact_phone', 'setting_value' => '0812-3456-7890'],
            ['setting_key' => 'contact_wa', 'setting_value' => '6281234567890'],
            ['setting_key' => 'contact_address', 'setting_value' => "Gedung Maziska PPDI\nJl. Sudirman No 45, Jakarta Selatan"],
            ['setting_key' => 'contact_maps', 'setting_value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126906.94589278771!2d106.7891551!3d-6.2297465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e489c62923%3A0xc3cf237d6e492215!2sJakarta%20Selatan%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid'],
            ['setting_key' => 'social_facebook', 'setting_value' => 'https://facebook.com/maziska.ppdi'],
            ['setting_key' => 'social_instagram', 'setting_value' => 'https://instagram.com/maziska.ppdi'],
            ['setting_key' => 'social_twitter', 'setting_value' => 'https://twitter.com/maziska_ppdi'],
            ['setting_key' => 'social_youtube', 'setting_value' => 'https://youtube.com/c/MaziskaPPDI'],
            ['setting_key' => 'social_tiktok', 'setting_value' => 'https://tiktok.com/@maziska.ppdi'],
        ];
        $this->db->table('settings')->insertBatch($settingsData);

        // 3. Initial Programs
        $programsData = [
            [
                'name' => 'Zakat Fitrah',
                'slug' => 'zakat-fitrah',
                'type' => 'zakat',
                'default_amount' => 45000,
                'description' => 'Zakat fitrah yang wajib ditunaikan setiap jiwa di bulan Ramadhan.',
                'image' => 'https://images.unsplash.com/photo-1542810634-71277d95dcbb',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Zakat Mal',
                'slug' => 'zakat-mal',
                'type' => 'zakat',
                'default_amount' => 0,
                'description' => 'Zakat atas harta yang telah mencapai nisab dan haul.',
                'image' => 'https://images.unsplash.com/photo-1593113511116-650a3cc46ba9',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Kurban Online',
                'slug' => 'kurban-online',
                'type' => 'donasi',
                'default_amount' => 2500000,
                'description' => 'Tunaikan ibadah kurban dengan hewan pilihan dan penyaluran tepat sasaran.',
                'image' => 'https://images.unsplash.com/photo-1532629345422-7515f3d16bb0',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('programs')->insertBatch($programsData);

        // 4. Initial Categories
        $categoriesData = [
            ['name' => 'Kemanusiaan', 'slug' => 'kemanusiaan', 'type' => 'berita'],
            ['name' => 'Kesehatan', 'slug' => 'kesehatan', 'type' => 'berita'],
            ['name' => 'Pendidikan', 'slug' => 'pendidikan', 'type' => 'berita'],
            ['name' => 'Ekonomi', 'slug' => 'ekonomi', 'type' => 'berita'],
        ];
        $this->db->table('categories')->insertBatch($categoriesData);

        // 5. Initial Pages
        $pagesData = [
            [
                'slug' => 'profile',
                'title' => 'Profil Maziska PPDI',
                'content' => 'Maziska PPDI adalah lembaga amil zakat yang mengelola dana umat secara profesional...',
                'type' => 'tentang',
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'slug' => 'struktur',
                'title' => 'Struktur Organisasi',
                'content' => 'Sistem tata kelola Maziska PPDI dipimpin oleh dewan syariah dan dewan operasional...',
                'type' => 'tentang',
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ];
        $this->db->table('pages')->insertBatch($pagesData);
    }
}
