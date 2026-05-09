<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\SiteSettingsModel;
use App\Models\HeroContentModel;
use App\Models\MissionModel;
use App\Models\TeamModel;

class InitSeeder extends Seeder
{
    public function run()
    {
        $settingsModel = new SiteSettingsModel();
        $heroModel = new HeroContentModel();
        $missionModel = new MissionModel();
        $teamModel = new TeamModel();

        // Site Settings
        $settings = [
            ['setting_key' => 'about_text', 'setting_value' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'],
            ['setting_key' => 'stat_experience', 'setting_value' => '10+ Tahun Pengalaman'],
            ['setting_key' => 'stat_partners', 'setting_value' => '500+ Mitra Korporasi'],
            ['setting_key' => 'vision_text', 'setting_value' => '"Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo dolore suscipit dolores eveniet sapiente quia alias, aperiam modi minus atque tempora numquam saepe deserunt ex amet fugiat delectus, hic voluptas."'],
            ['setting_key' => 'contact_address', 'setting_value' => 'Jl. Batu Ceper No.33, dan No.33A 15, RT.15/RW.1, Kb. Klp., Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10120'],
            ['setting_key' => 'contact_phone', 'setting_value' => '+62 123 4567 8900'],
            ['setting_key' => 'contact_email', 'setting_value' => 'info@prakerjanusantara.co.id'],
            ['setting_key' => 'copyright_text', 'setting_value' => '© 2026 PT Pra Kerja Nusantara.'],
        ];

        foreach ($settings as $s) {
            if (!$settingsModel->where('setting_key', $s['setting_key'])->first()) {
                $settingsModel->save($s);
            }
        }

        // Hero Content
        if (!$heroModel->first()) {
            $heroModel->save([
                'headline' => 'Lorem Ipsum Dolor Sit Amet.',
                'sub_headline' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime dicta perferendis consequuntur at possimus architecto aliquid unde.',
                'primary_cta_text' => 'Eksplorasi',
                'secondary_cta_text' => 'Kolaborasi'
            ]);
        }

        // Missions
        if (count($missionModel->findAll()) == 0) {
            $missionModel->insertBatch([
                [
                    'title' => 'Inovasi Berkelanjutan',
                    'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit voluptatum temporibus quibusdam.',
                    'display_order' => 1
                ],
                [
                    'title' => 'Pelayanan Prima',
                    'description' => 'Dicta nulla at sint ullam cum voluptatibus, autem, cumque tempore ipsa facilis amet numquam.',
                    'display_order' => 2
                ],
                [
                    'title' => 'Integritas Tinggi',
                    'description' => 'Voluptates iste accusantium quam corporis saepe deserunt ex amet fugiat delectus, hic voluptas.',
                    'display_order' => 3
                ]
            ]);
        }

        // Team
        if (count($teamModel->findAll()) == 0) {
            $teamModel->insertBatch([
                ['name' => 'Eka Tamuwidjaja', 'position' => 'Direktur Utama', 'display_order' => 1],
                ['name' => 'Carissa Putri Tatan', 'position' => 'Direktur', 'display_order' => 2],
                ['name' => 'Tri Anggoro', 'position' => 'HRBP', 'display_order' => 3],
                ['name' => 'Ahmad Faisal Rizky', 'position' => 'Area Operasional', 'display_order' => 4],
            ]);
        }
    }
}
