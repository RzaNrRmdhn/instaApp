<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTableKomentar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_komentar' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => TRUE
            ],
            'id_post' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'id_user' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'komentar' => [
                'type' => 'TEXT',
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

        $this->forge->addKey('id_komentar', true);
        $this->forge->addForeignKey('id_post', 'postingan', 'id_post');
        $this->forge->addForeignKey('id_user', 'users', 'id');
        $this->forge->createTable('komentar');
    }

    public function down()
    {
        $this->forge->dropTable('komentar');
    }
}
