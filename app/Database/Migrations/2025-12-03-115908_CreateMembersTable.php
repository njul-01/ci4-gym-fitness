<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMembersTable extends Migration
{
    public function up()
    {
          $this->forge->addField([
            'member_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'member_code' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true
            ],
             'name' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
             'phone' => [
                'type' => 'VARCHAR',
                'constraint' => 13
            ],
             'email' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'unique' => true
            ],
             'join_date' => [
                'type' => 'DATE',
                'null' => true
                
            ],
             'status' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'default' => 'Active'
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

            $this->forge->addKey('member_id', true);
            $this->forge->createTable('members');
    }

    public function down()
    {
         $this->forge->dropTable('members');
    }
}
