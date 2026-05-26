        <!-- Certification Modal (Add) -->
        <div class="modal-overlay-spa" id="certification-modal">
            <div class="modal-content-spa">
                <div class="drag-handle-mobile"></div>
                <div class="modal-header-spa">
                    <h2 style="font-weight: 800; margin: 0;">Tambah Sertifikasi</h2>
                    <button type="button" onclick="closeModal('certification-modal')" style="background: #f1f5f9; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer;"><i class="fas fa-times"></i></button>
                </div>
                <form id="add-certification-form" style="display: grid; gap: 20px;" enctype="multipart/form-data">
                    <div>
                        <label class="form-label-spa">Nama Sertifikasi / Instansi</label>
                        <input type="text" name="name" class="input-spa" required>
                    </div>
                    <div>
                        <label class="form-label-spa">Logo Sertifikasi</label>
                        <input type="file" name="photo" class="input-spa" accept="image/*" required>
                    </div>
                    <div style="margin-top: 1rem;">
                        <button type="submit" class="btn-spa btn-spa-primary" style="width: 100%;">Simpan Sertifikasi</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Certification Modal (Edit) -->
        <div class="modal-overlay-spa" id="edit-certification-modal">
            <div class="modal-content-spa">
                <div class="drag-handle-mobile"></div>
                <div class="modal-header-spa">
                    <h2 style="font-weight: 800; margin: 0;">Edit Sertifikasi</h2>
                    <button type="button" onclick="closeModal('edit-certification-modal')" style="background: #f1f5f9; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer;"><i class="fas fa-times"></i></button>
                </div>
                <form id="edit-certification-form" style="display: grid; gap: 20px;" enctype="multipart/form-data">
                    <input type="hidden" id="edit-certification-id">
                    <div>
                        <label class="form-label-spa">Nama Sertifikasi / Instansi</label>
                        <input type="text" name="name" id="edit-certification-name" class="input-spa" required>
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
