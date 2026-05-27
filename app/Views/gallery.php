<?= $this->extend('layouts/compro_layout') ?>

<?= $this->section('extra_head') ?>
    <style>
        .gallery-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .gallery-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .gallery-card-img-wrapper {
            width: 100%;
            padding-top: 75%; /* 4:3 Aspect Ratio */
            position: relative;
            overflow: hidden;
        }

        .gallery-card-img-wrapper img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .gallery-card:hover .gallery-card-img-wrapper img {
            transform: scale(1.05);
        }

        .gallery-card-body {
            padding: 1.25rem;
            background: #fff;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }
        
        .gallery-page-header {
            padding: 120px 0 60px;
            background-color: var(--light-bg, #f8f9fa);
            text-align: center;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
        <section class="gallery-page-header">
            <div class="container">
                <div class="section-title mb-0" data-aos="fade-up">
                    <h1 class="display-5 fw-bold" style="color: var(--text-main); letter-spacing: -1px;">Galeri Kegiatan</h1>
                    <div class="title-line mx-auto mt-3"></div>
                    <p class="text-muted mt-3" style="font-size: 1.1rem;">Dokumentasi dan aktivitas profesional PT Prakerja Nusantara</p>
                </div>
            </div>
        </section>

        <section id="gallery-content" class="py-5">
            <div class="container">
                <div class="row g-4">
                    <?php if (!empty($gallery)): ?>
                        <?php foreach ($gallery as $index => $g): ?>
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= 50 * ($index % 3 + 1) ?>">
                            <div class="gallery-card">
                                <div class="gallery-card-img-wrapper">
                                    <img src="<?= esc($g['image_path']) ?>" alt="<?= esc($g['title']) ?>">
                                </div>
                                <div class="gallery-card-body">
                                    <h5 class="fw-bold mb-3 text-dark"><?= esc($g['title']) ?></h5>
                                    <?php if(!empty($g['subtitle'])): ?>
                                        <p class="text-muted small mb-4" style="text-align: justify;"><?= esc($g['subtitle']) ?></p>
                                    <?php endif; ?>
                                    
                                    <div class="mt-auto text-end">
                                        <small class="text-muted fw-medium">
                                            <i class="far fa-calendar-alt me-1"></i> 
                                            <?= !empty($g['published_at']) ? date('d M Y', strtotime($g['published_at'])) : date('d M Y', strtotime($g['create_at'] ?? 'now')) ?>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">Belum ada foto galeri.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
<?= $this->endSection() ?>
