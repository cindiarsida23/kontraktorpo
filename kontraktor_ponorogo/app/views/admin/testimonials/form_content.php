<div class="dashboard-shell">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <div class="eyebrow" style="color: var(--sage-green); font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.08em;">Manajemen Testimoni</div>
            <h1 class="page-title mb-1 fw-bold text-dark"><?php echo e($title); ?></h1>
            <p class="mb-0 text-muted">Isi formulir di bawah ini untuk mengelola ulasan kepuasan klien PT Graha Lestari.</p>
        </div>
        <a href="<?php echo url('admin/testimonials'); ?>" class="btn btn-outline-secondary rounded-pill px-4">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="card-custom bg-white p-4 p-md-5">
        <form method="POST" action="<?php echo $mode === 'edit' ? url('admin/testimonials/update/' . (int)($testimonial['id'] ?? 0)) : url('admin/testimonials/store'); ?>">
            <div class="row g-4">
                <div class="col-md-6">
                    <label class="form-label fw-semibold text-dark">Nama Klien <span class="text-danger">*</span></label>
                    <input type="text" class="form-control rounded-3 p-3" name="client_name" value="<?php echo e($testimonial['client_name'] ?? ''); ?>" placeholder="Contoh: H. Ahmad Subarkah" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold text-dark">Proyek / Keterangan Klien</label>
                    <input type="text" class="form-control rounded-3 p-3" name="company_name" value="<?php echo e($testimonial['company_name'] ?? ''); ?>" placeholder="Contoh: Pemilik Villa Asri Ponorogo">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold text-dark">Rating Ulasan (1 - 5 Bintang)</label>
                    <select name="rating" class="form-select rounded-3 p-3 fw-bold text-warning">
                        <?php 
                        $curRating = (int)($testimonial['rating'] ?? 5);
                        for ($r = 5; $r >= 1; $r--): ?>
                            <option value="<?php echo $r; ?>" <?php echo $curRating === $r ? 'selected' : ''; ?>>
                                <?php echo str_repeat('⭐ ', $r); ?> (<?php echo $r; ?> Bintang)
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-6 d-flex align-items-end">
                    <div class="form-check form-switch p-3 bg-light rounded-3 w-100 border d-flex align-items-center justify-content-between pe-4">
                        <label class="form-check-label fw-semibold text-dark mb-0 ps-2" for="isActiveSwitch">
                            Tampilkan di Halaman Utama Website
                        </label>
                        <input class="form-check-input" type="checkbox" name="is_active" id="isActiveSwitch" value="1" <?php echo ((int)($testimonial['is_active'] ?? 1) === 1) ? 'checked' : ''; ?> style="width: 2.5em; height: 1.3em;">
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold text-dark">Isi Ulasan Testimoni <span class="text-danger">*</span></label>
                    <textarea class="form-control rounded-3 p-3" name="message" rows="5" placeholder="Tuliskan ulasan pengalaman dan kepuasan klien..." required><?php echo e($testimonial['message'] ?? ''); ?></textarea>
                </div>
            </div>

            <div class="mt-4 pt-3 border-top d-flex align-items-center gap-2">
                <button type="submit" class="btn-primary-green px-5 py-3 rounded-pill fw-bold">
                    <i class="bi bi-floppy me-2"></i> Simpan Testimoni
                </button>
                <a href="<?php echo url('admin/testimonials'); ?>" class="btn btn-light border px-4 py-3 rounded-pill">Batal</a>
            </div>
        </form>
    </div>
</div>
