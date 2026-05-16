<?php

namespace App\Models;

use CodeIgniter\Model;

class ImageModel extends Model
{
    protected $table            = 'tbl_images';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'content_id', 'image_url', 'public_id', 
        'image_category', 'alt_text', 'create_at'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'create_at';
    protected $updatedField  = ''; // No update_at in this table based on schema
}
