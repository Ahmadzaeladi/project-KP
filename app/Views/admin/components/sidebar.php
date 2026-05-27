        <!-- Sidebar SPA (Desktop) -->
        <aside class="sidebar-spa">
            <div class="sidebar-brand flex justify-content-center align-items-center">
                <img src="<?= base_url('Assets/logo.webp') ?>" style="max-width: 100%; height: auto; max-height: 65px; object-fit: contain; margin: 0 auto; display: block;" alt="Logo">
            </div>
            <nav class="nav-links-spa">
                <a href="#dashboard" class="nav-link-spa active" data-view="dashboard">
                    <i class="fas fa-grid-2"></i> Dashboard
                </a>
                <a href="#hero" class="nav-link-spa" data-view="hero">
                    <i class="fas fa-building"></i> Profil Utama
                </a>
                <a href="#visimisi" class="nav-link-spa" data-view="visimisi">
                    <i class="fas fa-bullseye"></i> Visi & Misi
                </a>
                <a href="#team" class="nav-link-spa" data-view="team">
                    <i class="fas fa-user-group"></i> Kolektif Tim
                </a>
                <a href="#clients" class="nav-link-spa" data-view="clients">
                    <i class="fas fa-handshake"></i> Klien & Mitra
                </a>
                <a href="#gallery" class="nav-link-spa" data-view="gallery">
                    <i class="fas fa-images"></i> Gallery
                </a>
                <a href="#services" class="nav-link-spa" data-view="services">
                    <i class="fas fa-briefcase"></i> Layanan Kami
                </a>
                <a href="#certifications" class="nav-link-spa" data-view="certifications">
                    <i class="fas fa-certificate"></i> Sertifikasi
                </a>
                <a href="#locations" class="nav-link-spa" data-view="locations">
                    <i class="fas fa-map-location-dot"></i> Lokasi Kantor
                </a>
            </nav>
            <div style="padding: 2rem;">
                <a href="<?= base_url() ?>" target="_blank" class="nav-link-spa" style="background: #f1f5f9;">
                    <i class="fas fa-arrow-up-right-from-square"></i> Live Site
                </a>
                <a href="<?= base_url('logout') ?>" class="nav-link-spa text-danger mt-3" style="color: #ef4444;">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </a>
            </div>
        </aside>

        <!-- Bottom Nav SPA (Mobile) -->
        <nav class="bottom-nav-spa">
            <a href="#dashboard" class="bottom-link active" data-view="dashboard"><i class="fas fa-house"></i></a>
            <a href="#hero" class="bottom-link" data-view="hero"><i class="fas fa-building"></i></a>
            <a href="#gallery" class="bottom-link" data-view="gallery"><i class="fas fa-images"></i></a>
            <a href="javascript:void(0)" class="bottom-link" onclick="openModal('mobile-menu-modal')"><i class="fas fa-bars"></i></a>
        </nav>

        <!-- Mobile Menu Bottom Sheet -->
        <div class="modal-overlay-spa" id="mobile-menu-modal">
            <div class="modal-content-spa">
                <div class="drag-handle-mobile"></div>
                <h3 style="font-weight: 800; margin-bottom: 1.5rem; text-align: center;">Menu Navigasi</h3>
                <nav style="display: flex; flex-direction: column; gap: 5px;">
                    <a href="#dashboard" class="nav-link-spa active" data-view="dashboard" onclick="closeModal('mobile-menu-modal')">
                        <i class="fas fa-grid-2"></i> Dashboard
                    </a>
                    <a href="#hero" class="nav-link-spa" data-view="hero" onclick="closeModal('mobile-menu-modal')">
                        <i class="fas fa-building"></i> Profil Utama
                    </a>
                    <a href="#visimisi" class="nav-link-spa" data-view="visimisi" onclick="closeModal('mobile-menu-modal')">
                        <i class="fas fa-bullseye"></i> Visi & Misi
                    </a>
                    <a href="#team" class="nav-link-spa" data-view="team" onclick="closeModal('mobile-menu-modal')">
                        <i class="fas fa-user-group"></i> Kolektif Tim
                    </a>
                    <a href="#clients" class="nav-link-spa" data-view="clients" onclick="closeModal('mobile-menu-modal')">
                        <i class="fas fa-handshake"></i> Klien & Mitra
                    </a>
                    <a href="#gallery" class="nav-link-spa" data-view="gallery" onclick="closeModal('mobile-menu-modal')">
                        <i class="fas fa-images"></i> Gallery
                    </a>
                    <a href="#services" class="nav-link-spa" data-view="services" onclick="closeModal('mobile-menu-modal')">
                        <i class="fas fa-briefcase"></i> Layanan Kami
                    </a>
                    <a href="#certifications" class="nav-link-spa" data-view="certifications" onclick="closeModal('mobile-menu-modal')">
                        <i class="fas fa-certificate"></i> Sertifikasi
                    </a>
                    <a href="#locations" class="nav-link-spa" data-view="locations" onclick="closeModal('mobile-menu-modal')">
                        <i class="fas fa-map-location-dot"></i> Lokasi Kantor
                    </a>
                </nav>
            </div>
        </div>
