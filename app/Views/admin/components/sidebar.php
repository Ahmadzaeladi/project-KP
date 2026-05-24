        <!-- Sidebar SPA (Desktop) -->
        <aside class="sidebar-spa">
            <div class="sidebar-brand">
                PKN<span>.</span>CMS
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
            <a href="#visimisi" class="bottom-link" data-view="visimisi"><i class="fas fa-bullseye"></i></a>
            <a href="#team" class="bottom-link" data-view="team"><i class="fas fa-users-gear"></i></a>
            <a href="#clients" class="bottom-link" data-view="clients"><i class="fas fa-handshake"></i></a>
            <a href="#gallery" class="bottom-link" data-view="gallery"><i class="fas fa-photo-film"></i></a>
        </nav>
