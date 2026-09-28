<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClassesTable extends Migration
{
    public function up()
    {
       $this->forge->addField([
            'class_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
             'class_name' => [
                'type' => 'VARCHAR',
                'constraint' => 100
            ],
             'description' => [
                'type' => 'TEXT',
                'null' => true
            ],
             'capacity' => [
                'type' => 'INT'
            ],
             'is_active' => [
                'type' => 'boolean',
                'default' => true 
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

            $this->forge->addKey('class_id', true);
            $this->forge->createTable('classes');
    }

    public function down()
    {
          $this->forge->dropTable('classes');
    }
}
