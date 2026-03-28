<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DummyPostsSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        // Ambil kategori yang baru dibuat
        $kategoriKemanusiaan = $db->table('categories')->where('slug', 'kemanusiaan')->get()->getRowArray();
        $kategoriPendidikan = $db->table('categories')->where('slug', 'pendidikan-dan-dakwah')->get()->getRowArray();
        
        if (!$kategoriKemanusiaan || !$kategoriPendidikan) {
            return; // Safety check
        }
        
        $posts = [
            [
                'category_id' => $kategoriKemanusiaan['id'],
                'title' => 'Penyaluran Bantuan Kemanusiaan untuk Korban Terdampak Banjir',
                'slug' => 'penyaluran-bantuan-kemanusiaan-banjir',
                'image' => 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Menyikapi musibah banjir yang melanda baru-baru ini, Maziska PPDI segera mengambil tindakan tanggap darurat untuk mendistribusikan kebutuhan pokok.',
                'content' => '<h2>Langkah Cepat Penanganan Bencana</h2><p>Tim relawan kami segera mendirikan posko bersama dan mendistribusikan bantuan berupa bahan pokok makanan, pakaian layak, dan obat-obatan. Dukungan besar dari para donatur memungkinkan pergerakan tanggap darurat ini dapat terlaksana dalam hitungan jam setelah peringatan pertama dikeluarkan.</p>',
                'status' => 'published',
                'published_at' => date('Y-m-d H:i:s')
            ],
            [
                'category_id' => $kategoriPendidikan['id'],
                'title' => 'Program Santunan dan Beasiswa Anak Yatim Piatu',
                'slug' => 'santunan-anak-yatim-piatu',
                'image' => 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Maziska PPDI menyalurkan bantuan dana pendidikan bulanan sebagai wujud komitmen untuk mencerdaskan generasi bangsa, khususnya kepada anak-anak yatim.',
                'content' => '<h2>Membangun Harapan Baru</h2><p>Pendidikan adalah hak setiap anak. Dengan bantuan penyaluran santunan yang berkelanjutan ini, kami bertujuan membantu adik-adik yatim piatu di pelosok agar tetap dapat melanjutkan sekolah hingga lulus pendidikan wajib. Selain itu, kami juga menyediakan layanan bimbingan belajar gratis.</p>',
                'status' => 'published',
                'published_at' => date('Y-m-d H:i:s', strtotime('-1 days'))
            ],
            [
                'category_id' => $kategoriKemanusiaan['id'],
                'title' => 'Bantuan Kesehatan Gratis untuk Masyarakat Lansia',
                'slug' => 'bantuan-kesehatan-gratis-lansia',
                'image' => 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?auto=format&fit=crop&w=800&q=80',
                'excerpt' => 'Pemeriksaan kesehatan gratis dan pembagian vitamin untuk kelompok masyarakat rentan dan lansia.',
                'content' => '<h2>Akses Kesehatan Untuk Semua</h2><p>Sinergi bersama tenaga medis lokal sangat membantu kami dalam memeriksa kesehatan para lansia secara rutin setiap bulan. Kami juga membagikan sembako dan multivitamin. Mari terus dukung program kesehatan kami.</p>',
                'status' => 'published',
                'published_at' => date('Y-m-d H:i:s', strtotime('-2 days'))
            ]
        ];

        $db->table('posts')->insertBatch($posts);
    }
}
