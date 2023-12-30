<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePostingan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_post' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => TRUE
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'caption' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'pict_post' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        $this->forge->addKey('id_post', true);
        $this->forge->addForeignKey('id_user', 'users', 'id');
        $this->forge->createTable('postingan');
    }

    public function down()
    {
        $this->forge->dropTable('postingan');
    }
}
