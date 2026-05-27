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
<?= $this->endSection() ?>

<?= $this->section('content') ?>
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
                            <!-- <a href="#about" class="btn-modern btn-filled"><?= esc($hero['primary_cta_text'] ?? 'Eksplorasi') ?></a>
                            <a href="#contact" class="btn-modern"><?= esc($hero['secondary_cta_text'] ?? 'Kolaborasi') ?></a> -->
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

        <!-- Services Section -->
        <section id="services" class="py-5" style="background: #ffffff; border-top: 1px solid #edf2f7;">
            <div class="container py-4">
                <div class="row g-5">
                    <!-- Left Side: Title -->
                    <div class="col-lg-4" data-aos="fade-right">
                        <div class="sticky-top" style="top: 120px; z-index: 10;">
                            <div class="section-title text-start mb-4">
                                <h2 style="font-size: 2.2rem; line-height: 1.2;">Layanan<br>Unggulan</h2>
                                <div class="title-line ms-0" style="margin-top: 15px;"></div>
                            </div>
                            <p class="text-muted" style="font-size: 0.95rem; line-height: 1.8;">Kami memberikan solusi nyata yang dirancang khusus untuk memenuhi kebutuhan operasional bisnis Anda secara profesional, efisien, dan berkelanjutan.</p>
                        </div>
                    </div>
                    
                    <!-- Right Side: Services List -->
                    <div class="col-lg-8">
                        <?php if (!empty($services)): ?>
                        <div class="d-flex flex-column gap-0">
                            <?php foreach ($services as $index => $s): ?>
                            <div class="service-row-item py-4" data-aos="fade-up" data-aos-delay="<?= 50 * ($index + 1) ?>">
                                <div class="d-flex align-items-start gap-4">
                                    <div class="service-icon-minimal">
                                        <div class="icon-dot"></div>
                                    </div>
                                    <div class="service-content">
                                        <h5 class="fw-bold mb-2" style="font-size: 1.1rem; color: var(--text-main); letter-spacing: -0.3px;"><?= esc($s['title']) ?></h5>
                                        <p class="text-muted mb-0" style="font-size: 0.9rem; line-height: 1.7;"><?= nl2br(esc($s['description'])) ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <style>
                            .service-row-item {
                                border-bottom: 1px solid rgba(0,0,0,0.06);
                                transition: all 0.3s ease;
                            }
                            .service-row-item:last-child {
                                border-bottom: none;
                            }
                            .service-row-item:hover {
                                background: linear-gradient(90deg, rgba(241, 249, 254, 0.5) 0%, transparent 100%);
                                padding-left: 15px;
                                border-radius: 8px;
                            }
                            .service-row-item:hover .service-content h5 {
                                color: var(--primary-color) !important;
                            }
                            .service-icon-minimal {
                                margin-top: 4px;
                                width: 20px;
                                height: 20px;
                                border-radius: 50%;
                                background: rgba(0, 180, 216, 0.1);
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                flex-shrink: 0;
                                transition: all 0.3s ease;
                            }
                            .service-icon-minimal .icon-dot {
                                width: 6px;
                                height: 6px;
                                border-radius: 50%;
                                background: var(--accent-color);
                                transition: all 0.3s ease;
                            }
                            .service-row-item:hover .service-icon-minimal {
                                background: rgba(0, 74, 173, 0.15);
                            }
                            .service-row-item:hover .icon-dot {
                                transform: scale(1.5);
                                background: var(--primary-color);
                            }
                        </style>
                        <?php endif; ?>
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
        <!-- Certifications Section -->
        <section id="certifications" class="py-5" style="background: var(--bg-light); border-top: 1px solid rgba(0,0,0,0.03);">
            <div class="container overflow-hidden">
                <div class="section-title text-center mb-5" data-aos="fade-up">
                    <h2>Terdaftar & Tersertifikasi</h2>
                    <div class="title-line" style="margin: 0 auto;"></div>
                    <p class="text-muted mt-3">Didukung dan diakui oleh lembaga-lembaga terpercaya.</p>
                </div>
                
                <?php if (!empty($certifications)): ?>
                <div class="row g-4 justify-content-center mt-2" data-aos="fade-up" data-aos-delay="100">
                    <?php foreach ($certifications as $c): ?>
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="certification-card p-4 h-100 d-flex flex-column align-items-center justify-content-center bg-white rounded-4 shadow-sm" style="transition: all 0.3s ease; border: 1px solid rgba(0,74,173,0.05); text-align: center;">
                                <img src="<?= esc($c['logo_path']) ?>" alt="<?= esc($c['name']) ?>" style="height: 80px; width: 100%; object-fit: contain; filter: grayscale(100%); opacity: 0.7; transition: all 0.4s ease;" class="cert-img">
                                <h6 class="mt-4 mb-0 fw-bold text-dark cert-title" style="font-size: 0.9rem; opacity: 0; transform: translateY(10px); transition: all 0.3s ease;"><?= esc($c['name']) ?></h6>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <style>
                    .certification-card:hover {
                        transform: translateY(-5px);
                        box-shadow: 0 15px 30px rgba(0, 74, 173, 0.1) !important;
                        border-color: rgba(0, 74, 173, 0.2) !important;
                    }
                    .certification-card:hover .cert-img {
                        filter: grayscale(0%) !important;
                        opacity: 1 !important;
                        transform: scale(1.05);
                    }
                    .certification-card:hover .cert-title {
                        opacity: 1 !important;
                        transform: translateY(0) !important;
                        color: var(--primary-color) !important;
                    }
                </style>
                <?php endif; ?>
            </div>
        </section>
<?= $this->endSection() ?>
