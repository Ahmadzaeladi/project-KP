<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TblImages extends Migration
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
            'content_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'image_url' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'public_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'image_category' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'alt_text' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'create_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        
        // Menambahkan Foreign Key: content_id relasi ke id di tbl_content
        $this->forge->addForeignKey('content_id', 'tbl_content', 'id', 'CASCADE', 'CASCADE');
        
        $this->forge->createTable('tbl_images');
    }

    public function down()
    {
        $this->forge->dropTable('tbl_images', true);
    }
}
