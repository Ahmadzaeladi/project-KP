<?php

namespace App\Controllers;

use App\Models\GalleryModel;
use App\Models\HeroContentModel;
use App\Models\SiteSettingsModel;
use App\Models\MissionModel;
use App\Models\TeamModel;

class Home extends BaseController
{
    public function index(): string
    {
        $galleryModel = new GalleryModel();
        $heroModel = new HeroContentModel();
        $settingsModel = new SiteSettingsModel();
        $missionModel = new MissionModel();
        $teamModel = new TeamModel();
        $clientModel = new \App\Models\ClientModel();

        $settingsRaw = $settingsModel->findAll();
        $settings = [];
        foreach ($settingsRaw as $s) {
            $settings[$s['setting_key']] = $s['setting_value'];
        }

        $data = [
            'gallery' => $galleryModel->getActiveGallery(),
            'hero' => $heroModel->first() ?? [],
            'settings' => $settings,
            'missions' => $missionModel->orderBy('display_order', 'ASC')->findAll(),
            'team' => $teamModel->orderBy('display_order', 'ASC')->findAll(),
            'clients' => $clientModel->where('is_active', 1)->orderBy('display_order', 'ASC')->findAll()
        ];
        
        return view('home', $data);
    }
}
