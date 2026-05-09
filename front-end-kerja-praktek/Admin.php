<?php

namespace App\Controllers;

use App\Models\GalleryModel;
use CodeIgniter\Controller;

class Admin extends BaseController
{
    protected $galleryModel;

    public function __construct()
    {
        $this->galleryModel = new GalleryModel();
    }

    /**
     * Display the SPA Dashboard
     */
    public function index()
    {
        // Security check: Ensure user is logged in via Session or Filter
        // If not, redirect to login page.
        
        $data = [
            'title' => 'SPA CMS Dashboard | PT Pra Kerja Nusantara',
            'gallery' => $this->galleryModel->orderBy('display_order', 'ASC')->findAll()
        ];

        return view('admin/spa_dashboard', $data);
    }

    /**
     * AJAX/API endpoint for saving new gallery item
     * Includes CSRF Protection and XSS Prevention via CI4 default
     */
    public function addGallery()
    {
        // CSRF check is automatic if enabled in Config/Filters.php
        
        if (!$this->validate($this->galleryModel->getValidationRules())) {
            return $this->response->setJSON([
                'status' => 'error',
                'errors' => $this->validator->getErrors()
            ]);
        }

        $file = $this->request->getFile('photo');
        
        // Secure File Uploading
        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/gallery', $newName);

            $this->galleryModel->save([
                'title'       => $this->request->getPost('title', FILTER_SANITIZE_STRING),
                'category'    => $this->request->getPost('category', FILTER_SANITIZE_STRING),
                'image_path'  => 'uploads/gallery/' . $newName,
                'display_order' => $this->request->getPost('order', FILTER_SANITIZE_NUMBER_INT),
                'is_active'   => 1
            ]);

            return $this->response->setJSON([
                'status'  => 'success',
                'message' => 'Foto berhasil diunggah dan disimpan ke database.'
            ]);
        }

        return $this->response->setJSON([
            'status' => 'error',
            'message' => 'Terjadi kesalahan saat mengunggah file.'
        ]);
    }

    /**
     * AJAX endpoint to toggle status
     */
    public function toggleStatus($id)
    {
        $gallery = $this->galleryModel->find($id);
        if ($gallery) {
            $newStatus = ($gallery['is_active'] == 1) ? 0 : 1;
            $this->galleryModel->update($id, ['is_active' => $newStatus]);
            
            return $this->response->setJSON([
                'status' => 'success',
                'new_status' => $newStatus
            ]);
        }

        return $this->response->setJSON(['status' => 'error'], 404);
    }
}
