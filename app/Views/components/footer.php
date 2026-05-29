<footer id="contact" class="py-5" style="background: #f8fafc; border-top: 1px solid #edf2f7;">
        <div class="container">
            <div class="row g-5 mb-5">
                <!-- Company Info -->
                <div class="col-lg-4 col-md-6">
                    <a href="<?= base_url() ?>" class="d-flex align-items-center gap-3 mb-4 text-decoration-none">
                        <img src="<?= base_url('Assets/logo.webp') ?>" height="55" alt="Logo">
                        <div class="d-flex flex-column">
                            <span style="color: var(--primary-color); font-size: 1.15rem; font-weight: 800; line-height: 1.1; letter-spacing: -0.5px;">PT PRAKERJA</span>
                            <span style="color: var(--accent-color); font-size: 1.15rem; font-weight: 800; line-height: 1.1; letter-spacing: -0.5px;">NUSANTARA</span>
                        </div>
                    </a>
                    <p class="text-muted small pe-lg-4" style="line-height: 1.8; text-align: justify; text-transform: capitalize;">
                        You focus on your sales, we focus the rest.
                    </p>
                </div>
                
                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <h5 class="fw-bold mb-4" style="color: var(--primary-color);">Menu</h5>
                    <ul class="list-unstyled mb-0 d-flex flex-column gap-2">
                        <li><a href="<?= base_url('#hero') ?>" class="footer-link text-decoration-none text-muted">Beranda</a></li>
                        <li><a href="<?= base_url('#about') ?>" class="footer-link text-decoration-none text-muted">Tentang Kami</a></li>
                        <li><a href="<?= base_url('#services') ?>" class="footer-link text-decoration-none text-muted">Layanan</a></li>
                        <li><a href="<?= base_url('#clients') ?>" class="footer-link text-decoration-none text-muted">Klien Kami</a></li>
                        <li><a href="<?= base_url('#locations') ?>" class="footer-link text-decoration-none text-muted">Lokasi</a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div class="col-lg-4 col-md-6">
                    <h5 class="fw-bold mb-4" style="color: var(--primary-color);">Hubungi Kami</h5>
                    <ul class="list-unstyled mb-0 d-flex flex-column gap-3 text-muted small">
                        <li class="d-flex align-items-start gap-3">
                            <i class="fas fa-map-marker-alt mt-1" style="color: var(--accent-color);"></i>
                            <span><?= !empty($settings['contact_address']) ? esc($settings['contact_address']) : 'Jl. Batu Ceper No.33, dan No.33A 15, RT.15/RW.1, Kb. Klp., Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10120' ?></span>
                        </li>
                        <li class="d-flex align-items-center gap-3">
                            <i class="fas fa-envelope" style="color: var(--accent-color);"></i>
                            <span><?= !empty($settings['contact_email']) ? esc($settings['contact_email']) : 'email@example.com' ?></span>
                        </li>
                        <li class="d-flex align-items-center gap-3">
                            <i class="fas fa-phone-alt" style="color: var(--accent-color);"></i>
                            <span><?= !empty($settings['contact_phone']) ? esc($settings['contact_phone']) : '085974336678' ?></span>
                        </li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div class="col-lg-2 col-md-6">
                    <h5 class="fw-bold mb-4" style="color: var(--primary-color);">Sosial Media</h5>
                    <div class="d-flex gap-3">
                        <a href="https://www.linkedin.com/company/ptpkn/?originalSubdomain=id" class="social-icon" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.linkedin.com/company/ptpkn/?originalSubdomain=id" class="social-icon" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>
            
            <style>
                .footer-link {
                    transition: all 0.3s ease;
                }
                .footer-link:hover {
                    color: var(--accent-color) !important;
                    padding-left: 5px;
                }
                .social-icon {
                    width: 35px;
                    height: 35px;
                    background: rgba(0, 74, 173, 0.05);
                    color: var(--primary-color);
                    border-radius: 50%;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    transition: all 0.3s ease;
                    text-decoration: none;
                }
                .social-icon:hover {
                    background: var(--primary-color);
                    color: #ffffff;
                    transform: translateY(-3px);
                }
            </style>
            
            <hr style="background: rgba(0,0,0,0.1); border-color: transparent;">
            
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4">
                <p class="text-muted small mb-0"><?= esc($settings['copyright_text'] ?? '© 2026 PT Pra Kerja Nusantara.') ?> All rights reserved.</p>
                <div class="d-flex gap-3 mt-3 mt-md-0 small">
                    <a href="#" class="text-muted text-decoration-none footer-link">Kebijakan Privasi</a>
                    <a href="#" class="text-muted text-decoration-none footer-link">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>
