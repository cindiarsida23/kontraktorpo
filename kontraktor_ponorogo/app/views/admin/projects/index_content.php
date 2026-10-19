<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--text-primary);">Portofolio Proyek</h3>
        <p class="text-secondary small mb-0">Kelola foto proyek, status pengerjaan, dan kategori portofolio.</p>
    </div>
    <a href="<?php echo url('admin/projects/create'); ?>" class="btn-primary-green">
        <i class="bi bi-plus-lg me-1"></i> Tambah Proyek
    </a>
</div>

<div class="card-custom p-0 bg-white">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th style="width: 60px;" class="ps-4">#</th>
                    <th style="width: 90px;">Gambar</th>
                    <th>Judul Proyek</th>
                    <th>Lokasi</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th style="width: 160px;" class="pe-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($projects)): ?>
                    <?php foreach ($projects as $project): ?>
                        <tr>
                            <td class="ps-4 fw-semibold text-muted"><?php echo (int)$project['id']; ?></td>
                            <td>
                                <?php if (!empty($project['cover_image'])): ?>
                                    <img src="<?php echo url($project['cover_image']); ?>" alt="Cover Proyek" style="width: 70px; height: 48px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border-color);">
                                <?php else: ?>
                                    <div class="bg-light text-muted d-flex align-items-center justify-content-center rounded border" style="width: 70px; height: 48px; font-size: 0.75rem;">No Img</div>
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold text-dark"><?php echo e($project['title']); ?></td>
                            <td class="text-secondary"><?php echo e($project['location'] ?: '-'); ?></td>
                            <td>
                                <span class="badge bg-light text-dark border px-2 py-1"><?php echo e($project['category'] ?: 'Umum'); ?></span>
                            </td>
                            <td>
                                <?php 
                                $status = $project['status'] ?? 'planning';
                                $badgeBg = ($status === 'completed') ? 'bg-success' : (($status === 'ongoing') ? 'bg-warning text-dark' : 'bg-secondary');
                                ?>
                                <span class="badge <?php echo $badgeBg; ?> px-3 py-1 rounded-pill">
                                    <?php echo e(ucfirst($status)); ?>

                                </span>
                            </td>
                            <td class="pe-4 text-center">
                                <div class="d-inline-flex gap-1">
                                    <a href="<?php echo url('admin/projects/edit/' . (int)$project['id']); ?>" class="btn btn-sm btn-outline-success fw-semibold" title="Edit Data Proyek">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="<?php echo url('admin/projects/delete/' . (int)$project['id']); ?>" class="btn btn-sm btn-outline-danger fw-semibold" onclick="return confirm('Apakah Anda yakin ingin menghapus proyek ini?')" title="Hapus Proyek">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Belum ada data proyek portofolio. Silakan tambah data baru.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
