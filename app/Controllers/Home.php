<?php

namespace App\Controllers;

use App\Models\ContentModel;
use App\Models\ImageModel;

class Home extends BaseController
{
    public function index(): string
    {
        $contentModel = new ContentModel();
        $imageModel = new ImageModel();

        // Helper to format data
        $getContentWithImages = function($section, $onlyActive = false) use ($contentModel, $imageModel) {
            $builder = $contentModel->where('section', $section);
            if ($onlyActive) {
                $builder->where('is_active', 1);
            }
            $contents = $builder->orderBy('order_index', 'ASC')->findAll();
            
            $result = [];
            foreach ($contents as $item) {
                $image = $imageModel->where('content_id', $item['id'])->first();
                $item['image_url'] = $image ? $image['image_url'] : null;
                $item['image_path'] = $item['image_url']; 
                $item['photo_path'] = $item['image_url'];
                $item['logo_path'] = $item['image_url'];
                $item['display_order'] = $item['order_index'];
                $item['description'] = $item['body_content'];
                $item['position'] = $item['subtitle'];
                $item['name'] = $item['title'];
                $result[] = $item;
            }
            return $result;
        };

        // Settings
        $settingsRaw = $contentModel->where('section', 'settings')->findAll();
        $settings = [];
        foreach ($settingsRaw as $s) {
            $settings[$s['title']] = $s['body_content'];
        }

        // Hero
        $heroRaw = $getContentWithImages('hero');
        $hero = null;
        if (!empty($heroRaw)) {
            $h = $heroRaw[0];
            $bodyData = json_decode($h['body_content'], true);
            $hero = [
                'headline' => $h['title'],
                'sub_headline' => $h['subtitle'],
                'primary_cta_text' => $bodyData['primary_cta_text'] ?? '',
                'secondary_cta_text' => $bodyData['secondary_cta_text'] ?? '',
                'background_image' => $h['image_url']
            ];
        }

        $data = [
            'gallery' => $getContentWithImages('gallery', true),
            'hero' => $hero ?? [],
            'settings' => $settings,
            'missions' => $getContentWithImages('mission'),
            'team' => $getContentWithImages('team'),
            'clients' => $getContentWithImages('clients', true)
        ];
        
        return view('home', $data);
    }
}
