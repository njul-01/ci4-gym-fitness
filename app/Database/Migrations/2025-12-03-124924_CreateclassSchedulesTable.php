<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateclassSchedulesTable extends Migration
{
    public function up()
    {
         $this->forge->addField([
            'schedule_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
             'class_id' => [
                'type' => 'INT',
               'unsigned' => true
            ],
             'trainer_id' => [
                'type' => 'INT',
               'unsigned' => true
            ],
             'schedule_date' => [
                'type' => 'date' 
            ],
             'start_time' => [
                'type' => 'time'
            ],
             'end_time' => [
                'type' => 'time'
            ],
             'status' => [
                'type' => 'varchar',
                'constraint' => 100,
                'default' => 'Upcoming'
                
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

            $this->forge->addKey('schedule_id', true);
            $this->forge->createTable('schedule');
            $this->forge->AddForeignKey('class_id', 'classes','class_id', 'CASCADE', 'CASCADE' );
            $this->forge->AddForeignKey('trainer_id', 'trainers','trainer_id', 'CASCADE', 'CASCADE' );
    
    }

    public function down()
    {
         $this->forge->dropTable('schedule');
    }
}
