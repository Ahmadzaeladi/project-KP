<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?= esc($seoTitle ?? 'PT Pra Kerja Nusantara') ?></title>
    <meta name="description" content="<?= esc($seoDesc ?? '') ?>">
    <meta name="keywords" content="<?= esc($seoKeywords ?? '') ?>">
    <meta name="author" content="<?= esc($seoAuthor ?? 'PT Pra Kerja Nusantara') ?>">
    
    <!-- SEO Best Practices -->
    <link rel="canonical" href="<?= esc($seoUrl ?? base_url()) ?>">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= esc($seoUrl ?? base_url()) ?>">
    <meta property="og:title" content="<?= esc($seoTitle ?? '') ?>">
    <meta property="og:description" content="<?= esc($seoDesc ?? '') ?>">
    <meta property="og:image" content="<?= esc($seoImage ?? base_url('Assets/Hero.webp')) ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= esc($seoUrl ?? base_url()) ?>">
    <meta property="twitter:title" content="<?= esc($seoTitle ?? '') ?>">
    <meta property="twitter:description" content="<?= esc($seoDesc ?? '') ?>">
    <meta property="twitter:image" content="<?= esc($seoImage ?? base_url('Assets/Hero.webp')) ?>">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Inter:wght@300;400;500;600&family=Space+Mono&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

    <link rel="icon" type="image/png" href="<?=  base_url('Assets/logo.webp') ?>">

    <?= $this->renderSection('extra_head') ?>
</head>
<body>

    <?= $this->include('components/navbar') ?>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <?= $this->include('components/footer') ?>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Custom JS -->
    <script src="<?= base_url('js/script.js') ?>"></script>
</body>
</html>
