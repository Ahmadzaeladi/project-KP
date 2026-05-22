    <footer id="contact">
        <div class="container text-center">
            <a href="<?= base_url() ?>" class="footer-logo">
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
