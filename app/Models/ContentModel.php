<?php

namespace App\Models;

use CodeIgniter\Model;

class ContentModel extends Model
{
    protected $table            = 'tbl_content';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'section', 'title', 'subtitle', 'body_content', 
        'order_index', 'published_at', 'is_active', 
        'create_at', 'update_at'
    ];

    // Menggunakan custom field untuk created/updated jika diperlukan
    protected $useTimestamps = true;
    protected $createdField  = 'create_at';
    protected $updatedField  = 'update_at';
}
