<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateHeroContentTable extends Migration
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
            'headline' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'sub_headline' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'primary_cta_text' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'secondary_cta_text' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'background_image' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('hero_content');
    }

    public function down()
    {
        $this->forge->dropTable('hero_content');
    }
}
