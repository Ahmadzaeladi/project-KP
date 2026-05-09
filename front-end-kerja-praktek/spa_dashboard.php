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
                <a href="#gallery" class="nav-link-spa" data-view="gallery">
                    <i class="fas fa-images"></i> Visual Archive
                </a>
                <a href="<?= base_url('logout') ?>" class="nav-link-spa text-danger">
                    <i class="fas fa-sign-out-alt"></i> Keluar
                </a>
            </nav>
        </aside>

        <!-- Main Content Area (SPA Logic) -->
        <main class="main-view" id="app-view">
            <!-- Content will be injected by JS via PHP Data -->
            <div class="view-content">
                <h2>Memuat Dashboard CI4...</h2>
            </div>
        </main>
    </div>

    <!-- Modal Popup (Bottom Sheet) -->
    <div class="modal-overlay-spa" id="photo-modal">
        <div class="modal-content-spa">
            <div class="drag-handle-mobile"></div>
            <div class="modal-header-spa">
                <h2 style="font-weight: 800; margin: 0;">Tambah Arsip</h2>
                <button onclick="closeModal()" class="close-btn-spa"><i class="fas fa-times"></i></button>
            </div>
            
            <!-- CSRF Protection via CodeIgniter Form Helper -->
            <?= form_open_multipart('admin/gallery/add', ['id' => 'add-photo-form', 'style' => 'display: grid; gap: 20px;']) ?>
                <div>
                    <label class="form-label-spa">Judul Kegiatan</label>
                    <input type="text" name="title" class="input-spa" placeholder="Contoh: Workshop Internal" required>
                </div>
                <div>
                    <label class="form-label-spa">Dokumentasi Foto</label>
                    <div class="file-upload-zone" onclick="document.getElementById('file-input').click()">
                        <input type="file" name="photo" id="file-input" style="display: none;" accept="image/*">
                        <i class="fas fa-cloud-arrow-up fs-1 text-muted mb-3"></i>
                        <h5 style="margin-bottom: 0.5rem; font-weight: 700;">Pilih Foto</h5>
                        <p class="small text-muted mb-0">Format JPG, PNG (Max 5MB)</p>
                    </div>
                </div>
                <div style="margin-top: 1rem;">
                    <button type="submit" class="btn-spa btn-spa-primary" style="width: 100%;">Simpan ke Database</button>
                </div>
            <?= form_close() ?>
        </div>
    </div>

    <!-- Inject PHP Data to JS for SPA -->
    <script>
        const initialGalleryData = <?= json_encode($gallery) ?>;
        
        // Logic JS untuk merender view gallery dari data PHP
        function renderGalleryView() {
            let rows = initialGalleryData.map((item, index) => `
                <tr id="gal-${item.id}" class="${item.is_active == 0 ? 'inactive-row' : ''}">
                    <td data-label="Urutan">
                        <div class="order-control">
                            <input type="number" class="order-input" value="${item.display_order}" onchange="updateOrder(${item.id}, this.value)">
                        </div>
                    </td>
                    <td data-label="Preview"><img src="<?= base_url() ?>/${item.image_path}" class="thumbnail-cms"></td>
                    <td data-label="Judul"><strong>${item.title}</strong></td>
                    <td data-label="Status">
                        <div class="toggle-switch-spa ${item.is_active == 1 ? 'active' : ''}" onclick="toggleStatus(${item.id})">
                            <div class="toggle-dot"></div>
                        </div>
                    </td>
                    <td data-label="Aksi" class="text-end">
                        <button onclick="deleteItem(${item.id})" class="btn-delete"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `).join('');

            return `
                <div class="view-content">
                    <header class="view-header">
                        <h1>Arsip Visual</h1>
                        <button class="btn-spa btn-spa-primary" onclick="openModal()">+ Tambah Foto</button>
                    </header>
                    <div class="cms-table-container">
                        <table class="cms-table">
                            <thead>
                                <tr><th>Urutan</th><th>Preview</th><th>Judul</th><th>Status</th><th class="text-end">Aksi</th></tr>
                            </thead>
                            <tbody>${rows}</tbody>
                        </table>
                    </div>
                </div>
            `;
        }

        // Fungsi AJAX untuk Toggle Status ke Backend CI4
        async function toggleStatus(id) {
            const response = await fetch(`<?= base_url('admin/gallery/toggle') ?>/${id}`, {
                method: 'POST',
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });
            const result = await response.json();
            if(result.status === 'success') {
                location.reload(); // Sederhananya reload untuk sync data
            }
        }
    </script>
<?= $this->endSection() ?>
