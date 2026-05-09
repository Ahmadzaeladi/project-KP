<?php

namespace App\Models;

use CodeIgniter\Model;

class HeroContentModel extends Model
{
    protected $table            = 'hero_content';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['headline', 'sub_headline', 'primary_cta_text', 'secondary_cta_text', 'background_image'];

    // Dates
    protected $useTimestamps = true;
    protected $createdField  = '';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = '';
}
