<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username'  => 'admin',
            'password'  => password_hash('admin123', PASSWORD_DEFAULT),
            'full_name' => 'Super Admin',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        // Using Query Builder
        $this->db->table('users')->insert($data);
    }
}
