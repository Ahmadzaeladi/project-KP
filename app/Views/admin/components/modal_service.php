        <!-- Service Modal (Add) -->
        <div class="modal-overlay-spa" id="service-modal">
            <div class="modal-content-spa">
                <div class="drag-handle-mobile"></div>
                <div class="modal-header-spa">
                    <h2 style="font-weight: 800; margin: 0;">Tambah Layanan</h2>
                    <button type="button" onclick="closeModal('service-modal')" style="background: #f1f5f9; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer;"><i class="fas fa-times"></i></button>
                </div>
                <form id="add-service-form" style="display: grid; gap: 20px;">
                    <div>
                        <label class="form-label-spa">Judul Layanan</label>
                        <input type="text" name="title" class="input-spa" required>
                    </div>
                    <div>
                        <label class="form-label-spa">Deskripsi</label>
                        <textarea name="description" class="input-spa" rows="4" required></textarea>
                    </div>
                    <div style="margin-top: 1rem;">
                        <button type="submit" class="btn-spa btn-spa-primary" style="width: 100%;">Simpan Layanan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Service Modal (Edit) -->
        <div class="modal-overlay-spa" id="edit-service-modal">
            <div class="modal-content-spa">
                <div class="drag-handle-mobile"></div>
                <div class="modal-header-spa">
                    <h2 style="font-weight: 800; margin: 0;">Edit Layanan</h2>
                    <button type="button" onclick="closeModal('edit-service-modal')" style="background: #f1f5f9; border: none; width: 40px; height: 40px; border-radius: 50%; cursor: pointer;"><i class="fas fa-times"></i></button>
                </div>
                <form id="edit-service-form" style="display: grid; gap: 20px;">
                    <input type="hidden" id="edit-service-id">
                    <div>
                        <label class="form-label-spa">Judul Layanan</label>
                        <input type="text" name="title" id="edit-service-title" class="input-spa" required>
                    </div>
                    <div>
                        <label class="form-label-spa">Deskripsi</label>
                        <textarea name="description" id="edit-service-desc" class="input-spa" rows="4" required></textarea>
                    </div>
                    <div style="margin-top: 1rem;">
                        <button type="submit" class="btn-spa btn-spa-primary" style="width: 100%;">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
