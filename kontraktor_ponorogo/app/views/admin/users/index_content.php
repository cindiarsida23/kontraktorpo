<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3 mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1" style="font-size: 1.6rem; letter-spacing: -0.02em;">Manajemen Pengguna Sistem</h2>
        <p class="text-muted small mb-0">Kelola akun administrator, pengelola, dan hak akses sistem PT Graha Lestari</p>
    </div>
    <div>
        <a href="<?php echo url('admin/users/create'); ?>" class="btn btn-success rounded-3 px-4 py-2.5 fw-bold shadow-sm d-inline-flex align-items-center gap-2" style="background-color: #2F6F3E; border-color: #2F6F3E; font-size: 0.92rem;">
            <i class="bi bi-person-plus-fill"></i> + Tambah Pengguna
        </a>
    </div>
</div>

<div class="card-custom bg-white rounded-4 border shadow-sm overflow-hidden">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr class="text-uppercase text-secondary fw-bold" style="font-size: 0.78rem; letter-spacing: 0.05em;">
                    <th class="ps-4 py-3" style="width: 70px;">NO</th>
                    <th class="py-3">USERNAME / EMAIL</th>
                    <th class="py-3">NAMA LENGKAP</th>
                    <th class="py-3">HAK AKSES</th>
                    <th class="py-3">TERDAFTAR</th>
                    <th class="pe-4 py-3 text-end" style="width: 140px;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php $no = 1; foreach ($users as $u): ?>
                        <tr>
                            <td class="ps-4 fw-semibold text-secondary"><?php echo $no++; ?></td>
                            <td class="fw-bold text-dark">
                                <?php 
                                    $username = explode('@', $u['email'])[0];
                                    echo e($username);
                                ?>
                                <div class="text-muted extra-small fw-normal" style="font-size: 0.78rem;"><?php echo e($u['email']); ?></div>
                            </td>
                            <td class="fw-semibold text-dark"><?php echo e($u['name']); ?></td>
                            <td>
                                <?php 
                                    $role = strtolower($u['role'] ?? 'admin');
                                    if ($role === 'superadmin' || $role === 'admin'): 
                                ?>
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3 py-1.5 fw-semibold" style="font-size: 0.8rem;">
                                        <i class="bi bi-shield-lock-fill me-1"></i> <?php echo ($role === 'superadmin') ? 'SuperAdmin' : 'Administrator'; ?>
                                    </span>
                                <?php elseif ($role === 'manager'): ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1.5 fw-semibold" style="font-size: 0.8rem;">
                                        <i class="bi bi-person-badge-fill me-1"></i> Manager
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-secondary-subtle text-secondary border rounded-pill px-3 py-1.5 fw-semibold" style="font-size: 0.8rem;">
                                        <i class="bi bi-person-fill me-1"></i> Staff
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="text-secondary small">
                                <?php echo !empty($u['created_at']) ? date('d/m/Y', strtotime($u['created_at'])) : '-'; ?>
                            </td>
                            <td class="pe-4 text-end">
                                <div class="d-inline-flex gap-1.5">
                                    <a href="<?php echo url('admin/users/edit/' . $u['id']); ?>" class="btn btn-sm btn-primary rounded-3 px-2.5 py-1.5 shadow-sm" title="Edit Pengguna" style="background-color: #0D6EFD; border-color: #0D6EFD;">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <?php if ((int)$u['id'] !== (int)($user['id'] ?? 0)): ?>
                                        <a href="<?php echo url('admin/users/delete/' . $u['id']); ?>" class="btn btn-sm btn-danger rounded-3 px-2.5 py-1.5 shadow-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');" title="Hapus Pengguna">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-people fs-1 d-block text-secondary mb-2"></i>
                            Belum ada pengguna terdaftar dalam sistem.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
