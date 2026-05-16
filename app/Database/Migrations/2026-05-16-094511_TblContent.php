<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblContent extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'section' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'subtitle' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'body_content' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'order_index' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
            'published_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'is_active' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'create_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'update_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('tbl_content');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_content', true);
    }
}
