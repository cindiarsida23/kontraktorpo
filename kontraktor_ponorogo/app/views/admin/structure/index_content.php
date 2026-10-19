<div class="dashboard-shell">
    <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <div class="eyebrow" style="color: var(--sage-green); font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.08em;">Manajemen Organisasi</div>
            <h1 class="page-title mb-1 fw-bold text-dark">Struktur Perusahaan</h1>
            <p class="mb-0 text-muted">Kelola nama, foto profil, dan jabatan hirarki manajemen PT. Graha Lestari Karya Utama.</p>
        </div>
        <div>
            <a href="<?php echo url('struktur-perusahaan'); ?>" target="_blank" class="btn btn-outline-success rounded-pill px-4 py-2 fw-semibold d-inline-flex align-items-center gap-2">
                <i class="bi bi-eye"></i> Lihat Bagan Publik
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

    <form action="<?php echo url('admin/structure/store'); ?>" method="POST" enctype="multipart/form-data">
        
        <!-- SECTION 1: DEWAN KOMISARIS -->
        <div class="card-custom p-4 mb-4">
            <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                    <i class="bi bi-person-badge-fill fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 text-dark">Dewan Komisaris</h5>
                    <small class="text-muted">Posisi puncak pengawas perusahaan (2 Anggota)</small>
                </div>
            </div>

            <div class="row g-4">
                <?php
                $komisarisList = [
                    'komisaris_1' => 'Komisaris 1',
                    'komisaris_2' => 'Komisaris 2',
                ];
                foreach ($komisarisList as $key => $titleLabel):
                    $m = $members[$key] ?? ['name' => '', 'role_title' => 'KOMISARIS', 'photo_path' => ''];
                ?>
                    <div class="col-md-6">
                        <div class="p-3 rounded-4 bg-light border h-100">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="position-relative">
                                    <?php if (!empty($m['photo_path'])): ?>
                                        <img src="<?php echo assetUrl($m['photo_path']); ?>" alt="Foto Profil" class="rounded-circle border border-success border-2 object-fit-cover shadow-sm" style="width: 64px; height: 64px;">
                                    <?php else: ?>
                                        <div class="rounded-circle bg-white text-success border border-success border-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 64px; height: 64px; font-size: 1.8rem;">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1 rounded-pill fw-bold extra-small"><?php echo e($titleLabel); ?></span>
                                    <h6 class="fw-bold mb-0 mt-1 text-dark"><?php echo e($m['name'] ?: 'Nama Belum Diisi'); ?></h6>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label small fw-semibold text-muted">Nama Lengkap</label>
                                <input type="text" name="name_<?php echo $key; ?>" class="form-control rounded-3" value="<?php echo e($m['name']); ?>" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-semibold text-muted">Jabatan / Posisi</label>
                                <input type="text" name="role_<?php echo $key; ?>" class="form-control rounded-3" value="<?php echo e($m['role_title']); ?>" required>
                            </div>
                            <div>
                                <label class="form-label small fw-semibold text-muted">Ganti Foto Profil</label>
                                <input type="file" name="photo_<?php echo $key; ?>" class="form-control rounded-3" accept="image/*">
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- SECTION 2: DIREKSI & MANAGEMENT -->
        <div class="card-custom p-4 mb-4">
            <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                    <i class="bi bi-person-workspace fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 text-dark">Direksi & Eksekutif</h5>
                    <small class="text-muted">Jabatan Direktur dan General Manager</small>
                </div>
            </div>

            <div class="row g-4">
                <?php
                $execList = [
                    'direktur' => 'Direktur Utama',
                    'gm' => 'General Manager',
                ];
                foreach ($execList as $key => $titleLabel):
                    $m = $members[$key] ?? ['name' => '', 'role_title' => '', 'photo_path' => ''];
                ?>
                    <div class="col-md-6">
                        <div class="p-3 rounded-4 bg-light border h-100">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="position-relative">
                                    <?php if (!empty($m['photo_path'])): ?>
                                        <img src="<?php echo assetUrl($m['photo_path']); ?>" alt="Foto Profil" class="rounded-circle border border-success border-2 object-fit-cover shadow-sm" style="width: 64px; height: 64px;">
                                    <?php else: ?>
                                        <div class="rounded-circle bg-white text-success border border-success border-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 64px; height: 64px; font-size: 1.8rem;">
                                            <i class="bi bi-person-badge"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1 rounded-pill fw-bold extra-small"><?php echo e($titleLabel); ?></span>
                                    <h6 class="fw-bold mb-0 mt-1 text-dark"><?php echo e($m['name'] ?: 'Nama Belum Diisi'); ?></h6>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label small fw-semibold text-muted">Nama Lengkap</label>
                                <input type="text" name="name_<?php echo $key; ?>" class="form-control rounded-3" value="<?php echo e($m['name']); ?>" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-semibold text-muted">Jabatan / Posisi</label>
                                <input type="text" name="role_<?php echo $key; ?>" class="form-control rounded-3" value="<?php echo e($m['role_title']); ?>" required>
                            </div>
                            <div>
                                <label class="form-label small fw-semibold text-muted">Ganti Foto Profil</label>
                                <input type="file" name="photo_<?php echo $key; ?>" class="form-control rounded-3" accept="image/*">
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- SECTION 3: DIVISI OPERASIONAL -->
        <div class="card-custom p-4 mb-4">
            <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                    <i class="bi bi-diagram-3-fill fs-5"></i>
                </div>
                <div>
                    <h5 class="fw-bold mb-0 text-dark">Divisi Operasional & Teknis</h5>
                    <small class="text-muted">Kepala divisi pengawasan, arsitektur, keuangan, dan logistik</small>
                </div>
            </div>

            <div class="row g-4">
                <?php
                $opsList = [
                    'pengawas' => 'Pengawas Lapangan',
                    'arsitek' => 'Arsitek',
                    'keuangan' => 'Keuangan',
                    'gudang' => 'Gudang & Logistik',
                ];
                foreach ($opsList as $key => $titleLabel):
                    $m = $members[$key] ?? ['name' => '', 'role_title' => '', 'photo_path' => ''];
                ?>
                    <div class="col-md-6 col-lg-3">
                        <div class="p-3 rounded-4 bg-light border h-100">
                            <div class="d-flex align-items-center gap-2 mb-3">
                                <div class="position-relative">
                                    <?php if (!empty($m['photo_path'])): ?>
                                        <img src="<?php echo assetUrl($m['photo_path']); ?>" alt="Foto Profil" class="rounded-circle border border-success border-2 object-fit-cover shadow-sm" style="width: 52px; height: 52px;">
                                    <?php else: ?>
                                        <div class="rounded-circle bg-white text-success border border-success border-2 d-flex align-items-center justify-content-center shadow-sm" style="width: 52px; height: 52px; font-size: 1.4rem;">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="text-truncate">
                                    <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-0.5 rounded-pill fw-bold text-truncate" style="font-size: 0.7rem; max-width: 100%;"><?php echo e($titleLabel); ?></span>
                                    <h6 class="fw-bold mb-0 mt-1 text-dark text-truncate" style="font-size: 0.88rem;"><?php echo e($m['name'] ?: 'Nama Belum Diisi'); ?></h6>
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label extra-small fw-semibold text-muted">Nama Lengkap</label>
                                <input type="text" name="name_<?php echo $key; ?>" class="form-control form-control-sm rounded-3" value="<?php echo e($m['name']); ?>" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label extra-small fw-semibold text-muted">Jabatan / Posisi</label>
                                <input type="text" name="role_<?php echo $key; ?>" class="form-control form-control-sm rounded-3" value="<?php echo e($m['role_title']); ?>" required>
                            </div>
                            <div>
                                <label class="form-label extra-small fw-semibold text-muted">Ganti Foto Profil</label>
                                <input type="file" name="photo_<?php echo $key; ?>" class="form-control form-control-sm rounded-3" accept="image/*">
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Submit Button Card -->
        <div class="card-custom p-4 bg-light border-0 shadow-sm text-center mb-4">
            <button type="submit" class="btn btn-primary-green btn-lg rounded-pill px-5 py-3 fw-bold shadow-sm">
                <i class="bi bi-floppy-fill me-2"></i> Simpan Struktur Perusahaan
            </button>
            <small class="text-muted d-block mt-2">Perubahan foto dan nama akan langsung terupdate pada bagan organisasi publik.</small>
        </div>
    </form>
</div>
