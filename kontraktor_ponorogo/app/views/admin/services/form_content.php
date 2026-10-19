<div class="d-flex align-items-center justify-content-between mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--text-primary);"><?php echo e($title); ?></h3>
        <p class="text-secondary small mb-0">Isi formulir di bawah ini untuk menambahkan atau mengubah data layanan konstruksi.</p>
    </div>
    <a href="<?php echo url('admin/services'); ?>" class="btn btn-outline-secondary rounded-pill px-3">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card-custom bg-white p-4 p-md-5">
    <form method="POST" action="<?php echo $mode === 'edit' ? url('admin/services/update/' . (int)($service['id'] ?? 0)) : url('admin/services/store'); ?>">
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label fw-semibold text-dark">Judul Layanan <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-lg fs-6" name="title" value="<?php echo e($service['title'] ?? ''); ?>" placeholder="Contoh: Jasa Desain Arsitektur" required>
            </div>
            
            <div class="col-md-6">
                <label class="form-label fw-semibold text-dark">Slug (URL Alias)</label>
                <input type="text" class="form-control form-control-lg fs-6" name="slug" value="<?php echo e($service['slug'] ?? ''); ?>" placeholder="Otomatis jika dikosongkan">
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold text-dark">Icon Bootstrap (contoh: house-gear, tools, palette)</label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-success fw-bold">bi-</span>
                    <input type="text" class="form-control" name="icon" value="<?php echo e($service['icon'] ?? 'tools'); ?>" placeholder="tools">
                </div>
                <div class="form-text">Gunakan nama ikon dari <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a>.</div>
            </div>

            <div class="col-md-6">
                <label class="form-label fw-semibold text-dark">Urutan Tampil (Sort Order)</label>
                <input type="number" class="form-control" name="sort_order" value="<?php echo (int)($service['sort_order'] ?? 0); ?>" min="0">
                <div class="form-text">Angka lebih kecil tampil lebih awal pada daftar layanan.</div>
            </div>

            <div class="col-12">
                <label class="form-label fw-semibold text-dark">Deskripsi Layanan</label>
                <textarea class="form-control" name="description" rows="5" placeholder="Penjelasan singkat mengenai bidang layanan ini..."><?php echo e($service['description'] ?? ''); ?></textarea>
            </div>
        </div>

        <div class="mt-4 pt-3 border-top d-flex align-items-center gap-2">
            <button type="submit" class="btn-primary-green px-4">
                <i class="bi bi-floppy me-1"></i> Simpan Layanan
            </button>
            <a href="<?php echo url('admin/services'); ?>" class="btn btn-light border px-4">Batal</a>
        </div>
    </form>
</div>
