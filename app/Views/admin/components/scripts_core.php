        // --- Camera & Upload Logic --- //
        let videoStream = null;

        function triggerUpload(type, prefix = '') {
            const input = document.getElementById(prefix + 'file-input');
            if (type === 'file') {
                document.getElementById(prefix + 'photo-base64').value = '';
                input.click();
            }
        }

        async function startCamera(prefix = '') {
            document.getElementById(prefix + 'upload-zone').style.display = 'none';
            document.getElementById(prefix + 'camera-container').style.display = 'block';
            const video = document.getElementById(prefix + 'camera-stream');
            try {
                videoStream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment' } });
                video.srcObject = videoStream;
            } catch (err) {
                alert("Tidak dapat mengakses kamera: " + err.message);
                stopCamera(prefix);
            }
        }

        function stopCamera(prefix = '') {
            if (videoStream) {
                videoStream.getTracks().forEach(track => track.stop());
                videoStream = null;
            }
            document.getElementById(prefix + 'camera-container').style.display = 'none';
            document.getElementById(prefix + 'upload-zone').style.display = 'block';
        }

        function snapPhoto(prefix = '') {
            const video = document.getElementById(prefix + 'camera-stream');
            const canvas = document.getElementById(prefix + 'camera-canvas');
            const ctx = canvas.getContext('2d');
            
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            
            const dataURL = canvas.toDataURL('image/jpeg', 0.8);
            document.getElementById(prefix + 'photo-base64').value = dataURL;
            document.getElementById(prefix + 'file-input').value = ''; // clear file input
            
            // show preview
            const preview = document.getElementById(prefix + 'image-preview');
            preview.src = dataURL;
            preview.style.display = 'block';
            document.getElementById(prefix + 'upload-instruction').style.display = 'none';
            
            stopCamera(prefix);
        }

        function filterAdminGallery() {
            const searchTxt = (document.getElementById('adminGallerySearch') ? document.getElementById('adminGallerySearch').value.toLowerCase() : '');
            const pekanVal = document.getElementById('adminFilterPekan') ? document.getElementById('adminFilterPekan').value : '';
            const bulanVal = document.getElementById('adminFilterBulan') ? document.getElementById('adminFilterBulan').value : '';
            const tahunVal = document.getElementById('adminFilterTahun') ? document.getElementById('adminFilterTahun').value : '';

            const cards = document.querySelectorAll('.admin-gallery-card');
            cards.forEach(card => {
                const title = card.getAttribute('data-title');
                const week = card.getAttribute('data-week');
                const month = card.getAttribute('data-month');
                const year = card.getAttribute('data-year');

                const matchSearch = title.includes(searchTxt);
                const matchPekan = (pekanVal === '') || (pekanVal === week);
                const matchBulan = (bulanVal === '') || (bulanVal === month);
                const matchTahun = (tahunVal === '') || (tahunVal === year);

                if (matchSearch && matchPekan && matchBulan && matchTahun) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
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
                        } else if (modalId === 'edit-photo-modal') {
                            document.getElementById('edit-image-preview').style.display = 'none';
                            document.getElementById('edit-upload-instruction').style.display = 'block';
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
        setupModalForm('edit-photo-form', 'admin/gallery/update/', 'gallery', 'edit-photo-modal', 'edit-photo-id');

        function openEditGallery(id) {
            const g = serverData.gallery.find(x => x.id == id);
            document.getElementById('edit-photo-id').value = g.id;
            document.getElementById('edit-photo-title').value = g.title;
            document.getElementById('edit-photo-caption').value = g.subtitle;
            if(g.published_at) {
                document.getElementById('edit-photo-tanggal').value = g.published_at.substring(0, 10);
            }
            openModal('edit-photo-modal');
        }

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
