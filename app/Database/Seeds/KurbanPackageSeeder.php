<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KurbanPackageSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name'         => 'Paket Personal (Kambing/Domba)',
                'type'         => 'kambing',
                'price'        => 2500000.00,
                'weight_range' => 'Bobot 25 - 30 KG',
                'description'  => 'Pilihan paket kurban personal untuk 1 orang dengan hewan setara kambing atau domba kualitas terbaik tersertifikasi.',
                'is_active'    => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'name'         => 'Paket Sapi Patungan (1/7)',
                'type'         => 'sapi_patungan',
                'price'        => 3000000.00,
                'weight_range' => 'Bobot Sapi 250 - 300 KG',
                'description'  => 'Paket kurban kolektif untuk maksimal 7 orang. Hemat, berkah bersama. Sangat direkomendasikan & menjadi paket yang paling populer.',
                'is_active'    => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'name'         => 'Paket Sapi Utuh',
                'type'         => 'sapi_utuh',
                'price'        => 21000000.00,
                'weight_range' => 'Bobot 250 - 300 KG',
                'description'  => 'Berkurban lebih eksklusif dan memberikan manfaat dalam kuantitas jumlah penerima yang lebih maksimal.',
                'is_active'    => 1,
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
            ]
        ];

        // Insert using query builder
        $this->db->table('kurban_packages')->insertBatch($data);
    }
}
