<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Cloudinary extends BaseConfig
{
    public string $cloudName;
    public string $apiKey;
    public string $apiSecret;

    public function __construct()
    {
        parent::__construct();

        $this->cloudName = env('cloudinary.cloudName', '');
        $this->apiKey    = env('cloudinary.apiKey', '');
        $this->apiSecret = env('cloudinary.apiSecret', '');
    }
}
