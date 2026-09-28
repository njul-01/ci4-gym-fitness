<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMembershipsTable extends Migration
{
    public function up()
    {
          $this->forge->addField([
            'membership_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
             'member_id' => [
                'type' => 'INT',
               'unsigned' => true
            ],
             'type' => [
                'type' => 'VARCHAR',
               'constraint' => 100
            ],
             'start_date' => [
                'type' => 'date' 
            ],
             'end_date' => [
                'type' => 'date',
                'null' => true
            ],
             'price' => [
                'type' => 'INT',
                'unsigned' => true
            ],
           
             'status' => [
                'type' => 'varchar',
                'constraint' => 100
            ], 
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
            ]);

            $this->forge->addKey('membership_id', true);
            $this->forge->createTable('membership');
             $this->forge->AddForeignKey('member_id', 'members','member_id', 'CASCADE', 'CASCADE' );
    }

    public function down()
    {
         $this->forge->dropTable('membership');
    
    }
}
