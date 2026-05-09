<?php

namespace App\Controllers;

use App\Models\GalleryModel;
use App\Models\HeroContentModel;
use App\Models\SiteSettingsModel;
use App\Models\MissionModel;
use App\Models\TeamModel;
use App\Models\ClientModel;
use CodeIgniter\Controller;
use Cloudinary\Cloudinary;
use Config\Cloudinary as CloudinaryConfig;

class Admin extends BaseController
{
    protected $galleryModel;
    protected $heroModel;
    protected $settingsModel;
    protected $missionModel;
    protected $teamModel;
    protected $clientModel;
    protected $cloudinary;

    public function __construct()
    {
        $this->galleryModel = new GalleryModel();
        $this->heroModel = new HeroContentModel();
        $this->settingsModel = new SiteSettingsModel();
        $this->missionModel = new MissionModel();
        $this->teamModel = new TeamModel();
        $this->clientModel = new ClientModel();
        
        // Fix for cURL SSL certificate OpenSSL verify error locally on Windows
        $cacertPath = WRITEPATH . 'cacert.pem';
        if (file_exists($cacertPath)) {
            ini_set('curl.cainfo', $cacertPath);
            ini_set('openssl.cafile', $cacertPath);
        }

        $config = new CloudinaryConfig();
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => $config->cloudName,
                'api_key'    => $config->apiKey,
                'api_secret' => $config->apiSecret,
            ],
        ]);
    }

    private function uploadToCloudinary($file, $folder = 'pkn_cms')
    {
        if ($file && $file->isValid() && !$file->hasMoved()) {
            try {
                $uploadApi = $this->cloudinary->uploadApi();
                try {
                    $ref = new \ReflectionClass($uploadApi);
                    $prop = $ref->getProperty('apiClient');
                    $prop->setAccessible(true);
                    $apiClient = $prop->getValue($uploadApi);
                    
                    $clientConfig = $apiClient->httpClient->getConfig();
                    $clientConfig['verify'] = false;
                    $apiClient->httpClient = new \GuzzleHttp\Client($clientConfig);
                } catch (\Exception $e) {}

                $result = $uploadApi->upload($file->getTempName(), [
                    'folder' => $folder
                ]);
                return $result['secure_url'];
            } catch (\Exception $e) {
                log_message('error', 'Cloudinary Upload Error: ' . $e->getMessage());
                return null;
            }
        }
        return null;
    }

    public function index()
    {
        $settingsRaw = $this->settingsModel->findAll();
        $settings = [];
        foreach ($settingsRaw as $s) {
            $settings[$s['setting_key']] = $s['setting_value'];
        }

        $data = [
            'title' => 'SPA CMS Dashboard | PT Pra Kerja Nusantara',
            'gallery' => $this->galleryModel->orderBy('display_order', 'ASC')->findAll(),
            'hero' => $this->heroModel->first() ?? [],
            'settings' => $settings,
            'missions' => $this->missionModel->orderBy('display_order', 'ASC')->findAll(),
            'team' => $this->teamModel->orderBy('display_order', 'ASC')->findAll(),
            'clients' => $this->clientModel->orderBy('display_order', 'ASC')->findAll()
        ];

        return view('admin/spa_dashboard', $data);
    }

    public function updateHero()
    {
        $hero = $this->heroModel->first();
        $data = [
            'headline' => $this->request->getPost('headline'),
            'sub_headline' => $this->request->getPost('sub_headline'),
            'primary_cta_text' => $this->request->getPost('primary_cta_text'),
            'secondary_cta_text' => $this->request->getPost('secondary_cta_text')
        ];

        $file = $this->request->getFile('photo');
        if ($file && $file->isValid()) {
            $url = $this->uploadToCloudinary($file, 'pkn_hero');
            if ($url) {
                $data['background_image'] = $url;
            }
        }

        if ($hero) {
            $this->heroModel->update($hero['id'], $data);
        } else {
            $this->heroModel->save($data);
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Hero section updated', 'hero' => $this->heroModel->first()]);
    }

    public function updateSettings()
    {
        $postData = $this->request->getPost();
        foreach ($postData as $key => $value) {
            $setting = $this->settingsModel->where('setting_key', $key)->first();
            if ($setting) {
                $this->settingsModel->update($setting['id'], ['setting_value' => $value]);
            } else {
                $this->settingsModel->save(['setting_key' => $key, 'setting_value' => $value]);
            }
        }

        $settingsRaw = $this->settingsModel->findAll();
        $settings = [];
        foreach ($settingsRaw as $s) {
            $settings[$s['setting_key']] = $s['setting_value'];
        }
        return $this->response->setJSON(['status' => 'success', 'message' => 'Settings updated', 'settings' => $settings]);
    }

    public function addMission()
    {
        $rules = [
            'title' => 'required|min_length[3]',
            'description' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak valid']);
        }

        $maxOrder = $this->missionModel->selectMax('display_order')->first();
        $newOrder = ($maxOrder['display_order'] ?? 0) + 1;

        $this->missionModel->save([
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description'),
            'display_order' => $newOrder
        ]);

        return $this->response->setJSON([
            'status' => 'success', 
            'message' => 'Misi ditambahkan', 
            'missions' => $this->missionModel->orderBy('display_order', 'ASC')->findAll()
        ]);
    }

    public function editMission($id)
    {
        $this->missionModel->update($id, [
            'title' => $this->request->getPost('title'),
            'description' => $this->request->getPost('description')
        ]);
        return $this->response->setJSON([
            'status' => 'success', 
            'message' => 'Misi diperbarui', 
            'missions' => $this->missionModel->orderBy('display_order', 'ASC')->findAll()
        ]);
    }

    public function deleteMission($id)
    {
        if ($this->missionModel->delete($id)) {
            return $this->response->setJSON([
                'status' => 'success', 
                'message' => 'Mission deleted', 
                'missions' => $this->missionModel->orderBy('display_order', 'ASC')->findAll()
            ]);
        }
        return $this->response->setJSON(['status' => 'error'], 400);
    }

    public function addTeam()
    {
        $rules = [
            'name' => 'required',
            'position' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak valid']);
        }

        $file = $this->request->getFile('photo');
        $photoUrl = null;
        if ($file && $file->isValid()) {
            $photoUrl = $this->uploadToCloudinary($file, 'pkn_team');
        }

        $maxOrder = $this->teamModel->selectMax('display_order')->first();
        $newOrder = ($maxOrder['display_order'] ?? 0) + 1;

        $this->teamModel->save([
            'name' => $this->request->getPost('name'),
            'position' => $this->request->getPost('position'),
            'photo_path' => $photoUrl,
            'display_order' => $newOrder
        ]);

        return $this->response->setJSON([
            'status' => 'success', 
            'message' => 'Anggota tim ditambahkan', 
            'team' => $this->teamModel->orderBy('display_order', 'ASC')->findAll()
        ]);
    }

    public function editTeam($id)
    {
        $data = [
            'name' => $this->request->getPost('name'),
            'position' => $this->request->getPost('position')
        ];
        
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid()) {
            $url = $this->uploadToCloudinary($file, 'pkn_team');
            if ($url) {
                $data['photo_path'] = $url;
            }
        }

        $this->teamModel->update($id, $data);
        return $this->response->setJSON([
            'status' => 'success', 
            'message' => 'Anggota tim diperbarui', 
            'team' => $this->teamModel->orderBy('display_order', 'ASC')->findAll()
        ]);
    }

    public function deleteTeam($id)
    {
        if ($this->teamModel->delete($id)) {
            return $this->response->setJSON([
                'status' => 'success', 
                'message' => 'Team member deleted', 
                'team' => $this->teamModel->orderBy('display_order', 'ASC')->findAll()
            ]);
        }
        return $this->response->setJSON(['status' => 'error'], 400);
    }

    public function addGallery()
    {
        $rules = [
            'title' => 'required|min_length[3]',
            'photo' => 'uploaded[photo]|is_image[photo]|max_size[photo,5120]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak valid atau foto terlalu besar.']);
        }

        $file = $this->request->getFile('photo');
        $url = $this->uploadToCloudinary($file, 'pkn_gallery');

        if ($url) {
            $maxOrder = $this->galleryModel->selectMax('display_order')->where('is_active', 1)->first();
            $newOrder = ($maxOrder['display_order'] ?? 0) + 1;

            $this->galleryModel->save([
                'title'       => $this->request->getPost('title'),
                'image_path'  => $url,
                'display_order' => $newOrder,
                'is_active'   => 1
            ]);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Foto berhasil diunggah'
            ]);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal mengunggah ke Cloudinary.']);
    }

    public function toggleStatus($id)
    {
        $gallery = $this->galleryModel->find($id);
        if ($gallery) {
            $newStatus = ($gallery['is_active'] == 1) ? 0 : 1;
            
            $updateData = ['is_active' => $newStatus];
            if ($newStatus == 0) {
                $oldOrder = $gallery['display_order'];
                $updateData['display_order'] = 0;
                $this->galleryModel->update($id, $updateData);
                
                if ($oldOrder > 0) {
                    $this->galleryModel->builder()
                                       ->where('is_active', 1)
                                       ->where('display_order >', $oldOrder)
                                       ->set('display_order', 'display_order - 1', false)
                                       ->update();
                }
            } else {
                $maxOrder = $this->galleryModel->selectMax('display_order')->where('is_active', 1)->first();
                $updateData['display_order'] = ($maxOrder['display_order'] ?? 0) + 1;
                $this->galleryModel->update($id, $updateData);
            }
            
            $updatedGallery = $this->galleryModel->orderBy('display_order', 'ASC')->findAll();
            return $this->response->setJSON(['status' => 'success', 'gallery' => $updatedGallery]);
        }
        return $this->response->setJSON(['status' => 'error'], 404);
    }

    public function updateOrder()
    {
        $id = $this->request->getPost('id');
        $order = $this->request->getPost('order');
        
        if ($order === '' || $order === null) $order = 0;

        if ($order > 0) {
            $existing = $this->galleryModel->where('display_order', $order)->where('id !=', $id)->first();
            if ($existing) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Urutan sudah digunakan.']);
            }
        }
        
        if ($this->galleryModel->update($id, ['display_order' => $order])) {
            $updatedGallery = $this->galleryModel->orderBy('display_order', 'ASC')->findAll();
            return $this->response->setJSON(['status' => 'success', 'gallery' => $updatedGallery]);
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal mengubah urutan.'], 400);
    }

    public function deleteGallery($id)
    {
        $gallery = $this->galleryModel->find($id);
        if ($gallery && $this->galleryModel->delete($id)) {
            if ($gallery['is_active'] == 1 && $gallery['display_order'] > 0) {
                $this->galleryModel->builder()
                                   ->where('is_active', 1)
                                   ->where('display_order >', $gallery['display_order'])
                                   ->set('display_order', 'display_order - 1', false)
                                   ->update();
            }
            $updatedGallery = $this->galleryModel->orderBy('display_order', 'ASC')->findAll();
            return $this->response->setJSON(['status' => 'success', 'message' => 'Dihapus.', 'gallery' => $updatedGallery]);
        }
        return $this->response->setJSON(['status' => 'error'], 400);
    }

    public function addClient()
    {
        $rules = [
            'name' => 'required',
            'photo' => 'uploaded[photo]|is_image[photo]|max_size[photo,5120]'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak valid atau foto terlalu besar.']);
        }

        $file = $this->request->getFile('photo');
        $url = $this->uploadToCloudinary($file, 'pkn_clients');

        if ($url) {
            $maxOrder = $this->clientModel->selectMax('display_order')->where('is_active', 1)->first();
            $newOrder = ($maxOrder['display_order'] ?? 0) + 1;

            $this->clientModel->save([
                'name'       => $this->request->getPost('name'),
                'logo_path'  => $url,
                'display_order' => $newOrder,
                'is_active'   => 1
            ]);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Klien berhasil ditambahkan',
                'clients' => $this->clientModel->orderBy('display_order', 'ASC')->findAll()
            ]);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal mengunggah logo.']);
    }

    public function editClient($id)
    {
        $data = [
            'name' => $this->request->getPost('name')
        ];
        
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid()) {
            $url = $this->uploadToCloudinary($file, 'pkn_clients');
            if ($url) {
                $data['logo_path'] = $url;
            }
        }

        $this->clientModel->update($id, $data);
        return $this->response->setJSON([
            'status' => 'success', 
            'message' => 'Klien diperbarui', 
            'clients' => $this->clientModel->orderBy('display_order', 'ASC')->findAll()
        ]);
    }

    public function toggleClientStatus($id)
    {
        $client = $this->clientModel->find($id);
        if ($client) {
            $newStatus = ($client['is_active'] == 1) ? 0 : 1;
            $updateData = ['is_active' => $newStatus];
            if ($newStatus == 0) {
                $oldOrder = $client['display_order'];
                $updateData['display_order'] = 0;
                $this->clientModel->update($id, $updateData);
                if ($oldOrder > 0) {
                    $this->clientModel->builder()->where('is_active', 1)->where('display_order >', $oldOrder)
                                      ->set('display_order', 'display_order - 1', false)->update();
                }
            } else {
                $maxOrder = $this->clientModel->selectMax('display_order')->where('is_active', 1)->first();
                $updateData['display_order'] = ($maxOrder['display_order'] ?? 0) + 1;
                $this->clientModel->update($id, $updateData);
            }
            return $this->response->setJSON(['status' => 'success', 'clients' => $this->clientModel->orderBy('display_order', 'ASC')->findAll()]);
        }
        return $this->response->setJSON(['status' => 'error'], 404);
    }

    public function deleteClient($id)
    {
        $client = $this->clientModel->find($id);
        if ($client && $this->clientModel->delete($id)) {
            if ($client['is_active'] == 1 && $client['display_order'] > 0) {
                $this->clientModel->builder()->where('is_active', 1)->where('display_order >', $client['display_order'])
                                  ->set('display_order', 'display_order - 1', false)->update();
            }
            return $this->response->setJSON(['status' => 'success', 'message' => 'Klien dihapus.', 'clients' => $this->clientModel->orderBy('display_order', 'ASC')->findAll()]);
        }
        return $this->response->setJSON(['status' => 'error'], 400);
    }
}
