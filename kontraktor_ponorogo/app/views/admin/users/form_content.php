<?php
$isEdit = ($mode ?? 'create') === 'edit';
$actionUrl = $isEdit ? url('admin/users/update/' . ($userData['id'] ?? 0)) : url('admin/users/store');
?>

<div class="mb-4 d-flex align-items-center justify-content-between">
    <div>
        <h2 class="fw-bold text-dark mb-1" style="font-size: 1.6rem; letter-spacing: -0.02em;">
            <?php echo $isEdit ? 'Edit Data Pengguna' : 'Tambah Pengguna Baru'; ?>
        </h2>
        <p class="text-muted small mb-0">Isi formulir di bawah ini untuk <?php echo $isEdit ? 'memperbarui data' : 'mendaftarkan'; ?> pengguna baru di sistem</p>
    </div>
    <a href="<?php echo url('admin/users'); ?>" class="btn btn-light border rounded-3 px-3 py-2 fw-semibold text-secondary d-inline-flex align-items-center gap-1.5" style="font-size: 0.88rem;">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card-custom bg-white p-4 rounded-4 border shadow-sm mb-4">
            <form action="<?php echo $actionUrl; ?>" method="POST">
                <div class="row g-3">
                    <!-- Nama Lengkap -->
                    <div class="col-md-6">
                        <label for="name" class="form-label fw-bold text-dark small">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control rounded-3 py-2.5" id="name" name="name" value="<?php echo e($userData['name'] ?? ''); ?>" placeholder="Contoh: Administrator Utama" required>
                    </div>

                    <!-- Email / Username -->
                    <div class="col-md-6">
                        <label for="email" class="form-label fw-bold text-dark small">Email / Username <span class="text-danger">*</span></label>
                        <input type="email" class="form-control rounded-3 py-2.5" id="email" name="email" value="<?php echo e($userData['email'] ?? ''); ?>" placeholder="admin@kontraktorponorogo.com" required>
                    </div>

                    <!-- Password -->
                    <div class="col-md-6">
                        <label for="password" class="form-label fw-bold text-dark small">
                            Password <?php echo $isEdit ? '<span class="text-muted fw-normal">(Kosongkan jika tidak diubah)</span>' : '<span class="text-danger">*</span>'; ?>
                        </label>
                        <input type="password" class="form-control rounded-3 py-2.5" id="password" name="password" placeholder="••••••••" <?php echo $isEdit ? '' : 'required'; ?>>
                    </div>

                    <!-- Hak Akses / Role -->
                    <div class="col-md-6">
                        <label for="role" class="form-label fw-bold text-dark small">Hak Akses / Role <span class="text-danger">*</span></label>
                        <select class="form-select rounded-3 py-2.5" id="role" name="role" required>
                            <option value="admin" <?php echo (($userData['role'] ?? '') === 'admin' || ($userData['role'] ?? '') === 'superadmin') ? 'selected' : ''; ?>>SuperAdmin / Administrator</option>
                            <option value="manager" <?php echo (($userData['role'] ?? '') === 'manager') ? 'selected' : ''; ?>>Manager</option>
                            <option value="staff" <?php echo (($userData['role'] ?? '') === 'staff') ? 'selected' : ''; ?>>Staff Operational</option>
                        </select>
                    </div>

                    <!-- Status Akun -->
                    <div class="col-md-12">
                        <label for="status" class="form-label fw-bold text-dark small">Status Akun</label>
                        <select class="form-select rounded-3 py-2.5" id="status" name="status">
                            <option value="active" <?php echo (($userData['status'] ?? 'active') === 'active') ? 'selected' : ''; ?>>Aktif</option>
                            <option value="inactive" <?php echo (($userData['status'] ?? '') === 'inactive') ? 'selected' : ''; ?>>Nonaktif</option>
                        </select>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex align-items-center justify-content-end gap-2">
                    <a href="<?php echo url('admin/users'); ?>" class="btn btn-light border rounded-3 px-4 py-2.5 fw-semibold text-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-success rounded-3 px-4 py-2.5 fw-bold shadow-sm d-inline-flex align-items-center gap-2" style="background-color: #2F6F3E; border-color: #2F6F3E;">
                        <i class="bi bi-check-circle-fill"></i> Simpan Data Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Instructions / Information Side Card -->
    <div class="col-lg-4">
        <div class="card-custom bg-white p-4 rounded-4 border shadow-sm">
            <h5 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                <i class="bi bi-info-circle-fill text-success"></i> Informasi Akses
            </h5>
            <ul class="text-secondary small mb-0 ps-3 leading-relaxed" style="line-height: 1.6;">
                <li class="mb-2"><strong>SuperAdmin / Administrator</strong> memiliki kewenangan penuh untuk mengelola seluruh konten website, katalog rumah, portofolio proyek, dan akun pengguna.</li>
                <li class="mb-2"><strong>Manager</strong> memiliki akses mengelola pesan konsultasi, konten katalog, serta portofolio proyek.</li>
                <li>Gunakan password yang kuat dengan kombinasi huruf, angka, dan karakter untuk menjaga keamanan sistem.</li>
            </ul>
        </div>
    </div>
</div>
