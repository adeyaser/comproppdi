<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FixFeaturesAmountConfirm extends Migration
{
    public function up()
    {
        $this->forge->addColumn('programs', [
            'collected_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0.00,
                'after' => 'target_amount'
            ]
        ]);
        
        $this->forge->addColumn('transactions', [
            'proof_image' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
                'after' => 'payment_url'
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('programs', 'collected_amount');
        $this->forge->dropColumn('transactions', 'proof_image');
    }
}
