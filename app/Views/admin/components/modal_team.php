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
