<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateKurbanPackagesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'type' => [
                'type'       => 'ENUM',
                'constraint' => ['kambing', 'sapi_patungan', 'sapi_utuh'],
                'default'    => 'kambing'
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '15,2',
                'default'    => 0.00
            ],
            'weight_range' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('kurban_packages');
    }

    public function down()
    {
        $this->forge->dropTable('kurban_packages');
    }
}
