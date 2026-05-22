<?= $this->extend('layout/frontend') ?>

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
<?= $this->endSection() ?>
