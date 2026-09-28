<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTrainersTable extends Migration
{
    public function up()
    {
     $this->forge->addField([
            'trainer_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
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
             'speciality' => [
                'type' => 'VARCHAR',
                 'constraint' => 100
               
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

            $this->forge->addKey('trainer_id', true);
            $this->forge->createTable('trainers');
    }

    public function down()
    {
          $this->forge->dropTable('trainers');
    }
}
