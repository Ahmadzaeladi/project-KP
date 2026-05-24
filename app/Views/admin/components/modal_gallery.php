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
                        <label class="form-label-spa">Caption / Deskripsi Singkat</label>
                        <textarea name="caption" class="input-spa" rows="2" placeholder="Deskripsi kegiatan..."></textarea>
                    </div>
                    <div>
                        <label class="form-label-spa">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal_kegiatan" class="input-spa" required>
                    </div>
                    <div>
                        <label class="form-label-spa">Dokumentasi Foto</label>
                        <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                            <button type="button" class="btn-spa" onclick="startCamera()" style="flex:1; background: #e2e8f0; border:none; padding: 10px; border-radius: 8px; font-weight: 600; cursor: pointer;"><i class="fas fa-camera" style="margin-right: 5px;"></i> Web Kamera</button>
                            <button type="button" class="btn-spa" onclick="triggerUpload('file')" style="flex:1; background: #e2e8f0; border:none; padding: 10px; border-radius: 8px; font-weight: 600; cursor: pointer;"><i class="fas fa-folder-open" style="margin-right: 5px;"></i> File Browser</button>
                        </div>
                        
                        <!-- Camera Area -->
                        <div id="camera-container" style="display: none; text-align: center; margin-bottom: 15px;">
                            <video id="camera-stream" autoplay playsinline style="width: 100%; max-width: 400px; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 10px;"></video>
                            <br>
                            <button type="button" onclick="snapPhoto()" class="btn-spa btn-spa-primary" style="padding: 10px 20px;"><i class="fas fa-camera"></i> Ambil Foto</button>
                            <button type="button" onclick="stopCamera()" class="btn-spa" style="background: #fee2e2; color: #ef4444; border:none; padding: 10px 20px;"><i class="fas fa-times"></i> Tutup Kamera</button>
                        </div>
                        
                        <input type="hidden" name="photo_base64" id="photo-base64">
                        <canvas id="camera-canvas" style="display: none;"></canvas>

                        <div class="file-upload-zone" id="upload-zone" onclick="triggerUpload('file')">
                            <input type="file" name="photo" id="file-input" style="display: none;" accept="image/*" onchange="previewImage(event, 'image-preview', 'upload-instruction')">
                            <div id="upload-instruction">
                                <i class="fas fa-cloud-arrow-up fs-1 text-muted mb-3" style="font-size:2rem;"></i>
                                <h5 style="margin-bottom: 0.5rem; font-weight: 700;">Pilih Foto atau Gunakan Kamera</h5>
                                <p class="small text-muted mb-0">Klik area ini untuk file browser</p>
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

        <!-- Gallery Modal (Edit) -->
        <div class="modal-overlay-spa" id="edit-photo-modal">
            <div class="modal-content-spa">
                <div class="drag-handle-mobile"></div>
                <div class="modal-header-spa">
                    <h2 style="font-weight: 800; margin: 0;">Edit Arsip Visual</h2>
                    <button type="button" onclick="closeModal('edit-photo-modal')" style="background: #f1f5f9; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer;"><i class="fas fa-times"></i></button>
                </div>
                <?= form_open_multipart('admin/gallery/update', ['id' => 'edit-photo-form', 'style' => 'display: grid; gap: 20px;']) ?>
                    <input type="hidden" id="edit-photo-id">
                    <div>
                        <label class="form-label-spa">Judul Kegiatan</label>
                        <input type="text" name="title" id="edit-photo-title" class="input-spa" required>
                    </div>
                    <div>
                        <label class="form-label-spa">Caption / Deskripsi Singkat</label>
                        <textarea name="caption" id="edit-photo-caption" class="input-spa" rows="2"></textarea>
                    </div>
                    <div>
                        <label class="form-label-spa">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal_kegiatan" id="edit-photo-tanggal" class="input-spa">
                        <small class="text-muted">Biarkan kosong jika tidak diubah.</small>
                    </div>
                    <div>
                        <label class="form-label-spa">Ganti Foto (Opsional)</label>
                        <div style="display: flex; gap: 10px; margin-bottom: 15px;">
                            <button type="button" class="btn-spa" onclick="startCamera('edit-')" style="flex:1; background: #e2e8f0; border:none; padding: 10px; border-radius: 8px; font-weight: 600; cursor: pointer;"><i class="fas fa-camera" style="margin-right: 5px;"></i> Web Kamera</button>
                            <button type="button" class="btn-spa" onclick="triggerUpload('file', 'edit-')" style="flex:1; background: #e2e8f0; border:none; padding: 10px; border-radius: 8px; font-weight: 600; cursor: pointer;"><i class="fas fa-folder-open" style="margin-right: 5px;"></i> File Browser</button>
                        </div>
                        
                        <!-- Camera Area -->
                        <div id="edit-camera-container" style="display: none; text-align: center; margin-bottom: 15px;">
                            <video id="edit-camera-stream" autoplay playsinline style="width: 100%; max-width: 400px; border-radius: 8px; border: 2px solid #e2e8f0; margin-bottom: 10px;"></video>
                            <br>
                            <button type="button" onclick="snapPhoto('edit-')" class="btn-spa btn-spa-primary" style="padding: 10px 20px;"><i class="fas fa-camera"></i> Ambil Foto</button>
                            <button type="button" onclick="stopCamera('edit-')" class="btn-spa" style="background: #fee2e2; color: #ef4444; border:none; padding: 10px 20px;"><i class="fas fa-times"></i> Tutup Kamera</button>
                        </div>
                        
                        <input type="hidden" name="photo_base64" id="edit-photo-base64">
                        <canvas id="edit-camera-canvas" style="display: none;"></canvas>

                        <div class="file-upload-zone" id="edit-upload-zone" onclick="triggerUpload('file', 'edit-')">
                            <input type="file" name="photo" id="edit-file-input" style="display: none;" accept="image/*" onchange="previewImage(event, 'edit-image-preview', 'edit-upload-instruction')">
                            <div id="edit-upload-instruction">
                                <i class="fas fa-cloud-arrow-up fs-1 text-muted mb-3" style="font-size:2rem;"></i>
                                <h5 style="margin-bottom: 0.5rem; font-weight: 700;">Pilih Foto atau Gunakan Kamera</h5>
                                <p class="small text-muted mb-0">Klik area ini untuk file browser</p>
                            </div>
                            <img id="edit-image-preview" src="#" alt="Preview" style="display: none; max-width: 100%; max-height: 200px; object-fit: contain; margin: 0 auto; border-radius: 8px;">
                        </div>
                        <small class="text-muted" style="display: block; margin-top: 5px;">Abaikan jika tidak ingin mengubah gambar.</small>
                    </div>
                    <div style="margin-top: 1rem;">
                        <button type="submit" class="btn-spa btn-spa-primary" style="width: 100%;">Simpan Perubahan</button>
                    </div>
                <?= form_close() ?>
            </div>
        </div>
