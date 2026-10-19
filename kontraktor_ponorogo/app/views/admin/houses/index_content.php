<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h3 class="fw-bold mb-1" style="color: var(--text-primary);">Katalog Rumah</h3>
        <p class="text-secondary small mb-0">Kelola listing unit rumah, harga, lokasi, dan foto cover unit.</p>
    </div>
    <a href="<?php echo url('admin/houses/create'); ?>" class="btn-primary-green">
        <i class="bi bi-plus-lg me-1"></i> Tambah Rumah
    </a>
</div>

<div class="card-custom p-0 bg-white">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th style="width: 60px;" class="ps-4">#</th>
                    <th style="width: 90px;">Gambar</th>
                    <th>Judul Rumah</th>
                    <th>Harga</th>
                    <th>Lokasi</th>
                    <th>Spesifikasi</th>
                    <th>Status</th>
                    <th style="width: 160px;" class="pe-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($houses)): ?>
                    <?php foreach ($houses as $house): ?>
                        <tr>
                            <td class="ps-4 fw-semibold text-muted"><?php echo (int)$house['id']; ?></td>
                            <td>
                                <?php if (!empty($house['cover_image'])): ?>
                                    <img src="<?php echo url($house['cover_image']); ?>" alt="Cover Rumah" style="width: 70px; height: 48px; object-fit: cover; border-radius: 8px; border: 1px solid var(--border-color);">
                                <?php else: ?>
                                    <div class="bg-light text-muted d-flex align-items-center justify-content-center rounded border" style="width: 70px; height: 48px; font-size: 0.75rem;">No Img</div>
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold text-dark"><?php echo e($house['title']); ?></td>
                            <td class="text-success fw-bold"><?php echo e($house['price']); ?></td>
                            <td class="text-secondary"><?php echo e($house['location'] ?: '-'); ?></td>
                            <td class="small text-muted">
                                <?php echo e($house['type'] ?: '-'); ?> | <?php echo e($house['area_size'] ?: '-'); ?><br>
                                <i class="bi bi-door-closed"></i> <?php echo (int)($house['bedrooms'] ?? 0); ?> KT &nbsp;&bull;&nbsp; <i class="bi bi-droplet"></i> <?php echo (int)($house['bathrooms'] ?? 0); ?> KM
                            </td>
                            <td>
                                <?php 
                                $status = $house['status'] ?? 'available';
                                $badgeBg = ($status === 'available') ? 'bg-success' : 'bg-secondary';
                                ?>
                                <span class="badge <?php echo $badgeBg; ?> px-3 py-1 rounded-pill">
                                    <?php echo e(ucfirst($status)); ?>
                                </span>
                            </td>
                            <td class="pe-4 text-center">
                                <div class="d-inline-flex gap-1">
                                    <a href="<?php echo url('admin/houses/edit/' . (int)$house['id']); ?>" class="btn btn-sm btn-outline-success fw-semibold" title="Edit Data Rumah">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <a href="<?php echo url('admin/houses/delete/' . (int)$house['id']); ?>" class="btn btn-sm btn-outline-danger fw-semibold" onclick="return confirm('Apakah Anda yakin ingin menghapus data rumah ini?')" title="Hapus Rumah">
                                        <i class="bi bi-trash"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">Belum ada data unit rumah. Silakan tambah data baru.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
