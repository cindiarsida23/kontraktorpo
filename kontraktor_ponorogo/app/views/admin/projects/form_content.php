<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--text-primary);"><?php echo e($title); ?></h3>
        <p class="text-secondary small mb-0">Isi formulir di bawah ini untuk menambahkan atau mengubah data portofolio proyek.</p>
    </div>
    <a href="<?php echo url('admin/projects'); ?>" class="btn btn-outline-secondary rounded-pill px-3">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card-custom bg-white p-4 p-md-5">
    <form method="POST" action="<?php echo $mode === 'edit' ? url('admin/projects/update/' . (int)($project['id'] ?? 0)) : url('admin/projects/store'); ?>" enctype="multipart/form-data">
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label fw-semibold text-dark">Judul Proyek <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-lg fs-6" name="title" value="<?php echo e($project['title'] ?? ''); ?>" placeholder="Contoh: Modern Tropical House Ponorogo" required>
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-semibold text-dark">Slug (URL Alias)</label>
                <input type="text" class="form-control form-control-lg fs-6" name="slug" value="<?php echo e($project['slug'] ?? ''); ?>" placeholder="Otomatis jika dikosongkan">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold text-dark">Lokasi Proyek</label>
                <input type="text" class="form-control" name="location" value="<?php echo e($project['location'] ?? ''); ?>" placeholder="Contoh: Babadan, Ponorogo">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold text-dark">Kategori</label>
                <input type="text" class="form-control" name="category" value="<?php echo e($project['category'] ?? ''); ?>" placeholder="Contoh: Rumah Tinggal / Desain Interior">
            </div>

            <div class="col-md-4">
                <label class="form-label fw-semibold text-dark">Estimasi Budget</label>
                <input type="text" class="form-control" name="budget" value="<?php echo e($project['budget'] ?? ''); ?>" placeholder="Contoh: Rp 450 Juta">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold text-dark">Status Pengerjaan</label>
                <select class="form-select" name="status">
                    <option value="planning" <?php echo (($project['status'] ?? 'planning') === 'planning') ? 'selected' : ''; ?>>Planning (Perencanaan)</option>
                    <option value="ongoing" <?php echo (($project['status'] ?? 'planning') === 'ongoing') ? 'selected' : ''; ?>>Ongoing (Dalam Pengerjaan)</option>
                    <option value="completed" <?php echo (($project['status'] ?? 'planning') === 'completed') ? 'selected' : ''; ?>>Completed (Selesai)</option>
                </select>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold text-dark">Gambar Cover / Portofolio</label>
                <input type="file" class="form-control" name="cover_image" id="coverImageInput" accept="image/*">
                <div class="form-text">Format yang didukung: JPG, PNG, WEBP (Maksimal 5MB).</div>
            </div>

            <!-- Image Preview Box -->
            <div class="col-12">
                <div class="p-3 border rounded-3 bg-light d-flex align-items-center gap-3" id="imagePreviewContainer" style="max-width: 450px;">
                    <div class="position-relative">
                        <?php if (!empty($project['cover_image'])): ?>
                            <img src="<?php echo url($project['cover_image']); ?>" id="coverImagePreview" alt="Preview Gambar" class="rounded object-fit-cover shadow-sm" style="width: 120px; height: 80px;">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/120x80?text=No+Image" id="coverImagePreview" alt="Preview Gambar" class="rounded object-fit-cover shadow-sm" style="width: 120px; height: 80px; display: none;">
                            <div id="noImagePlaceholder" class="bg-secondary text-white rounded d-flex align-items-center justify-content-center" style="width: 120px; height: 80px; font-size: 0.8rem;">Belum ada gambar</div>
                        <?php endif; ?>
                    </div>
                    <div>
                        <span class="badge bg-primary mb-1">Pratinjau Foto</span>
                        <p class="small text-muted mb-0" id="previewFilename">
                            <?php echo !empty($project['cover_image']) ? basename($project['cover_image']) : 'Pilih file gambar untuk melihat pratinjau foto proyek.'; ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <label class="form-label fw-semibold text-dark">Deskripsi Detail Proyek</label>
                <textarea class="form-control" name="description" rows="6" placeholder="Jelaskan rincian proyek, konsep arsitektur, atau spesifikasi pengerjaan..."><?php echo e($project['description'] ?? ''); ?></textarea>
            </div>
        </div>

        <div class="mt-4 pt-3 border-top d-flex align-items-center gap-2">
            <button type="submit" class="btn-primary-green px-4">
                <i class="bi bi-floppy me-1"></i> Simpan Proyek
            </button>
            <a href="<?php echo url('admin/projects'); ?>" class="btn btn-light border px-4">Batal</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('coverImageInput');
    const imgPreview = document.getElementById('coverImagePreview');
    const placeholder = document.getElementById('noImagePlaceholder');
    const filenameText = document.getElementById('previewFilename');

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
