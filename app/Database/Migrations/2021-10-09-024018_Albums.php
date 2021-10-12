<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Albums extends Migration
{
    public function up()
    {
        // Create the first instance of table albums
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'auto_increment'    => true
            ],
            'artist_id' => [
                'type'              => 'INT'
            ],
            'album_title' => [
                'type'          => 'VARCHAR',
                'constraint'    => '120'
            ],
            'album_year' => [
                'type'          => 'INT',
                'constraint'    => '4'
            ]
        ]);
        // Set the primary key
        $this->forge->addKey('id', true);
        // Create table
        $this->forge->createTable('albums');
    }

    public function down()
    {
        // Drop table
        $this->forge->dropTable('albums');
    }
}
