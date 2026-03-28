<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTargetAmountToPrograms extends Migration
{
    public function up()
    {
        $fields = [
            'target_amount' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
                'default' => 0.00,
                'after' => 'default_amount'
            ]
        ];
        $this->forge->addColumn('programs', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('programs', 'target_amount');
    }
}
