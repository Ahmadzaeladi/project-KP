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
