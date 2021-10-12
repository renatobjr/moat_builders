<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    { 
        // Create the first instance of table users
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'auto_increment'    => true
            ],
            'fullname' => [
                'type'          => 'VARCHAR',
                'constraint'    => '120'
            ],
            'username' => [
                'type'          => 'VARCHAR',
                'constraint'    => '120'
            ],
            'password' => [
                'type'          => 'VARCHAR',
                'constraint'    => '120'
            ],
            'role' => [
                'type'          => 'INT'
            ],
        ]);
        // Set the primary key
        $this->forge->addKey('id', true);
        // Create table
        $this->forge->createTable('users');
    }

    public function down()
    {
        // Drop table
        $this->forge->dropTable('users');
    }
}
