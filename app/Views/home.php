<?php
/**
 * @var array $hero
 * @var array $settings
 * @var array $missions
 * @var array $services
 * @var array $clients
 * @var array $certifications
 * @var array $team
 * @var string $seoUrl
 */
?>
<?= $this->extend('layouts/compro_layout') ?>

<?= $this->section('extra_head') ?>
    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "PT Pra Kerja Nusantara",
      "url": "<?= esc($seoUrl ?? base_url()) ?>",
      "logo": "<?= base_url('Assets/logo.webp') ?>",
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "<?= esc($settings['contact_phone'] ?? '+62000000') ?>",
        "email": "<?= esc($settings['contact_email'] ?? 'email@example.com') ?>",
        "contactType": "customer service"
      },
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "<?= esc($settings['contact_address'] ?? 'Alamat Perusahaan') ?>",
        "addressCountry": "ID"
      }
    }
    </script>
    
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <?= $this->include('components/home/hero') ?>
    <?= $this->include('components/home/about') ?>
    <?= $this->include('components/home/vision_mission') ?>
    <?= $this->include('components/home/services') ?>
    <?= $this->include('components/home/clients') ?>
    <?= $this->include('components/home/team') ?>
    <?= $this->include('components/home/certifications') ?>
    <?= $this->include('components/home/locations') ?>
<?= $this->endSection() ?>
