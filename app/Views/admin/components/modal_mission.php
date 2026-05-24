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
                        <label class="form-label-spa">Judul Misi (Opsional)</label>
                        <input type="text" name="title" class="input-spa">
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
                        <label class="form-label-spa">Judul Misi (Opsional)</label>
                        <input type="text" name="title" id="edit-mission-title" class="input-spa">
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
