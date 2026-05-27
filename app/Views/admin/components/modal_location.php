<!-- Modal Add Location -->
<div class="modal-overlay-spa" id="location-modal">
    <div class="modal-content-spa" style="max-width: 600px;">
        <div class="modal-header-spa">
            <h3 style="margin:0; font-weight:800;">Tambah Lokasi Kantor</h3>
            <button class="modal-close-spa" onclick="closeModal('location-modal')"><i class="fas fa-times"></i></button>
        </div>
        <form id="add-location-form" style="display: flex; flex-direction: column; gap: 15px; margin-top: 20px;">
            <div>
                <label class="form-label-spa">Nama Kantor Cabang</label>
                <input type="text" name="name" class="input-spa" required>
            </div>
            <div>
                <label class="form-label-spa">Alamat Lengkap</label>
                <textarea name="address" class="input-spa" rows="3" required></textarea>
            </div>
            <div style="margin-bottom: 10px;">
                <label class="form-label-spa">Pilih Lokasi di Peta</label>
                <div id="add-location-map" style="height: 300px; width: 100%; border-radius: 8px; z-index: 1;"></div>
                <small class="text-muted">Klik pada peta untuk menentukan koordinat.</small>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div>
                    <label class="form-label-spa">Latitude</label>
                    <input type="text" id="add-lat" name="latitude" class="input-spa" required style="width: 100%; box-sizing: border-box;">
                </div>
                <div>
                    <label class="form-label-spa">Longitude</label>
                    <input type="text" id="add-lng" name="longitude" class="input-spa" required style="width: 100%; box-sizing: border-box;">
                </div>
            </div>
            <button type="submit" class="btn-spa btn-spa-primary" style="margin-top: 10px;">Simpan Lokasi</button>
        </form>
    </div>
</div>

<!-- Modal Edit Location -->
<div class="modal-overlay-spa" id="edit-location-modal">
    <div class="modal-content-spa" style="max-width: 600px;">
        <div class="modal-header-spa">
            <h3 style="margin:0; font-weight:800;">Edit Lokasi Kantor</h3>
            <button class="modal-close-spa" onclick="closeModal('edit-location-modal')"><i class="fas fa-times"></i></button>
        </div>
        <form id="edit-location-form" style="display: flex; flex-direction: column; gap: 15px; margin-top: 20px;">
            <input type="hidden" id="edit-location-id" name="id">
            <div>
                <label class="form-label-spa">Nama Kantor Cabang</label>
                <input type="text" id="edit-location-name" name="name" class="input-spa" required>
            </div>
            <div>
                <label class="form-label-spa">Alamat Lengkap</label>
                <textarea id="edit-location-address" name="address" class="input-spa" rows="3" required></textarea>
            </div>
            <div style="margin-bottom: 10px;">
                <label class="form-label-spa">Pilih Lokasi di Peta</label>
                <div id="edit-location-map" style="height: 300px; width: 100%; border-radius: 8px; z-index: 1;"></div>
                <small class="text-muted">Klik pada peta untuk mengubah koordinat.</small>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div>
                    <label class="form-label-spa">Latitude</label>
                    <input type="text" id="edit-lat" name="latitude" class="input-spa" required style="width: 100%; box-sizing: border-box;">
                </div>
                <div>
                    <label class="form-label-spa">Longitude</label>
                    <input type="text" id="edit-lng" name="longitude" class="input-spa" required style="width: 100%; box-sizing: border-box;">
                </div>
            </div>
            <button type="submit" class="btn-spa btn-spa-primary" style="margin-top: 10px;">Simpan Perubahan</button>
        </form>
    </div>
</div>
