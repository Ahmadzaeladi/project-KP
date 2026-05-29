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
