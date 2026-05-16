<?php

namespace App\Controllers;

use App\Models\ContentModel;
use App\Models\ImageModel;
use CodeIgniter\Controller;
use Cloudinary\Cloudinary;
use Config\Cloudinary as CloudinaryConfig;

class Admin extends BaseController
{
    protected $contentModel;
    protected $imageModel;
    protected $cloudinary;

    public function __construct()
    {
        $this->contentModel = new ContentModel();
        $this->imageModel = new ImageModel();
        
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

    private function uploadToCloudinary($fileOrBase64, $folder = 'pkn_cms')
    {
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

            $source = is_string($fileOrBase64) ? $fileOrBase64 : $fileOrBase64->getTempName();

            $result = $uploadApi->upload($source, [
                'folder' => $folder
            ]);
            
            return [
                'url' => $result['secure_url'],
                'public_id' => $result['public_id']
            ];
        } catch (\Exception $e) {
            log_message('error', 'Cloudinary Upload Error: ' . $e->getMessage());
            return null;
        }
    }

    private function getContentWithImages($section, $orderBy = 'order_index', $orderDir = 'ASC')
    {
        $contents = $this->contentModel->where('section', $section)
                                       ->orderBy($orderBy, $orderDir)
                                       ->findAll();
        
        $result = [];
        foreach ($contents as $item) {
            $image = $this->imageModel->where('content_id', $item['id'])->first();
            $item['image_url'] = $image ? $image['image_url'] : null;
            $item['image_public_id'] = $image ? $image['public_id'] : null;
            // Map common aliases for frontend backward compatibility
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
    }

    public function index()
    {
        // 1. Settings
        $settingsRaw = $this->contentModel->where('section', 'settings')->findAll();
        $settings = [];
        foreach ($settingsRaw as $s) {
            $settings[$s['title']] = $s['body_content'];
        }

        // 2. Hero
        $heroRaw = $this->getContentWithImages('hero');
        $hero = null;
        if (!empty($heroRaw)) {
            $h = $heroRaw[0];
            $bodyData = json_decode($h['body_content'], true);
            $hero = [
                'id' => $h['id'],
                'headline' => $h['title'],
                'sub_headline' => $h['subtitle'],
                'primary_cta_text' => $bodyData['primary_cta_text'] ?? '',
                'secondary_cta_text' => $bodyData['secondary_cta_text'] ?? '',
                'background_image' => $h['image_url']
            ];
        }

        $data = [
            'title' => 'SPA CMS Dashboard | PT Pra Kerja Nusantara',
            'gallery' => $this->getContentWithImages('gallery'),
            'hero' => $hero ?? [],
            'settings' => $settings,
            'missions' => $this->getContentWithImages('mission'),
            'team' => $this->getContentWithImages('team'),
            'clients' => $this->getContentWithImages('clients')
        ];

        return view('admin/spa_dashboard', $data);
    }

    public function updateHero()
    {
        $hero = $this->contentModel->where('section', 'hero')->first();
        
        $bodyData = [
            'primary_cta_text' => $this->request->getPost('primary_cta_text'),
            'secondary_cta_text' => $this->request->getPost('secondary_cta_text')
        ];

        $contentData = [
            'section' => 'hero',
            'title' => $this->request->getPost('headline'),
            'subtitle' => $this->request->getPost('sub_headline'),
            'body_content' => json_encode($bodyData)
        ];

        if ($hero) {
            $this->contentModel->update($hero['id'], $contentData);
            $contentId = $hero['id'];
        } else {
            $this->contentModel->insert($contentData);
            $contentId = $this->contentModel->getInsertID();
        }

        $file = $this->request->getFile('photo');
        if ($file && $file->isValid()) {
            $uploadData = $this->uploadToCloudinary($file, 'pkn_hero');
            if ($uploadData) {
                $existingImg = $this->imageModel->where('content_id', $contentId)->first();
                if ($existingImg) {
                    $this->imageModel->update($existingImg['id'], ['image_url' => $uploadData['url'], 'public_id' => $uploadData['public_id']]);
                } else {
                    $this->imageModel->insert(['content_id' => $contentId, 'image_url' => $uploadData['url'], 'public_id' => $uploadData['public_id']]);
                }
            }
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Hero section updated']);
    }

    public function updateSettings()
    {
        $postData = $this->request->getPost();
        foreach ($postData as $key => $value) {
            $setting = $this->contentModel->where('section', 'settings')->where('title', $key)->first();
            if ($setting) {
                $this->contentModel->update($setting['id'], ['body_content' => $value]);
            } else {
                $this->contentModel->insert(['section' => 'settings', 'title' => $key, 'body_content' => $value]);
            }
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Settings updated']);
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

        $maxOrder = $this->contentModel->where('section', 'mission')->selectMax('order_index')->first();
        $newOrder = ($maxOrder['order_index'] ?? 0) + 1;

        $this->contentModel->insert([
            'section' => 'mission',
            'title' => $this->request->getPost('title'),
            'body_content' => $this->request->getPost('description'),
            'order_index' => $newOrder
        ]);

        return $this->response->setJSON([
            'status' => 'success', 
            'message' => 'Misi ditambahkan', 
            'missions' => $this->getContentWithImages('mission')
        ]);
    }

    public function editMission($id)
    {
        $this->contentModel->update($id, [
            'title' => $this->request->getPost('title'),
            'body_content' => $this->request->getPost('description')
        ]);
        return $this->response->setJSON([
            'status' => 'success', 
            'message' => 'Misi diperbarui', 
            'missions' => $this->getContentWithImages('mission')
        ]);
    }

    public function deleteMission($id)
    {
        if ($this->contentModel->delete($id)) {
            return $this->response->setJSON([
                'status' => 'success', 
                'message' => 'Mission deleted', 
                'missions' => $this->getContentWithImages('mission')
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

        $maxOrder = $this->contentModel->where('section', 'team')->selectMax('order_index')->first();
        $newOrder = ($maxOrder['order_index'] ?? 0) + 1;

        $this->contentModel->insert([
            'section' => 'team',
            'title' => $this->request->getPost('name'),
            'subtitle' => $this->request->getPost('position'),
            'order_index' => $newOrder
        ]);
        $contentId = $this->contentModel->getInsertID();

        $file = $this->request->getFile('photo');
        if ($file && $file->isValid()) {
            $uploadData = $this->uploadToCloudinary($file, 'pkn_team');
            if ($uploadData) {
                $this->imageModel->insert(['content_id' => $contentId, 'image_url' => $uploadData['url'], 'public_id' => $uploadData['public_id']]);
            }
        }

        return $this->response->setJSON([
            'status' => 'success', 
            'message' => 'Anggota tim ditambahkan', 
            'team' => $this->getContentWithImages('team')
        ]);
    }

    public function editTeam($id)
    {
        $this->contentModel->update($id, [
            'title' => $this->request->getPost('name'),
            'subtitle' => $this->request->getPost('position')
        ]);
        
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid()) {
            $uploadData = $this->uploadToCloudinary($file, 'pkn_team');
            if ($uploadData) {
                $existingImg = $this->imageModel->where('content_id', $id)->first();
                if ($existingImg) {
                    $this->imageModel->update($existingImg['id'], ['image_url' => $uploadData['url'], 'public_id' => $uploadData['public_id']]);
                } else {
                    $this->imageModel->insert(['content_id' => $id, 'image_url' => $uploadData['url'], 'public_id' => $uploadData['public_id']]);
                }
            }
        }

        return $this->response->setJSON([
            'status' => 'success', 
            'message' => 'Anggota tim diperbarui', 
            'team' => $this->getContentWithImages('team')
        ]);
    }

    public function deleteTeam($id)
    {
        if ($this->contentModel->delete($id)) {
            return $this->response->setJSON([
                'status' => 'success', 
                'message' => 'Team member deleted', 
                'team' => $this->getContentWithImages('team')
            ]);
        }
        return $this->response->setJSON(['status' => 'error'], 400);
    }

    public function addGallery()
    {
        $title = $this->request->getPost('title');
        if (empty($title)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Judul foto wajib diisi.']);
        }

        // Cek file atau base64 (Kamera)
        $file = $this->request->getFile('photo');
        $base64 = $this->request->getPost('photo_base64');
        
        $uploadSource = null;
        if ($file && $file->isValid()) {
            $uploadSource = $file;
        } elseif (!empty($base64)) {
            $uploadSource = $base64;
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Pilih file foto atau gunakan kamera.']);
        }

        $uploadData = $this->uploadToCloudinary($uploadSource, 'pkn_gallery');

        if ($uploadData) {
            $maxOrder = $this->contentModel->where('section', 'gallery')->where('is_active', 1)->selectMax('order_index')->first();
            $newOrder = ($maxOrder['order_index'] ?? 0) + 1;

            $this->contentModel->insert([
                'section' => 'gallery',
                'title' => $title,
                'order_index' => $newOrder,
                'is_active' => 1
            ]);
            $contentId = $this->contentModel->getInsertID();

            $this->imageModel->insert([
                'content_id' => $contentId,
                'image_url' => $uploadData['url'],
                'public_id' => $uploadData['public_id']
            ]);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Foto berhasil diunggah',
                'gallery' => $this->getContentWithImages('gallery')
            ]);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal mengunggah ke Cloudinary.']);
    }

    public function toggleStatus($id)
    {
        $gallery = $this->contentModel->where('section', 'gallery')->where('id', $id)->first();
        if ($gallery) {
            $newStatus = ($gallery['is_active'] == 1) ? 0 : 1;
            $updateData = ['is_active' => $newStatus];
            
            if ($newStatus == 0) {
                $oldOrder = $gallery['order_index'];
                $updateData['order_index'] = 0;
                $this->contentModel->update($id, $updateData);
                
                if ($oldOrder > 0) {
                    $this->contentModel->builder()
                                       ->where('section', 'gallery')
                                       ->where('is_active', 1)
                                       ->where('order_index >', $oldOrder)
                                       ->set('order_index', 'order_index - 1', false)
                                       ->update();
                }
            } else {
                $maxOrder = $this->contentModel->where('section', 'gallery')->where('is_active', 1)->selectMax('order_index')->first();
                $updateData['order_index'] = ($maxOrder['order_index'] ?? 0) + 1;
                $this->contentModel->update($id, $updateData);
            }
            
            return $this->response->setJSON(['status' => 'success', 'gallery' => $this->getContentWithImages('gallery')]);
        }
        return $this->response->setJSON(['status' => 'error'], 404);
    }

    public function updateOrder()
    {
        $id = $this->request->getPost('id');
        $order = $this->request->getPost('order');
        
        if ($order === '' || $order === null) $order = 0;

        if ($order > 0) {
            $existing = $this->contentModel->where('section', 'gallery')->where('order_index', $order)->where('id !=', $id)->first();
            if ($existing) {
                return $this->response->setJSON(['status' => 'error', 'message' => 'Urutan sudah digunakan.']);
            }
        }
        
        if ($this->contentModel->update($id, ['order_index' => $order])) {
            return $this->response->setJSON(['status' => 'success', 'gallery' => $this->getContentWithImages('gallery')]);
        }
        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal mengubah urutan.'], 400);
    }

    public function deleteGallery($id)
    {
        $gallery = $this->contentModel->where('section', 'gallery')->where('id', $id)->first();
        if ($gallery && $this->contentModel->delete($id)) {
            if ($gallery['is_active'] == 1 && $gallery['order_index'] > 0) {
                $this->contentModel->builder()
                                   ->where('section', 'gallery')
                                   ->where('is_active', 1)
                                   ->where('order_index >', $gallery['order_index'])
                                   ->set('order_index', 'order_index - 1', false)
                                   ->update();
            }
            return $this->response->setJSON(['status' => 'success', 'message' => 'Dihapus.', 'gallery' => $this->getContentWithImages('gallery')]);
        }
        return $this->response->setJSON(['status' => 'error'], 400);
    }

    public function addClient()
    {
        $rules = [
            'name' => 'required'
        ];

        if (!$this->validate($rules)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Data tidak valid.']);
        }

        $file = $this->request->getFile('photo');
        $uploadData = null;
        if ($file && $file->isValid()) {
            $uploadData = $this->uploadToCloudinary($file, 'pkn_clients');
        }

        if ($uploadData) {
            $maxOrder = $this->contentModel->where('section', 'clients')->where('is_active', 1)->selectMax('order_index')->first();
            $newOrder = ($maxOrder['order_index'] ?? 0) + 1;

            $this->contentModel->insert([
                'section' => 'clients',
                'title' => $this->request->getPost('name'),
                'order_index' => $newOrder,
                'is_active' => 1
            ]);
            $contentId = $this->contentModel->getInsertID();

            $this->imageModel->insert([
                'content_id' => $contentId,
                'image_url' => $uploadData['url'],
                'public_id' => $uploadData['public_id']
            ]);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Klien berhasil ditambahkan',
                'clients' => $this->getContentWithImages('clients')
            ]);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal mengunggah logo.']);
    }

    public function editClient($id)
    {
        $this->contentModel->update($id, ['title' => $this->request->getPost('name')]);
        
        $file = $this->request->getFile('photo');
        if ($file && $file->isValid()) {
            $uploadData = $this->uploadToCloudinary($file, 'pkn_clients');
            if ($uploadData) {
                $existingImg = $this->imageModel->where('content_id', $id)->first();
                if ($existingImg) {
                    $this->imageModel->update($existingImg['id'], ['image_url' => $uploadData['url'], 'public_id' => $uploadData['public_id']]);
                } else {
                    $this->imageModel->insert(['content_id' => $id, 'image_url' => $uploadData['url'], 'public_id' => $uploadData['public_id']]);
                }
            }
        }

        return $this->response->setJSON([
            'status' => 'success', 
            'message' => 'Klien diperbarui', 
            'clients' => $this->getContentWithImages('clients')
        ]);
    }

    public function toggleClientStatus($id)
    {
        $client = $this->contentModel->where('section', 'clients')->where('id', $id)->first();
        if ($client) {
            $newStatus = ($client['is_active'] == 1) ? 0 : 1;
            $updateData = ['is_active' => $newStatus];
            if ($newStatus == 0) {
                $oldOrder = $client['order_index'];
                $updateData['order_index'] = 0;
                $this->contentModel->update($id, $updateData);
                if ($oldOrder > 0) {
                    $this->contentModel->builder()->where('section', 'clients')->where('is_active', 1)->where('order_index >', $oldOrder)
                                      ->set('order_index', 'order_index - 1', false)->update();
                }
            } else {
                $maxOrder = $this->contentModel->where('section', 'clients')->where('is_active', 1)->selectMax('order_index')->first();
                $updateData['order_index'] = ($maxOrder['order_index'] ?? 0) + 1;
                $this->contentModel->update($id, $updateData);
            }
            return $this->response->setJSON(['status' => 'success', 'clients' => $this->getContentWithImages('clients')]);
        }
        return $this->response->setJSON(['status' => 'error'], 404);
    }

    public function deleteClient($id)
    {
        $client = $this->contentModel->where('section', 'clients')->where('id', $id)->first();
        if ($client && $this->contentModel->delete($id)) {
            if ($client['is_active'] == 1 && $client['order_index'] > 0) {
                $this->contentModel->builder()->where('section', 'clients')->where('is_active', 1)->where('order_index >', $client['order_index'])
                                  ->set('order_index', 'order_index - 1', false)->update();
            }
            return $this->response->setJSON(['status' => 'success', 'message' => 'Klien dihapus.', 'clients' => $this->getContentWithImages('clients')]);
        }
        return $this->response->setJSON(['status' => 'error'], 400);
    }
}
