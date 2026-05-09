<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>
    <div class="app-container">
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

        <!-- Modals -->
        
        <!-- Gallery Modal -->
        <div class="modal-overlay-spa" id="photo-modal">
            <div class="modal-content-spa">
                <div class="drag-handle-mobile"></div>
                <div class="modal-header-spa">
                    <h2 style="font-weight: 800; margin: 0;">Tambah Arsip Visual</h2>
                    <button type="button" onclick="closeModal('photo-modal')" style="background: #f1f5f9; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer;"><i class="fas fa-times"></i></button>
                </div>
                <?= form_open_multipart('admin/gallery/add', ['id' => 'add-photo-form', 'style' => 'display: grid; gap: 20px;']) ?>
                    <div>
                        <label class="form-label-spa">Judul Kegiatan</label>
                        <input type="text" name="title" class="input-spa" placeholder="Contoh: Pelatihan Softskill 2024" required>
                    </div>
                    <div>
                        <label class="form-label-spa">Dokumentasi Foto</label>
                        <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                            <button type="button" class="btn-spa" onclick="triggerUpload('camera')" style="flex:1; background: #e2e8f0; border:none; padding: 10px; border-radius: 8px; font-weight: 600; cursor: pointer;"><i class="fas fa-camera" style="margin-right: 5px;"></i> Kamera</button>
                            <button type="button" class="btn-spa" onclick="triggerUpload('file')" style="flex:1; background: #e2e8f0; border:none; padding: 10px; border-radius: 8px; font-weight: 600; cursor: pointer;"><i class="fas fa-folder-open" style="margin-right: 5px;"></i> File Browser</button>
                        </div>
                        <div class="file-upload-zone" onclick="triggerUpload('file')">
                            <input type="file" name="photo" id="file-input" style="display: none;" accept="image/*" required onchange="previewImage(event, 'image-preview', 'upload-instruction')">
                            <div id="upload-instruction">
                                <i class="fas fa-cloud-arrow-up fs-1 text-muted mb-3" style="font-size:2rem;"></i>
                                <h5 style="margin-bottom: 0.5rem; font-weight: 700;">Pilih Foto</h5>
                                <p class="small text-muted mb-0">Klik tombol di atas atau area ini</p>
                            </div>
                            <img id="image-preview" src="#" alt="Preview" style="display: none; max-width: 100%; max-height: 200px; object-fit: contain; margin: 0 auto; border-radius: 8px;">
                        </div>
                    </div>
                    <div style="margin-top: 1rem;">
                        <button type="submit" id="btn-save-photo" class="btn-spa btn-spa-primary" style="width: 100%;">Upload & Simpan</button>
                    </div>
                <?= form_close() ?>
            </div>
        </div>

        <!-- Team Modal (Add) -->
        <div class="modal-overlay-spa" id="team-modal">
            <div class="modal-content-spa">
                <div class="drag-handle-mobile"></div>
                <div class="modal-header-spa">
                    <h2 style="font-weight: 800; margin: 0;">Tambah Anggota Tim</h2>
                    <button type="button" onclick="closeModal('team-modal')" style="background: #f1f5f9; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer;"><i class="fas fa-times"></i></button>
                </div>
                <form id="add-team-form" style="display: grid; gap: 20px;" enctype="multipart/form-data">
                    <div>
                        <label class="form-label-spa">Nama Lengkap</label>
                        <input type="text" name="name" class="input-spa" required>
                    </div>
                    <div>
                        <label class="form-label-spa">Posisi / Jabatan</label>
                        <input type="text" name="position" class="input-spa" required>
                    </div>
                    <div>
                        <label class="form-label-spa">Foto Profil</label>
                        <input type="file" name="photo" class="input-spa" accept="image/*" required>
                    </div>
                    <div style="margin-top: 1rem;">
                        <button type="submit" class="btn-spa btn-spa-primary" style="width: 100%;">Simpan Anggota</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Team Modal (Edit) -->
        <div class="modal-overlay-spa" id="edit-team-modal">
            <div class="modal-content-spa">
                <div class="drag-handle-mobile"></div>
                <div class="modal-header-spa">
                    <h2 style="font-weight: 800; margin: 0;">Edit Anggota Tim</h2>
                    <button type="button" onclick="closeModal('edit-team-modal')" style="background: #f1f5f9; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer;"><i class="fas fa-times"></i></button>
                </div>
                <form id="edit-team-form" style="display: grid; gap: 20px;" enctype="multipart/form-data">
                    <input type="hidden" id="edit-team-id">
                    <div>
                        <label class="form-label-spa">Nama Lengkap</label>
                        <input type="text" name="name" id="edit-team-name" class="input-spa" required>
                    </div>
                    <div>
                        <label class="form-label-spa">Posisi / Jabatan</label>
                        <input type="text" name="position" id="edit-team-position" class="input-spa" required>
                    </div>
                    <div>
                        <label class="form-label-spa">Foto Baru (Opsional)</label>
                        <input type="file" name="photo" class="input-spa" accept="image/*">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah foto</small>
                    </div>
                    <div style="margin-top: 1rem;">
                        <button type="submit" class="btn-spa btn-spa-primary" style="width: 100%;">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Mission Modal (Add) -->
        <div class="modal-overlay-spa" id="mission-modal">
            <div class="modal-content-spa">
                <div class="drag-handle-mobile"></div>
                <div class="modal-header-spa">
                    <h2 style="font-weight: 800; margin: 0;">Tambah Misi</h2>
                    <button type="button" onclick="closeModal('mission-modal')" style="background: #f1f5f9; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer;"><i class="fas fa-times"></i></button>
                </div>
                <form id="add-mission-form" style="display: grid; gap: 20px;">
                    <div>
                        <label class="form-label-spa">Judul Misi</label>
                        <input type="text" name="title" class="input-spa" required>
                    </div>
                    <div>
                        <label class="form-label-spa">Deskripsi</label>
                        <textarea name="description" class="input-spa" rows="3" required></textarea>
                    </div>
                    <div style="margin-top: 1rem;">
                        <button type="submit" class="btn-spa btn-spa-primary" style="width: 100%;">Simpan Misi</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Mission Modal (Edit) -->
        <div class="modal-overlay-spa" id="edit-mission-modal">
            <div class="modal-content-spa">
                <div class="drag-handle-mobile"></div>
                <div class="modal-header-spa">
                    <h2 style="font-weight: 800; margin: 0;">Edit Misi</h2>
                    <button type="button" onclick="closeModal('edit-mission-modal')" style="background: #f1f5f9; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer;"><i class="fas fa-times"></i></button>
                </div>
                <form id="edit-mission-form" style="display: grid; gap: 20px;">
                    <input type="hidden" id="edit-mission-id">
                    <div>
                        <label class="form-label-spa">Judul Misi</label>
                        <input type="text" name="title" id="edit-mission-title" class="input-spa" required>
                    </div>
                    <div>
                        <label class="form-label-spa">Deskripsi</label>
                        <textarea name="description" id="edit-mission-desc" class="input-spa" rows="3" required></textarea>
                    </div>
                    <div style="margin-top: 1rem;">
                        <button type="submit" class="btn-spa btn-spa-primary" style="width: 100%;">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Client Modal (Add) -->
        <div class="modal-overlay-spa" id="client-modal">
            <div class="modal-content-spa">
                <div class="drag-handle-mobile"></div>
                <div class="modal-header-spa">
                    <h2 style="font-weight: 800; margin: 0;">Tambah Klien / Mitra</h2>
                    <button type="button" onclick="closeModal('client-modal')" style="background: #f1f5f9; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer;"><i class="fas fa-times"></i></button>
                </div>
                <form id="add-client-form" style="display: grid; gap: 20px;" enctype="multipart/form-data">
                    <div>
                        <label class="form-label-spa">Nama Klien</label>
                        <input type="text" name="name" class="input-spa" required>
                    </div>
                    <div>
                        <label class="form-label-spa">Logo Klien</label>
                        <input type="file" name="photo" class="input-spa" accept="image/*" required>
                    </div>
                    <div style="margin-top: 1rem;">
                        <button type="submit" class="btn-spa btn-spa-primary" style="width: 100%;">Simpan Klien</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Client Modal (Edit) -->
        <div class="modal-overlay-spa" id="edit-client-modal">
            <div class="modal-content-spa">
                <div class="drag-handle-mobile"></div>
                <div class="modal-header-spa">
                    <h2 style="font-weight: 800; margin: 0;">Edit Klien / Mitra</h2>
                    <button type="button" onclick="closeModal('edit-client-modal')" style="background: #f1f5f9; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer;"><i class="fas fa-times"></i></button>
                </div>
                <form id="edit-client-form" style="display: grid; gap: 20px;" enctype="multipart/form-data">
                    <input type="hidden" id="edit-client-id">
                    <div>
                        <label class="form-label-spa">Nama Klien</label>
                        <input type="text" name="name" id="edit-client-name" class="input-spa" required>
                    </div>
                    <div>
                        <label class="form-label-spa">Logo Baru (Opsional)</label>
                        <input type="file" name="photo" class="input-spa" accept="image/*">
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah logo</small>
                    </div>
                    <div style="margin-top: 1rem;">
                        <button type="submit" class="btn-spa btn-spa-primary" style="width: 100%;">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Main Content Area -->
        <main class="main-view" id="app-view">
            <!-- Content will be injected here by JS -->
            <div class="view-content">
                <h2>Memuat Dashboard...</h2>
            </div>
        </main>
    </div>

    <!-- SPA Logic -->
    <script>
        function triggerUpload(type) {
            const input = document.getElementById('file-input');
            if (type === 'camera') {
                input.setAttribute('capture', 'environment');
            } else {
                input.removeAttribute('capture');
            }
            input.click();
        }

        let serverData = <?= json_encode([
            'hero' => $hero,
            'settings' => $settings,
            'gallery' => $gallery,
            'missions' => $missions,
            'team' => $team,
            'clients' => $clients ?? []
        ]) ?>;

        const baseUrl = '<?= base_url() ?>';

        function showToast(message, type = 'info') {
             const existingToast = document.querySelector('.toast-spa');
             if (existingToast) existingToast.remove();
             const toast = document.createElement('div');
             toast.className = `toast-spa ${type}`;
             let icon = 'info-circle';
             if (type === 'success') icon = 'check-circle';
             if (type === 'error') icon = 'exclamation-triangle';
             toast.innerHTML = `<i class="fas fa-${icon}"></i> ${message}`;
             document.body.appendChild(toast);
             setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(20px)';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        function renderDashboard() {
            return `
                <div class="view-content">
                    <header style="margin-bottom: 3rem;">
                        <h1 style="font-weight: 800; font-size: 2rem; margin-bottom: 0.5rem;">Dashboard Overview</h1>
                        <p style="color: var(--text-muted);">Selamat datang di sistem manajemen konten.</p>
                    </header>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 25px; margin-bottom: 3rem;">
                        <div class="card-spa stat-card">
                            <div class="icon-box-spa" style="background: rgba(0, 74, 173, 0.1); color: var(--primary-color);">
                                <i class="fas fa-images"></i>
                            </div>
                            <div>
                                <h3 style="margin: 0; font-size: 1.5rem; font-weight: 800;">${serverData.gallery.length}</h3>
                                <p style="margin: 0; color: var(--text-muted); font-size: 0.85rem;">Total Arsip Foto</p>
                            </div>
                        </div>
                        <div class="card-spa stat-card">
                            <div class="icon-box-spa" style="background: rgba(0, 180, 216, 0.1); color: var(--secondary-color);">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <h3 style="margin: 0; font-size: 1.5rem; font-weight: 800;">${serverData.team.length}</h3>
                                <p style="margin: 0; color: var(--text-muted); font-size: 0.85rem;">Anggota Tim</p>
                            </div>
                        </div>
                        <div class="card-spa stat-card">
                            <div class="icon-box-spa" style="background: rgba(16, 185, 129, 0.1); color: #10b981;">
                                <i class="fas fa-bullseye"></i>
                            </div>
                            <div>
                                <h3 style="margin: 0; font-size: 1.5rem; font-weight: 800;">${serverData.missions.length}</h3>
                                <p style="margin: 0; color: var(--text-muted); font-size: 0.85rem;">Misi Terdaftar</p>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        function renderHeroProfile() {
            const h = serverData.hero;
            const s = serverData.settings;
            return `
                <div class="view-content">
                    <header style="margin-bottom: 3rem;">
                        <h1 style="font-weight: 800; font-size: 2rem; margin-bottom: 0.5rem;">Profil Utama</h1>
                        <p style="color: var(--text-muted);">Kelola konten Hero, Tentang Kami, dan Info Kontak.</p>
                    </header>
                    
                    <div class="card-spa">
                        <h3 style="margin-bottom: 1.5rem; font-weight:800;">1. Hero Section</h3>
                        <form id="hero-form" style="display: grid; gap: 20px;" enctype="multipart/form-data">
                            <div>
                                <label class="form-label-spa">Gambar Background (Opsional)</label>
                                <div class="file-upload-zone" onclick="document.getElementById('hero-bg-input').click()">
                                    <input type="file" name="photo" id="hero-bg-input" style="display: none;" accept="image/*" onchange="previewImage(event, 'hero-bg-preview', 'hero-bg-instruction')">
                                    <div id="hero-bg-instruction" style="${h.background_image ? 'display:none;' : 'display:block;'}">
                                        <i class="fas fa-cloud-arrow-up fs-1 text-muted mb-3" style="font-size:2rem;"></i>
                                        <h5 style="margin-bottom: 0.5rem; font-weight: 700;">Ganti Background</h5>
                                        <p class="small text-muted mb-0">Klik untuk mengunggah gambar baru</p>
                                    </div>
                                    <img id="hero-bg-preview" src="${h.background_image || ''}" alt="Preview" style="${h.background_image ? 'display:block;' : 'display:none;'} max-width: 100%; max-height: 200px; object-fit: contain; margin: 0 auto; border-radius: 8px;">
                                </div>
                            </div>
                            <div>
                                <label class="form-label-spa">Headline</label>
                                <input type="text" name="headline" class="input-spa" value="${h.headline || ''}" required>
                            </div>
                            <div>
                                <label class="form-label-spa">Sub Headline</label>
                                <textarea name="sub_headline" class="input-spa" rows="3">${h.sub_headline || ''}</textarea>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                <div>
                                    <label class="form-label-spa">Primary CTA</label>
                                    <input type="text" name="primary_cta_text" class="input-spa" value="${h.primary_cta_text || ''}">
                                </div>
                                <div>
                                    <label class="form-label-spa">Secondary CTA</label>
                                    <input type="text" name="secondary_cta_text" class="input-spa" value="${h.secondary_cta_text || ''}">
                                </div>
                            </div>
                            <div style="margin-top: 1rem;">
                                <button type="submit" class="btn-spa btn-spa-primary">Simpan Hero</button>
                            </div>
                        </form>
                    </div>

                    <div class="card-spa">
                        <h3 style="margin-bottom: 1.5rem; font-weight:800;">2. Tentang Kami & Stats</h3>
                        <form id="settings-about-form" style="display: grid; gap: 20px;">
                            <div>
                                <label class="form-label-spa">Deskripsi Perusahaan</label>
                                <textarea name="about_text" class="input-spa" rows="4">${s.about_text || ''}</textarea>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                <div>
                                    <label class="form-label-spa">Statistik Pengalaman</label>
                                    <input type="text" name="stat_experience" class="input-spa" value="${s.stat_experience || ''}">
                                </div>
                                <div>
                                    <label class="form-label-spa">Statistik Mitra</label>
                                    <input type="text" name="stat_partners" class="input-spa" value="${s.stat_partners || ''}">
                                </div>
                            </div>
                            <div>
                                <label class="form-label-spa">Alamat Kontak</label>
                                <textarea name="contact_address" class="input-spa" rows="2">${s.contact_address || ''}</textarea>
                            </div>
                            <div style="margin-top: 1rem;">
                                <button type="submit" class="btn-spa btn-spa-primary">Simpan Profil</button>
                            </div>
                        </form>
                    </div>
                </div>
            `;
        }

        function renderVisiMisi() {
            const s = serverData.settings;
            let rows = serverData.missions.map(m => `
                <div class="card-spa" style="padding: 1.2rem; display: flex; align-items: center; gap: 20px; margin-bottom:15px;">
                    <div style="flex-grow:1;">
                        <h5 style="margin: 0; font-weight: 700;">${m.title}</h5>
                        <p style="margin: 5px 0 0; font-size: 0.85rem; color: var(--text-muted);">${m.description}</p>
                    </div>
                    <div style="display:flex; gap: 10px;">
                        <button onclick="openEditMission(${m.id})" style="background: #e0f2fe; border: none; padding: 10px; border-radius: 10px; cursor: pointer;"><i class="fas fa-edit text-primary" style="color: #0ea5e9;"></i></button>
                        <button onclick="deleteMission(${m.id})" style="background: #fee2e2; border: none; padding: 10px; border-radius: 10px; cursor: pointer;"><i class="fas fa-trash text-danger" style="color:#ef4444;"></i></button>
                    </div>
                </div>
            `).join('');

            if(rows === '') rows = '<p class="text-muted">Belum ada data misi.</p>';

            return `
                <div class="view-content">
                    <header style="margin-bottom: 3rem;">
                        <h1 style="font-weight: 800; font-size: 2rem; margin-bottom: 0.5rem;">Visi & Misi</h1>
                    </header>
                    
                    <div class="card-spa">
                        <form id="settings-vision-form" style="display: grid; gap: 20px;">
                            <div>
                                <label class="form-label-spa">Teks Visi Utama</label>
                                <textarea name="vision_text" class="input-spa" rows="3">${s.vision_text || ''}</textarea>
                            </div>
                            <div style="margin-top: 0.5rem;">
                                <button type="submit" class="btn-spa btn-spa-primary">Simpan Visi</button>
                            </div>
                        </form>
                    </div>

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                        <h3 style="font-weight:800; margin:0;">Daftar Misi</h3>
                        <button class="btn-spa btn-spa-primary" style="padding: 0.5rem 1rem; border-radius: 10px;" onclick="openModal('mission-modal')">+ Tambah</button>
                    </div>
                    <div>${rows}</div>
                </div>
            `;
        }

        function renderTeam() {
            let rows = serverData.team.map(t => `
                <div class="card-spa" style="padding: 1.2rem; display: flex; align-items: center; gap: 20px; margin-bottom:15px;">
                    <img src="${t.photo_path || 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=150&q=80'}" style="width:50px; height:50px; border-radius:50%; object-fit:cover;">
                    <div style="flex-grow:1;">
                        <h5 style="margin: 0; font-weight: 700;">${t.name}</h5>
                        <p style="margin: 0; font-size: 0.8rem; color: var(--primary-color); font-weight: 600;">${t.position}</p>
                    </div>
                    <div style="display:flex; gap: 10px;">
                        <button onclick="openEditTeam(${t.id})" style="background: #e0f2fe; border: none; padding: 10px; border-radius: 10px; cursor: pointer;"><i class="fas fa-edit text-primary" style="color: #0ea5e9;"></i></button>
                        <button onclick="deleteTeam(${t.id})" style="background: #fee2e2; border: none; padding: 10px; border-radius: 10px; cursor: pointer;"><i class="fas fa-trash text-danger" style="color:#ef4444;"></i></button>
                    </div>
                </div>
            `).join('');

            if(rows === '') rows = '<p class="text-muted">Belum ada anggota tim.</p>';

            return `
                <div class="view-content">
                    <header style="margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: flex-end;">
                        <div>
                            <h1 style="font-weight: 800; font-size: 2rem; margin-bottom: 0.5rem;">Kolektif Tim</h1>
                            <p style="color: var(--text-muted);">Kelola profil manajemen.</p>
                        </div>
                        <button class="btn-spa btn-spa-primary" style="padding: 0.8rem 1.5rem;" onclick="openModal('team-modal')"><i class="fas fa-plus me-2"></i> Tambah</button>
                    </header>
                    <div>${rows}</div>
                </div>
            `;
        }

        function renderClients() {
            let rows = serverData.clients.map(c => `
                <div class="card-spa" style="padding: 1.2rem; display: flex; align-items: center; gap: 20px; margin-bottom:15px; opacity: ${c.is_active == 1 ? '1' : '0.5'}">
                    <img src="${c.logo_path}" style="width:80px; height:50px; object-fit:contain;">
                    <div style="flex-grow:1;">
                        <h5 style="margin: 0; font-weight: 700;">${c.name}</h5>
                    </div>
                    <div style="display:flex; gap: 10px; align-items: center;">
                        <div class="toggle-switch-spa ${c.is_active == 1 ? 'active' : ''}" onclick="toggleClientStatus(${c.id})">
                            <div class="toggle-dot"></div>
                        </div>
                        <button onclick="openEditClient(${c.id})" style="background: #e0f2fe; border: none; padding: 10px; border-radius: 10px; cursor: pointer;"><i class="fas fa-edit text-primary" style="color: #0ea5e9;"></i></button>
                        <button onclick="deleteClient(${c.id})" style="background: #fee2e2; border: none; padding: 10px; border-radius: 10px; cursor: pointer;"><i class="fas fa-trash text-danger" style="color:#ef4444;"></i></button>
                    </div>
                </div>
            `).join('');

            if(rows === '') rows = '<p class="text-muted">Belum ada logo klien.</p>';

            return `
                <div class="view-content">
                    <header style="margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: flex-end;">
                        <div>
                            <h1 style="font-weight: 800; font-size: 2rem; margin-bottom: 0.5rem;">Klien & Mitra</h1>
                            <p style="color: var(--text-muted);">Kelola logo klien yang tampil di slider animasi halaman depan.</p>
                        </div>
                        <button class="btn-spa btn-spa-primary" style="padding: 0.8rem 1.5rem;" onclick="openModal('client-modal')"><i class="fas fa-plus me-2"></i> Tambah</button>
                    </header>
                    <div>${rows}</div>
                </div>
            `;
        }

        function renderGallery() {
            let rows = serverData.gallery.map(item => {
                let disabled = (item.is_active == 0) ? 'disabled' : '';
                return `
                <tr id="gal-${item.id}" class="${item.is_active == 0 ? 'inactive-row' : ''}">
                    <td data-label="Urutan">
                        <div class="order-control" style="border:none; padding:0;">
                            <input type="number" class="order-input" value="${item.display_order > 0 ? item.display_order : ''}" onchange="updateOrder(${item.id}, this.value, this)" ${disabled} style="border:1px solid #edf2f7; border-radius:8px; padding:5px;">
                        </div>
                    </td>
                    <td data-label="Preview"><img src="${item.image_path}" class="thumbnail-cms"></td>
                    <td data-label="Judul"><strong>${item.title}</strong></td>
                    <td data-label="Status">
                        <div class="d-flex align-items-center gap-2" style="display:flex; align-items:center; gap:10px;">
                            <div class="toggle-switch-spa ${item.is_active == 1 ? 'active' : ''}" onclick="toggleStatus(${item.id})">
                                <div class="toggle-dot"></div>
                            </div>
                            <span class="status-text fw-bold ${item.is_active == 1 ? 'text-success' : 'text-danger'}" style="font-size: 11px; font-weight:800; color: ${item.is_active == 1 ? '#10b981' : '#ef4444'};">${item.is_active == 1 ? 'AKTIF' : 'NON-AKTIF'}</span>
                        </div>
                    </td>
                    <td data-label="Aksi" class="text-end" style="text-align:right;">
                        <button onclick="deleteGallery(${item.id})" style="background: #fee2e2; border: none; padding: 10px; border-radius: 10px; cursor: pointer;"><i class="fas fa-trash text-danger" style="color:#ef4444;"></i></button>
                    </td>
                </tr>
            `;
            }).join('');

            return `
                <div class="view-content">
                    <header style="margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: flex-end;">
                        <div>
                            <h1 style="font-weight: 800; font-size: 2rem; margin-bottom: 0.5rem;">Gallery</h1>
                            <p style="color: var(--text-muted);">Kelola galeri kegiatan.</p>
                        </div>
                        <button class="btn-spa btn-spa-primary" style="padding: 0.8rem 1.5rem;" onclick="openModal('photo-modal')"><i class="fas fa-plus me-2"></i> Tambah Foto</button>
                    </header>
                    <div class="cms-table-container">
                        <table class="cms-table" style="width:100%; text-align:left;">
                            <thead>
                                <tr>
                                    <th style="width:80px;">Urutan</th>
                                    <th>Preview</th>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th style="text-align:right;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>${rows}</tbody>
                        </table>
                    </div>
                </div>
            `;
        }

        const viewsMap = {
            'dashboard': renderDashboard,
            'hero': renderHeroProfile,
            'visimisi': renderVisiMisi,
            'team': renderTeam,
            'clients': renderClients,
            'gallery': renderGallery
        };

        function navigate() {
            const hash = window.location.hash.substring(1) || 'dashboard';
            const appView = document.getElementById('app-view');
            
            if (viewsMap[hash]) {
                appView.innerHTML = viewsMap[hash]();
                attachFormListeners(hash);
            } else {
                appView.innerHTML = '<h2>View tidak ditemukan.</h2>';
            }

            document.querySelectorAll('.nav-link-spa, .bottom-link').forEach(link => {
                if (link.getAttribute('data-view') === hash) link.classList.add('active');
                else link.classList.remove('active');
            });
            window.scrollTo(0, 0);
        }

        // --- Event Listeners & AJAX Logic --- //

        function attachFormListeners(view) {
            if(view === 'hero') {
                document.getElementById('hero-form').addEventListener('submit', async (e) => {
                    e.preventDefault();
                    await submitForm(e.target, 'admin/hero/update', 'hero');
                });
                document.getElementById('settings-about-form').addEventListener('submit', async (e) => {
                    e.preventDefault();
                    await submitForm(e.target, 'admin/settings/update', 'settings');
                });
            }
            if(view === 'visimisi') {
                document.getElementById('settings-vision-form').addEventListener('submit', async (e) => {
                    e.preventDefault();
                    await submitForm(e.target, 'admin/settings/update', 'settings');
                });
            }
        }

        async function submitForm(form, endpoint, updateKey) {
            const btn = form.querySelector('button[type="submit"]');
            const ogText = btn.innerText;
            btn.innerText = 'Menyimpan...';
            btn.disabled = true;

            try {
                const formData = new FormData(form);
                const res = await fetch(baseUrl + endpoint, {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const result = await res.json();
                if(result.status === 'success') {
                    if(result[updateKey]) serverData[updateKey] = result[updateKey];
                    showToast(result.message, 'success');
                } else {
                    showToast('Gagal menyimpan', 'error');
                }
            } catch(e) {
                showToast('Koneksi bermasalah', 'error');
            } finally {
                btn.innerText = ogText;
                btn.disabled = false;
            }
        }

        // Generic AJAX Form submit for Modals
        function setupModalForm(formId, endpointBase, updateKey, modalId, idField = null) {
            const form = document.getElementById(formId);
            if(!form) return;
            form.onsubmit = async (e) => {
                e.preventDefault();
                const btn = form.querySelector('button[type="submit"]');
                const ogText = btn.innerText;
                btn.innerText = 'Menyimpan...';
                btn.disabled = true;

                try {
                    const formData = new FormData(form);
                    let url = baseUrl + endpointBase;
                    if(idField) {
                        const id = document.getElementById(idField).value;
                        url += id;
                    }

                    const res = await fetch(url, {
                        method: 'POST',
                        body: formData,
                        headers: { 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    const result = await res.json();
                    if(result.status === 'success') {
                        if(result[updateKey]) serverData[updateKey] = result[updateKey];
                        showToast(result.message || 'Berhasil', 'success');
                        closeModal(modalId);
                        form.reset();
                        if(modalId === 'photo-modal') {
                            document.getElementById('image-preview').style.display = 'none';
                            document.getElementById('upload-instruction').style.display = 'block';
                        }
                        navigate(); // Re-render
                    } else {
                        showToast(result.message || 'Terjadi kesalahan', 'error');
                    }
                } catch(err) {
                    showToast('Koneksi bermasalah', 'error');
                } finally {
                    btn.innerText = ogText;
                    btn.disabled = false;
                }
            };
        }

        setupModalForm('add-mission-form', 'admin/mission/add', 'missions', 'mission-modal');
        setupModalForm('edit-mission-form', 'admin/mission/update/', 'missions', 'edit-mission-modal', 'edit-mission-id');
        setupModalForm('add-team-form', 'admin/team/add', 'team', 'team-modal');
        setupModalForm('edit-team-form', 'admin/team/update/', 'team', 'edit-team-modal', 'edit-team-id');
        setupModalForm('add-client-form', 'admin/client/add', 'clients', 'client-modal');
        setupModalForm('edit-client-form', 'admin/client/update/', 'clients', 'edit-client-modal', 'edit-client-id');
        setupModalForm('add-photo-form', 'admin/gallery/add', 'gallery', 'photo-modal');

        function openEditMission(id) {
            const m = serverData.missions.find(x => x.id == id);
            document.getElementById('edit-mission-id').value = m.id;
            document.getElementById('edit-mission-title').value = m.title;
            document.getElementById('edit-mission-desc').value = m.description;
            openModal('edit-mission-modal');
        }

        function openEditTeam(id) {
            const t = serverData.team.find(x => x.id == id);
            document.getElementById('edit-team-id').value = t.id;
            document.getElementById('edit-team-name').value = t.name;
            document.getElementById('edit-team-position').value = t.position;
            openModal('edit-team-modal');
        }

        function openEditClient(id) {
            const c = serverData.clients.find(x => x.id == id);
            document.getElementById('edit-client-id').value = c.id;
            document.getElementById('edit-client-name').value = c.name;
            openModal('edit-client-modal');
        }

        async function deleteMission(id) {
            if(!confirm('Hapus misi ini?')) return;
            const res = await fetch(baseUrl + 'admin/mission/delete/' + id, {method: 'POST'});
            const data = await res.json();
            if(data.status === 'success') {
                serverData.missions = data.missions;
                showToast('Misi dihapus', 'success');
                navigate();
            }
        }

        async function deleteTeam(id) {
            if(!confirm('Hapus anggota tim?')) return;
            const res = await fetch(baseUrl + 'admin/team/delete/' + id, {method: 'POST'});
            const data = await res.json();
            if(data.status === 'success') {
                serverData.team = data.team;
                showToast('Anggota dihapus', 'success');
                navigate();
            }
        }

        async function deleteClient(id) {
            if(!confirm('Hapus klien ini?')) return;
            const res = await fetch(baseUrl + 'admin/client/delete/' + id, {method: 'POST'});
            const data = await res.json();
            if(data.status === 'success') {
                serverData.clients = data.clients;
                showToast('Klien dihapus', 'success');
                navigate();
            }
        }

        async function deleteGallery(id) {
            if(!confirm('Hapus foto ini?')) return;
            const res = await fetch(baseUrl + 'admin/gallery/delete/' + id, {method: 'POST'});
            const data = await res.json();
            if(data.status === 'success') {
                serverData.gallery = data.gallery;
                showToast('Foto dihapus', 'success');
                navigate();
            }
        }

        async function toggleStatus(id) {
            const res = await fetch(baseUrl + 'admin/gallery/toggle/' + id, {method: 'POST'});
            const data = await res.json();
            if(data.status === 'success') {
                serverData.gallery = data.gallery;
                showToast('Status diperbarui', 'success');
                navigate();
            }
        }

        async function toggleClientStatus(id) {
            const res = await fetch(baseUrl + 'admin/client/toggle/' + id, {method: 'POST'});
            const data = await res.json();
            if(data.status === 'success') {
                serverData.clients = data.clients;
                showToast('Status klien diperbarui', 'success');
                navigate();
            }
        }

        async function updateOrder(id, order, inputElement) {
            const formData = new FormData();
            formData.append('id', id);
            formData.append('order', order);
            const res = await fetch(baseUrl + 'admin/gallery/update-order', {method: 'POST', body: formData});
            const data = await res.json();
            if(data.status === 'success') {
                serverData.gallery = data.gallery;
                showToast('Urutan disimpan', 'success');
                navigate();
            } else {
                showToast(data.message, 'error');
                navigate(); // reset view
            }
        }

        function openModal(id) { 
            document.getElementById(id).classList.add('active'); 
            document.body.style.overflow = 'hidden';
        }
        function closeModal(id) { 
            document.getElementById(id).classList.remove('active'); 
            document.body.style.overflow = '';
        }

        document.querySelectorAll('.modal-overlay-spa').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) closeModal(this.id);
            });
        });

        function previewImage(event, previewId, instId) {
            const input = event.target;
            const preview = document.getElementById(previewId);
            const instruction = document.getElementById(instId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    if(instruction) instruction.style.display = 'none';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        window.addEventListener('hashchange', navigate);
        window.addEventListener('load', navigate);
    </script>
<?= $this->endSection() ?>
