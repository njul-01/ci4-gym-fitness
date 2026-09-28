<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClassBookingsTable extends Migration
{
    public function up()
    {
         $this->forge->addField([
            'booking_id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true
            ],
             'schedule_id' => [
                'type' => 'INT',
               'unsigned' => true
            ],
             'member_id' => [
                'type' => 'INT',
               'unsigned' => true
            ],
             'booking_time' => [
                'type' => 'TIME',
                'null' => true
            ],
             'status' => [
                'type' => 'varchar',
                'constraint' => 100,
                'default' => 'Booked'
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

            $this->forge->addKey('booking_id', true);
            $this->forge->createTable('classBooking');
             $this->forge->AddForeignKey('schedule_id', 'schedule','schedule_id', 'CASCADE', 'CASCADE' );
             $this->forge->AddForeignKey('member_id', 'members','member_id', 'CASCADE', 'CASCADE' );
    }

    public function down()
    {
         $this->forge->dropTable('classBooking');
    }
}
