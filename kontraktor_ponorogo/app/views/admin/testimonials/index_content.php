<div class="dashboard-shell">
    <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <div class="eyebrow" style="color: var(--sage-green); font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.08em;">Reputasi & Ulasan</div>
            <h1 class="page-title mb-1 fw-bold text-dark">Testimoni Klien</h1>
            <p class="mb-0 text-muted">Kelola ulasan, kepuasan, dan pengakuan dari pemilik rumah & klien proyek PT Graha Lestari.</p>
        </div>
        <div>
            <a href="<?php echo url('admin/testimonials/create'); ?>" class="btn btn-primary-green rounded-pill px-4 py-2.5 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                <i class="bi bi-plus-lg"></i> Tambah Testimoni Baru
            </a>
        </div>
    </div>

    <?php if (!empty($success)): ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> <?php echo e($success); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4 mb-4" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> <?php echo e($error); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Table Card -->
    <div class="card-custom p-0 overflow-hidden shadow-sm">
        <div class="p-4 bg-white border-bottom d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h5 class="fw-bold mb-0 text-dark">Daftar Testimoni Klien</h5>
                <small class="text-muted">Testimoni aktif akan langsung tampil pada halaman Beranda website</small>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4" style="width: 130px;">Rating</th>
                        <th style="width: 220px;">Klien & Proyek</th>
                        <th>Isi Ulasan / Testimoni</th>
                        <th style="width: 130px;">Status</th>
                        <th class="pe-4 text-end" style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($testimonials)): ?>
                        <?php foreach ($testimonials as $t): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="text-warning small d-flex gap-1" style="font-size: 0.9rem;">
                                        <?php 
                                        $rating = (int)($t['rating'] ?? 5);
                                        for ($i = 0; $i < 5; $i++): 
                                            if ($i < $rating): ?>
                                                <i class="bi bi-star-fill"></i>
                                            <?php else: ?>
                                                <i class="bi bi-star text-muted opacity-50"></i>
                                            <?php endif;
                                        endfor; 
                                        ?>
                                    </div>
                                    <small class="text-muted fw-semibold" style="font-size: 0.75rem;"><?php echo $rating; ?> / 5 Bintang</small>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark"><?php echo e($t['client_name']); ?></div>
                                    <div class="small text-muted"><?php echo e($t['company_name'] ?: 'Klien PT Graha Lestari'); ?></div>
                                </td>
                                <td>
                                    <div class="p-2.5 bg-light rounded-3 text-secondary small fst-italic" style="line-height: 1.6;">
                                        "<?php echo e($t['message']); ?>"
                                    </div>
                                </td>
                                <td>
                                    <?php if ((int)($t['is_active'] ?? 1) === 1): ?>
                                        <a href="<?php echo url('admin/testimonials/toggle/' . $t['id']); ?>" class="badge bg-success text-white rounded-pill px-3 py-1.5 text-decoration-none fw-semibold d-inline-flex align-items-center gap-1" title="Klik untuk nonaktifkan">
                                            <i class="bi bi-eye-fill"></i> Tampil
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo url('admin/testimonials/toggle/' . $t['id']); ?>" class="badge bg-secondary text-white rounded-pill px-3 py-1.5 text-decoration-none fw-semibold d-inline-flex align-items-center gap-1" title="Klik untuk tampilkan">
                                            <i class="bi bi-eye-slash-fill"></i> Sembunyi
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="d-flex align-items-center justify-content-end gap-1">
                                        <a href="<?php echo url('admin/testimonials/edit/' . $t['id']); ?>" class="btn btn-sm btn-outline-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" title="Edit Testimoni">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>

                                        <a href="<?php echo url('admin/testimonials/delete/' . $t['id']); ?>" onclick="return confirm('Yakin ingin menghapus testimoni ini?');" class="btn btn-sm btn-outline-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" title="Hapus Testimoni">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="bi bi-star fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                Belum ada data testimoni klien.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
