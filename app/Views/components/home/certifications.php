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
