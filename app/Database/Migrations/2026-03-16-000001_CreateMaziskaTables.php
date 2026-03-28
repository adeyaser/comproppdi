<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMaziskaTables extends Migration
{
    public function up()
    {
        // 1. users
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'role' => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'admin'],
            'username' => ['type' => 'VARCHAR', 'constraint' => 100],
            'email' => ['type' => 'VARCHAR', 'constraint' => 100],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users', true);

        // 2. pages
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'slug' => ['type' => 'VARCHAR', 'constraint' => 150, 'unique' => true],
            'title' => ['type' => 'VARCHAR', 'constraint' => 200],
            'content' => ['type' => 'LONGTEXT', 'null' => true],
            'image' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'type' => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'tentang'], // tentang, layanan, etc.
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pages', true);

        // 3. categories
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'slug' => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'type' => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'berita'], // berita, artikel, laporan
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('categories', true);

        // 4. posts
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'category_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'title' => ['type' => 'VARCHAR', 'constraint' => 200],
            'slug' => ['type' => 'VARCHAR', 'constraint' => 200, 'unique' => true],
            'image' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'excerpt' => ['type' => 'TEXT', 'null' => true],
            'content' => ['type' => 'LONGTEXT', 'null' => true],
            'status' => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'published'],
            'published_at' => ['type' => 'DATETIME', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('posts', true);

        // 5. programs
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 200],
            'slug' => ['type' => 'VARCHAR', 'constraint' => 200, 'unique' => true],
            'type' => ['type' => 'VARCHAR', 'constraint' => 50], // zakat, donasi, fidyah, dll
            'default_amount' => ['type' => 'DECIMAL', 'constraint' => '15,2', 'default' => 0],
            'description' => ['type' => 'TEXT', 'null' => true],
            'image' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'is_active' => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('programs', true);

        // 6. transactions
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'transaction_id' => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'program_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'donor_name' => ['type' => 'VARCHAR', 'constraint' => 150],
            'donor_email' => ['type' => 'VARCHAR', 'constraint' => 150],
            'donor_phone' => ['type' => 'VARCHAR', 'constraint' => 50],
            'amount' => ['type' => 'DECIMAL', 'constraint' => '15,2'],
            'payment_method' => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'midtrans'],
            'status' => ['type' => 'VARCHAR', 'constraint' => 50, 'default' => 'pending'],
            'midtrans_transaction_id' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'midtrans_response' => ['type' => 'TEXT', 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('program_id', 'programs', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transactions', true);

        // 7. settings
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'setting_key' => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'setting_value' => ['type' => 'TEXT', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('settings', true);

        // 8. api_logs
        $this->forge->addField([
            'id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'endpoint' => ['type' => 'VARCHAR', 'constraint' => 255],
            'method' => ['type' => 'VARCHAR', 'constraint' => 10],
            'payload' => ['type' => 'TEXT', 'null' => true],
            'response' => ['type' => 'TEXT', 'null' => true],
            'status_code' => ['type' => 'INT', 'constraint' => 5, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('api_logs', true);
    }

    public function down()
    {
        // disable foreign key checks
        $this->db->disableForeignKeyChecks();

        $this->forge->dropTable('api_logs', true);
        $this->forge->dropTable('settings', true);
        $this->forge->dropTable('transactions', true);
        $this->forge->dropTable('programs', true);
        $this->forge->dropTable('posts', true);
        $this->forge->dropTable('categories', true);
        $this->forge->dropTable('pages', true);
        $this->forge->dropTable('users', true);

        $this->db->enableForeignKeyChecks();
    }
}
