<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'SPA CMS Dashboard | PT Pra Kerja Nusantara' ?></title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800&family=Space+Mono&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom SPA CSS -->
    <link rel="stylesheet" href="<?= base_url('css/spa-admin.css') ?>">
</head>
<body>

    <?= $this->renderSection('content') ?>

    <!-- SPA Logic is inside the views -->
</body>
</html>
