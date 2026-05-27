<script>
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
                            <!-- <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                <div>
                                    <label class="form-label-spa">Primary CTA</label>
                                    <input type="text" name="primary_cta_text" class="input-spa" value="${h.primary_cta_text || ''}">
                                </div>
                                <div>
                                    <label class="form-label-spa">Secondary CTA</label>
                                    <input type="text" name="secondary_cta_text" class="input-spa" value="${h.secondary_cta_text || ''}">
                                </div>
                            </div> -->
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
                            <!-- <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                <div>
                                    <label class="form-label-spa">Statistik Pengalaman</label>
                                    <input type="text" name="stat_experience" class="input-spa" value="${s.stat_experience || ''}">
                                </div>
                                <div>
                                    <label class="form-label-spa">Statistik Mitra</label>
                                    <input type="text" name="stat_partners" class="input-spa" value="${s.stat_partners || ''}">
                                </div>
                            </div> -->
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
            let years = new Set();
            serverData.gallery.forEach(item => {
                if(item.published_at) {
                    let d = new Date(item.published_at.replace(' ', 'T'));
                    if(!isNaN(d.getFullYear())) {
                        years.add(d.getFullYear());
                    }
                }
            });
            let yearsArr = Array.from(years).sort((a,b) => b-a);
            if(yearsArr.length === 0) yearsArr = [new Date().getFullYear()];
            
            let yearOptions = yearsArr.map(y => `<option value="${y}">${y}</option>`).join('');

            let rows = serverData.gallery.map(item => {
                let disabled = (item.is_active == 0) ? 'disabled' : '';
                let titleSafe = item.title ? item.title.replace(/"/g, '&quot;') : '';
                let subtitleSafe = item.subtitle ? item.subtitle.replace(/"/g, '&quot;') : '';
                let combinedTitle = (titleSafe + ' ' + subtitleSafe).toLowerCase();
                
                let dateStr = '';
                let week = '';
                let month = '';
                let year = '';
                if(item.published_at) {
                    // Fix Safari/iOS date parsing by using T instead of space
                    let d = new Date(item.published_at.replace(' ', 'T'));
                    if(!isNaN(d.getTime())) {
                        const monthsIndo = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                        dateStr = `${d.getDate()} ${monthsIndo[d.getMonth()]} ${d.getFullYear()}`;
                        year = d.getFullYear().toString();
                        month = (d.getMonth() + 1).toString();
                        week = Math.ceil(d.getDate() / 7).toString();
                    }
                }

                return `
                <div class="admin-gallery-card card-spa ${item.is_active == 0 ? 'inactive-row' : ''}" style="padding: 1rem; display: flex; flex-direction: column; gap: 10px; width: 100%; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 15px; transition: transform 0.2s;" data-title="${combinedTitle}" data-week="${week}" data-month="${month}" data-year="${year}">
                    <div style="display:flex; gap: 15px; align-items:flex-start;">
                        <img src="${item.image_path}" style="width:120px; height:100px; object-fit:cover; border-radius:8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        <div style="flex-grow:1; display: flex; flex-direction: column; justify-content: space-between; height: 100px;">
                            <div>
                                <h5 style="margin: 0; font-weight: 700; font-size: 1.1rem; line-height: 1.2;">${item.title}</h5>
                                <p style="margin: 5px 0 0; font-size: 0.85rem; color: var(--text-muted); line-height: 1.4; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">${item.subtitle || '-'}</p>
                            </div>
                            <p style="margin: 0; font-size: 0.8rem; color: var(--primary-color); font-weight:600;"><i class="far fa-calendar-alt"></i> ${dateStr || '-'}</p>
                        </div>
                    </div>
                    
                    <div style="display:flex; justify-content:space-between; align-items:center; border-top: 1px solid #e2e8f0; padding-top: 10px; margin-top: auto;">
                        <div style="display:flex; align-items:center; gap: 10px;">
                            <label style="font-size: 0.8rem; font-weight: 600;">Urutan:</label>
                            <input type="number" class="order-input" value="${item.display_order > 0 ? item.display_order : ''}" onchange="updateOrder(${item.id}, this.value, this)" ${disabled} style="border:1px solid #edf2f7; border-radius:8px; padding:5px; width: 60px; text-align: center;">
                        </div>
                        <div style="display:flex; align-items:center; gap: 15px;">
                            <div class="d-flex align-items-center gap-2" style="display:flex; align-items:center; gap:5px;">
                                <div class="toggle-switch-spa ${item.is_active == 1 ? 'active' : ''}" onclick="toggleStatus(${item.id})">
                                    <div class="toggle-dot"></div>
                                </div>
                                <span class="status-text fw-bold ${item.is_active == 1 ? 'text-success' : 'text-danger'}" style="font-size: 10px; font-weight:800; color: ${item.is_active == 1 ? '#10b981' : '#ef4444'};">${item.is_active == 1 ? 'AKTIF' : 'NON-AKTIF'}</span>
                            </div>
                            <button onclick="openEditGallery(${item.id})" style="background: #e0f2fe; border: none; padding: 8px 12px; border-radius: 8px; cursor: pointer;"><i class="fas fa-edit text-primary" style="color: #0ea5e9;"></i></button>
                            <button onclick="deleteGallery(${item.id})" style="background: #fee2e2; border: none; padding: 8px 12px; border-radius: 8px; cursor: pointer;"><i class="fas fa-trash text-danger" style="color:#ef4444;"></i></button>
                        </div>
                    </div>
                </div>
                `;
            }).join('');

            return `
                <div class="view-content">
                    <header style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: flex-end;">
                        <div>
                            <h1 style="font-weight: 800; font-size: 2rem; margin-bottom: 0.5rem;">Gallery</h1>
                            <p style="color: var(--text-muted);">Kelola galeri kegiatan.</p>
                        </div>
                        <button class="btn-spa btn-spa-primary" style="padding: 0.8rem 1.5rem;" onclick="openModal('photo-modal')"><i class="fas fa-plus me-2"></i> Tambah Foto</button>
                    </header>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-bottom: 20px; background: white; padding: 15px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px rgba(0,0,0,0.02);">
                        <div>
                            <label style="font-size:0.8rem; font-weight:600; color:var(--text-muted); display:block; margin-bottom: 5px;">Pencarian Judul</label>
                            <input type="text" id="adminGallerySearch" class="input-spa" placeholder="Cari foto..." onkeyup="filterAdminGallery()" style="padding: 8px 12px; width: 100%; box-sizing: border-box;">
                        </div>
                        <div>
                            <label style="font-size:0.8rem; font-weight:600; color:var(--text-muted); display:block; margin-bottom: 5px;">Filter Pekan</label>
                            <select id="adminFilterPekan" class="input-spa" onchange="filterAdminGallery()" style="padding: 8px 12px; width: 100%; box-sizing: border-box;">
                                <option value="">Semua Pekan</option>
                                <option value="1">Pekan 1</option>
                                <option value="2">Pekan 2</option>
                                <option value="3">Pekan 3</option>
                                <option value="4">Pekan 4</option>
                                <option value="5">Pekan 5</option>
                            </select>
                        </div>
                        <div>
                            <label style="font-size:0.8rem; font-weight:600; color:var(--text-muted); display:block; margin-bottom: 5px;">Filter Bulan</label>
                            <select id="adminFilterBulan" class="input-spa" onchange="filterAdminGallery()" style="padding: 8px 12px; width: 100%; box-sizing: border-box;">
                                <option value="">Semua Bulan</option>
                                <option value="1">Januari</option>
                                <option value="2">Februari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Agustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div>
                            <label style="font-size:0.8rem; font-weight:600; color:var(--text-muted); display:block; margin-bottom: 5px;">Filter Tahun</label>
                            <select id="adminFilterTahun" class="input-spa" onchange="filterAdminGallery()" style="padding: 8px 12px; width: 100%; box-sizing: border-box;">
                                <option value="">Semua Tahun</option>
                                ${yearOptions}
                            </select>
                        </div>
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 15px;" id="adminGalleryContainer">
                        ${rows || '<p class="text-muted" style="text-align:center; padding: 2rem;">Belum ada arsip foto.</p>'}
                    </div>
                </div>
            `;
        }

        function renderServices() {
            let rows = serverData.services.map(s => `
                <div class="card-spa" style="padding: 1.2rem; display: flex; align-items: flex-start; gap: 20px; margin-bottom:15px; opacity: ${s.is_active == 1 ? '1' : '0.5'}">
                    <div style="flex-grow:1;">
                        <h5 style="margin: 0; font-weight: 700;">${s.title}</h5>
                        <p style="margin: 5px 0 0; font-size: 0.85rem; color: var(--text-muted);">${s.description}</p>
                    </div>
                    <div style="display:flex; gap: 10px; align-items: center;">
                        <button onclick="openEditService(${s.id})" style="background: #e0f2fe; border: none; padding: 10px; border-radius: 10px; cursor: pointer;"><i class="fas fa-edit text-primary" style="color: #0ea5e9;"></i></button>
                        <button onclick="deleteService(${s.id})" style="background: #fee2e2; border: none; padding: 10px; border-radius: 10px; cursor: pointer;"><i class="fas fa-trash text-danger" style="color:#ef4444;"></i></button>
                    </div>
                </div>
            `).join('');

            if(rows === '') rows = '<p class="text-muted">Belum ada layanan yang ditambahkan.</p>';

            return `
                <div class="view-content">
                    <header style="margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: flex-end;">
                        <div>
                            <h1 style="font-weight: 800; font-size: 2rem; margin-bottom: 0.5rem;">Layanan Kami</h1>
                            <p style="color: var(--text-muted);">Kelola layanan perusahaan.</p>
                        </div>
                        <button class="btn-spa btn-spa-primary" style="padding: 0.8rem 1.5rem;" onclick="openModal('service-modal')"><i class="fas fa-plus me-2"></i> Tambah</button>
                    </header>
                    <div>${rows}</div>
                </div>
            `;
        }

        function renderCertifications() {
            let rows = serverData.certifications.map(c => `
                <div class="card-spa" style="padding: 1.2rem; display: flex; align-items: center; gap: 20px; margin-bottom:15px; opacity: ${c.is_active == 1 ? '1' : '0.5'}">
                    <img src="${c.logo_path}" style="width:80px; height:50px; object-fit:contain;">
                    <div style="flex-grow:1;">
                        <h5 style="margin: 0; font-weight: 700;">${c.name}</h5>
                    </div>
                    <div style="display:flex; gap: 10px; align-items: center;">
                        <button onclick="openEditCertification(${c.id})" style="background: #e0f2fe; border: none; padding: 10px; border-radius: 10px; cursor: pointer;"><i class="fas fa-edit text-primary" style="color: #0ea5e9;"></i></button>
                        <button onclick="deleteCertification(${c.id})" style="background: #fee2e2; border: none; padding: 10px; border-radius: 10px; cursor: pointer;"><i class="fas fa-trash text-danger" style="color:#ef4444;"></i></button>
                    </div>
                </div>
            `).join('');

            if(rows === '') rows = '<p class="text-muted">Belum ada sertifikasi.</p>';

            return `
                <div class="view-content">
                    <header style="margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: flex-end;">
                        <div>
                            <h1 style="font-weight: 800; font-size: 2rem; margin-bottom: 0.5rem;">Sertifikasi & Mitra Terdaftar</h1>
                            <p style="color: var(--text-muted);">Kelola logo sertifikasi/kementrian yang mendukung perusahaan.</p>
                        </div>
                        <button class="btn-spa btn-spa-primary" style="padding: 0.8rem 1.5rem;" onclick="openModal('certification-modal')"><i class="fas fa-plus me-2"></i> Tambah</button>
                    </header>
                    <div>${rows}</div>
                </div>
            `;
        }
</script>
