<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--text-primary);">Kelola Layanan</h3>
        <p class="text-secondary small mb-0">Kelola daftar bidang layanan dan jasa konstruksi PT Graha Lestari.</p>
    </div>
    <a href="<?php echo url('admin/services/create'); ?>" class="btn-primary-green">
        <i class="bi bi-plus-lg me-1"></i> Tambah Layanan
    </a>
</div>

<div class="card-custom p-0 bg-white">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th style="width: 60px;" class="ps-4">#</th>
                    <th>Judul Layanan</th>
                    <th>Icon Bootstrap</th>
                    <th>Urutan Tampil</th>
                    <th style="width: 160px;" class="pe-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($services)): ?>
                    <?php foreach ($services as $service): ?>
                        <tr>
                            <td class="ps-4 fw-semibold text-muted"><?php echo (int)$service['id']; ?></td>
                            <td class="fw-bold text-dark"><?php echo e($service['title']); ?></td>
                            <td>
                                <span class="badge bg-light text-dark border font-monospace">
                                    <i class="bi bi-<?php echo e($service['icon'] ?? 'tools'); ?> text-success me-1"></i>
                                    bi-<?php echo e($service['icon'] ?? 'tools'); ?>

                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary rounded-pill px-3"><?php echo (int)($service['sort_order'] ?? 0); ?></span>
                            </td>
                            <td class="pe-4 text-center">
                                <div class="d-inline-flex gap-1">
                                    <a href="<?php echo url('admin/services/edit/' . (int)$service['id']); ?>" class="btn btn-sm btn-outline-success fw-semibold" title="Edit Layanan">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="<?php echo url('admin/services/delete/' . (int)$service['id']); ?>" class="btn btn-sm btn-outline-danger fw-semibold" onclick="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')" title="Hapus Layanan">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Belum ada data layanan. Silakan tambah data baru.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
