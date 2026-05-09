<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    $seoTitle = "PT Pra Kerja Nusantara | Solusi Outsourcing Masa Depan";
    $seoDesc = "PT Pra Kerja Nusantara - Solusi Outsourcing Premium & Modern. Kami menghubungkan talenta terbaik dengan perusahaan visioner.";
    $seoKeywords = "outsourcing, staffing, ptn, pra kerja nusantara, tenaga kerja, manajemen SDM";
    $seoAuthor = "PT Pra Kerja Nusantara";
    $seoUrl = base_url();
    $seoImage = base_url('Assets/Hero.webp');
    ?>

    <title><?= $seoTitle ?></title>
    <meta name="description" content="<?= $seoDesc ?>">
    <meta name="keywords" content="<?= $seoKeywords ?>">
    <meta name="author" content="<?= $seoAuthor ?>">
    
    <!-- SEO Best Practices -->
    <link rel="canonical" href="<?= $seoUrl ?>">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $seoUrl ?>">
    <meta property="og:title" content="<?= $seoTitle ?>">
    <meta property="og:description" content="<?= $seoDesc ?>">
    <meta property="og:image" content="<?= $seoImage ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= $seoUrl ?>">
    <meta property="twitter:title" content="<?= $seoTitle ?>">
    <meta property="twitter:description" content="<?= $seoDesc ?>">
    <meta property="twitter:image" content="<?= $seoImage ?>">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&family=Inter:wght@300;400;500;600&family=Space+Mono&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS (Animate On Scroll) CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "PT Pra Kerja Nusantara",
      "url": "<?= $seoUrl ?>",
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
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">
                <img src="<?= base_url('Assets/logo.webp') ?>" alt="" width="auto" height="50px">
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars" style="color: var(--primary-color);"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#hero">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="#vision-mission">Visi Misi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#team">Manajemen</a></li>
                    <li class="nav-item"><a class="nav-link" href="#activities">Galeri</a></li>
                    <li class="nav-item ms-lg-4 mt-2 mt-lg-0"><a class="btn-modern btn-filled" href="#contact">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section id="hero">
            <div class="container">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6 hero-content" data-aos="fade-right">
                        <span class="accent-text mb-3">PT Pra Kerja Nusantara</span>
                        <h1 class="display-4 fw-bold"><?= esc($hero['headline'] ?? 'Solusi Masa Depan') ?></h1>
                        <p class="lead mb-5" style="color: var(--text-muted); max-width: 500px;">
                            <?= esc($hero['sub_headline'] ?? 'Bukan sekadar penyedia tenaga kerja. Kami adalah partner strategis.') ?>
                        </p>
                        <div class="d-flex flex-wrap gap-3">
                            <a href="#about" class="btn-modern btn-filled"><?= esc($hero['primary_cta_text'] ?? 'Eksplorasi') ?></a>
                            <a href="#contact" class="btn-modern"><?= esc($hero['secondary_cta_text'] ?? 'Kolaborasi') ?></a>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                        <div class="hero-image-wrapper">
                            <div class="hero-shape shape-1"></div>
                            <div class="hero-shape shape-2"></div>
                            <img src="<?= !empty($hero['background_image']) ? esc($hero['background_image']) : base_url('Assets/Hero.webp') ?>" alt="Hero Image" class="img-fluid hero-main-img">
                            <div class="hero-badge">
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary rounded-circle p-2 me-3">
                                        <i class="fas fa-check text-white"></i>
                                    </div>
                                    <div>
                                        <h6 class="mb-0 fw-bold">Profesional</h6>
                                        <small class="text-muted">Terpercaya</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Us Section -->
        <section id="about">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6" data-aos="fade-right">
                        <div class="section-title text-start mb-4">
                            <h2>Tentang Kami</h2>
                            <div class="title-line ms-0"></div>
                        </div>
                        <p class="mb-4" style="white-space: pre-line;">
                            <?= esc($settings['about_text'] ?? 'Lorem ipsum dolor sit amet...') ?>
                        </p>
                        <div class="row mt-5">
                            <div class="col-6">
                                <h3 style="color: var(--primary-color);" class="mb-1 fw-bold"><?= esc($settings['stat_experience'] ?? '10+') ?></h3>
                                <p class="small text-muted fw-semibold">Pengalaman</p>
                            </div>
                            <div class="col-6">
                                <h3 style="color: var(--primary-color);" class="mb-1 fw-bold"><?= esc($settings['stat_partners'] ?? '500+') ?></h3>
                                <p class="small text-muted fw-semibold">Mitra Korporasi</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left">
                        <div class="bento-item h-100"
                            style="background-image: url('https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80&w=800'); background-size: cover; background-position: center; min-height: 450px; border-radius: 40px;">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vision Mission Section -->
        <section id="vision-mission" class="bg-light">
            <div class="container">
                <div class="section-title text-center mb-5" data-aos="fade-up">
                    <h2>Visi Misi Kami</h2>
                    <div class="title-line"></div>
                </div>
                <div class="row g-5 align-items-center mt-3">
                    <div class="col-lg-5" data-aos="fade-right">
                        <div class="vision-box">
                            <h3 class="display-6 fw-bold mb-4">Visi Utama Kami</h3>
                            <p>"<?= esc($settings['vision_text'] ?? 'Menjadi solusi outsourcing terdepan...') ?>"</p>
                        </div>
                    </div>
                    <div class="col-lg-6 offset-lg-1" data-aos="fade-left" data-aos-delay="100">
                        <div class="mission-box">
                            <h3 class="h3 fw-bold mb-4">Misi Strategis</h3>
                            <ul class="mission-list">
                                <?php foreach ($missions as $m): ?>
                                <li>
                                    <i class="fas fa-arrow-right"></i>
                                    <div>
                                        <strong><?= esc($m['title']) ?></strong>
                                        <p><?= esc($m['description']) ?></p>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Clients Section -->
        <section id="clients" class="py-5">
            <div class="container overflow-hidden">
                <div class="section-title text-center mb-5" data-aos="fade-up">
                    <h2>Klien & Mitra Kami</h2>
                    <div class="title-line"></div>
                </div>
                
                <?php if (!empty($clients)): ?>
                <!-- Row 1 -->
                <div class="slider-container mb-4">
                    <div class="logo-slider">
                        <!-- 1st Set -->
                        <?php foreach ($clients as $c): ?>
                        <div class="logo-slide">
                            <img src="<?= esc($c['logo_path']) ?>" alt="<?= esc($c['name']) ?>" />
                        </div>
                        <?php endforeach; ?>
                        <!-- 2nd Set -->
                        <?php foreach ($clients as $c): ?>
                        <div class="logo-slide">
                            <img src="<?= esc($c['logo_path']) ?>" alt="<?= esc($c['name']) ?>" />
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- Row 2 -->
                <div class="slider-container">
                    <div class="logo-slider slider-reverse">
                        <!-- 1st Set -->
                        <?php foreach ($clients as $c): ?>
                        <div class="logo-slide">
                            <img src="<?= esc($c['logo_path']) ?>" alt="<?= esc($c['name']) ?>" />
                        </div>
                        <?php endforeach; ?>
                        <!-- 2nd Set -->
                        <?php foreach ($clients as $c): ?>
                        <div class="logo-slide">
                            <img src="<?= esc($c['logo_path']) ?>" alt="<?= esc($c['name']) ?>" />
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>

        <!-- Team Section -->
        <section id="team">
            <div class="container">
                <div class="section-title text-center mb-5" data-aos="fade-up">
                    <h2>Jajaran Manajemen</h2>
                    <div class="title-line"></div>
                </div>
                <div class="row g-4 justify-content-center">
                    <?php foreach ($team as $index => $t): ?>
                    <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="<?= 100 * ($index + 1) ?>">
                        <div class="team-card">
                            <div class="team-img-wrapper">
                                <img src="<?= $t['photo_path'] ?? 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=400&q=80' ?>" alt="<?= esc($t['name']) ?>" class="team-img">
                            </div>
                            <div class="team-info">
                                <h5><?= esc($t['name']) ?></h5>
                                <p><?= esc($t['position']) ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Our Activities Section -->
        <section id="activities" class="bg-light">
            <div class="container">
                <div class="section-title text-center mb-5" data-aos="fade-up">
                    <h2>Galeri Kegiatan</h2>
                    <div class="title-line"></div>
                </div>
                <div class="gallery-grid">
                    <?php foreach ($gallery as $index => $g): ?>
                    <?php 
                        $class = '';
                        if ($index == 0) $class = 'tall';
                        elseif ($index == 2) $class = 'wide';
                    ?>
                    <div class="gallery-item <?= $class ?>" data-aos="zoom-in" data-aos-delay="<?= 100 * $index ?>">
                        <img src="<?= esc($g['image_path']) ?>" alt="<?= esc($g['title']) ?>" class="img-fluid">
                        <div class="gallery-overlay">
                            <p class="small text-white mb-0 fw-bold"><?= esc($g['title']) ?></p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer id="contact">
        <div class="container text-center">
            <a href="#" class="footer-logo">
                <img src="<?= base_url('Assets/logo.webp') ?>" width="auto" height="50" alt=""><br>
                <span style="color: var(--accent-color); ">PT Prakerja Nusantara</span>
            </a>
            <p class="text-muted small mb-5 fw-medium mt-3">
                <?= esc($settings['contact_address'] ?? 'Alamat Perusahaan') ?><br>
                <?= esc($settings['contact_email'] ?? 'email@example.com') ?> | <?= esc($settings['contact_phone'] ?? '+62000000') ?>
            </p>
            <hr style="background: rgba(0,0,0,0.05);">
            <p class="text-muted small mt-5"><?= esc($settings['copyright_text'] ?? '© 2026 PT Pra Kerja Nusantara.') ?></p>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS (Animate On Scroll) JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Custom JS -->
    <script src="<?= base_url('js/script.js') ?>"></script>
</body>

</html>
