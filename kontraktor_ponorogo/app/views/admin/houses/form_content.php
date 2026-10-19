<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--text-primary);"><?php echo e($title); ?></h3>
        <p class="text-secondary small mb-0">Isi formulir di bawah ini untuk menambahkan atau memperbarui unit katalog rumah.</p>
    </div>
    <a href="<?php echo url('admin/houses'); ?>" class="btn btn-outline-secondary rounded-pill px-3">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card-custom bg-white p-4 p-md-5">
    <form method="POST" action="<?php echo $mode === 'edit' ? url('admin/houses/update/' . (int)($house['id'] ?? 0)) : url('admin/houses/store'); ?>" enctype="multipart/form-data">
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label fw-semibold text-dark">Judul / Nama Unit Rumah <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-lg fs-6" name="title" value="<?php echo e($house['title'] ?? ''); ?>" placeholder="Contoh: Rumah Minimalis Type 45/90" required>
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-semibold text-dark">Slug (URL Alias)</label>
                <input type="text" class="form-control form-control-lg fs-6" name="slug" value="<?php echo e($house['slug'] ?? ''); ?>" placeholder="Otomatis jika dikosongkan">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold text-dark">Harga Unit <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="price" value="<?php echo e($house['price'] ?? ''); ?>" placeholder="Contoh: Rp 350.000.000" required>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold text-dark">Lokasi Unit</label>
                <input type="text" class="form-control" name="location" value="<?php echo e($house['location'] ?? ''); ?>" placeholder="Contoh: Siman, Ponorogo">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold text-dark">Tipe / Model</label>
                <input type="text" class="form-control" name="type" value="<?php echo e($house['type'] ?? ''); ?>" placeholder="Contoh: Type 36/60 Minimalis">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold text-dark">Luas Tanah / Bangunan</label>
                <input type="text" class="form-control" name="area_size" value="<?php echo e($house['area_size'] ?? ''); ?>" placeholder="Contoh: LT 90m² / LB 45m²">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold text-dark">Jumlah Kamar Tidur</label>
                <input type="number" class="form-control" name="bedrooms" value="<?php echo e($house['bedrooms'] ?? '2'); ?>" min="0">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold text-dark">Jumlah Kamar Mandi</label>
                <input type="number" class="form-control" name="bathrooms" value="<?php echo e($house['bathrooms'] ?? '1'); ?>" min="0">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold text-dark">Status Ketersediaan</label>
                <select class="form-select" name="status">
                    <option value="available" <?php echo (($house['status'] ?? 'available') === 'available') ? 'selected' : ''; ?>>Available (Tersedia)</option>
                    <option value="sold" <?php echo (($house['status'] ?? 'available') === 'sold') ? 'selected' : ''; ?>>Sold (Terjual / Booked)</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold text-dark">Foto Cover Unit</label>
                <input type="file" class="form-control" name="cover_image" id="houseCoverInput" accept="image/*">
                <div class="form-text">Format yang didukung: JPG, PNG, WEBP (Maksimal 5MB).</div>
            </div>

            <!-- Image Preview Box -->
            <div class="col-12">
                <div class="p-3 border rounded-3 bg-light d-flex align-items-center gap-3" id="houseImagePreviewContainer" style="max-width: 450px;">
                    <div class="position-relative">
                        <?php if (!empty($house['cover_image'])): ?>
                            <img src="<?php echo url($house['cover_image']); ?>" id="houseCoverPreview" alt="Preview Rumah" class="rounded object-fit-cover shadow-sm" style="width: 120px; height: 80px;">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/120x80?text=No+Image" id="houseCoverPreview" alt="Preview Rumah" class="rounded object-fit-cover shadow-sm" style="width: 120px; height: 80px; display: none;">
                            <div id="houseNoImagePlaceholder" class="bg-secondary text-white rounded d-flex align-items-center justify-content-center" style="width: 120px; height: 80px; font-size: 0.8rem;">Belum ada foto</div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <span class="badge bg-success mb-1">Pratinjau Foto</span>
                        <p class="small text-muted mb-0" id="housePreviewFilename">
                            <?php echo !empty($house['cover_image']) ? basename($house['cover_image']) : 'Pilih file gambar untuk melihat pratinjau unit rumah.'; ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <label class="form-label fw-semibold text-dark">Deskripsi & Fasilitas Unit</label>
                <textarea class="form-control" name="description" rows="6" placeholder="Jelaskan spesifikasi bangunan, akses jalan, legalitas SHM/IMB, dan fasilitas pendukung..."><?php echo e($house['description'] ?? ''); ?></textarea>
            </div>
        </div>

        <div class="mt-4 pt-3 border-top d-flex align-items-center gap-2">
            <button type="submit" class="btn-primary-green px-4">
                <i class="bi bi-floppy me-1"></i> Simpan Katalog Rumah
            </button>
            <a href="<?php echo url('admin/houses'); ?>" class="btn btn-light border px-4">Batal</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('houseCoverInput');
    const imgPreview = document.getElementById('houseCoverPreview');
    const placeholder = document.getElementById('houseNoImagePlaceholder');
    const filenameText = document.getElementById('housePreviewFilename');

    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(evt) {
                    imgPreview.src = evt.target.result;
                    imgPreview.style.display = 'block';
                    if (placeholder) placeholder.style.display = 'none';
                    if (filenameText) filenameText.textContent = file.name + ' (' + Math.round(file.size / 1024) + ' KB)';
                };
                reader.readAsDataURL(file);
            }
        });
    }
});
</script>
