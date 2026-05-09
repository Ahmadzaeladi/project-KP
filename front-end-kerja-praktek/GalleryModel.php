<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryModel extends Model
{
    protected $table            = 'gallery';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = ['title', 'category', 'image_path', 'display_order', 'is_active'];

    // Security: Validation Rules
    protected $validationRules = [
        'title'         => 'required|min_length[3]|max_length[255]',
        'display_order' => 'numeric',
        'is_active'     => 'in_list[0,1]',
    ];

    protected $validationMessages = [
        'title' => [
            'required' => 'Judul kegiatan wajib diisi.',
            'min_length' => 'Judul terlalu pendek.'
        ]
    ];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get active gallery items ordered by display_order
     */
    public function getActiveGallery()
    {
        return $this->where('is_active', 1)
                    ->orderBy('display_order', 'ASC')
                    ->findAll();
    }
}
