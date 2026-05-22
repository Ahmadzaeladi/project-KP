    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= base_url() ?>">
                <img src="<?= base_url('Assets/logo.webp') ?>" alt="" width="auto" height="50px">
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class="fas fa-bars" style="color: var(--primary-color);"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('#hero') ?>">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('#about') ?>">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('#vision-mission') ?>">Visi Misi</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('#team') ?>">Manajemen</a></li>
                    <li class="nav-item"><a class="nav-link <?= (url_is('gallery') ? 'active' : '') ?>" href="<?= base_url('gallery') ?>">Galeri</a></li>
                    <li class="nav-item ms-lg-4 mt-2 mt-lg-0"><a class="btn-modern btn-filled" href="<?= base_url('#contact') ?>">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
