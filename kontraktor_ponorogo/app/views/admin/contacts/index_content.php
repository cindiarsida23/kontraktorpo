<div class="dashboard-shell">
    <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <div class="eyebrow" style="color: var(--sage-green); font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.08em;">Kotak Masuk & Pelanggan</div>
            <h1 class="page-title mb-1 fw-bold text-dark">Kelola Pesan Konsultasi</h1>
            <p class="mb-0 text-muted">Kelola pesan dan permintaan konsultasi proyek dari pengguna, teruskan ke WhatsApp Admin, dan simpan di database.</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-danger rounded-pill px-3 py-2 fw-semibold" style="font-size: 0.85rem;">
                <i class="bi bi-envelope-fill me-1"></i> <?php echo (int)($unreadCount ?? 0); ?> Pesan Baru
            </span>
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

    <!-- Table Card & Filters -->
    <div class="card-custom p-0 overflow-hidden shadow-sm">
        <div class="p-4 bg-white border-bottom d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h5 class="fw-bold mb-0 text-dark">Daftar Pesan Konsultasi</h5>
                <small class="text-muted">Total <?php echo count($contacts); ?> pesan diterima dari form website & WhatsApp</small>
            </div>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <!-- Search Input -->
                <div class="input-group input-group-sm" style="width: 220px;">
                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" id="contactSearchInput" class="form-control border-start-0" placeholder="Cari nama, email...">
                </div>

                <!-- Status Filter Pills -->
                <div class="btn-group btn-group-sm" role="group" aria-label="Status filter">
                    <button type="button" class="btn btn-outline-secondary active filter-status-btn" data-status="all">Semua</button>
                    <button type="button" class="btn btn-outline-danger filter-status-btn" data-status="new">🔴 Baru</button>
                    <button type="button" class="btn btn-outline-info filter-status-btn" data-status="read">🔵 Dibaca</button>
                    <button type="button" class="btn btn-outline-success filter-status-btn" data-status="replied">🟢 Selesai</button>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0" id="contactsTable">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4" style="width: 170px;">Waktu & Tanggal</th>
                        <th style="width: 220px;">Pengirim & Kontak</th>
                        <th style="width: 180px;">Subjek Proyek</th>
                        <th>Detail Pesan Konsultasi</th>
                        <th style="width: 140px;">Status</th>
                        <th class="pe-4 text-end" style="width: 150px;">Aksi Admin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($contacts)): ?>
                        <?php foreach ($contacts as $c): ?>
                            <?php 
                            $statusClass = match($c['status']) {
                                'new' => 'bg-danger text-white',
                                'read' => 'bg-info-subtle text-info border border-info-subtle',
                                'replied' => 'bg-success text-white',
                                default => 'bg-secondary text-white'
                            };

                            // Format WhatsApp link for Admin to reply directly to user
                            $rawPhone = preg_replace('/[^0-9]/', '', $c['phone'] ?? '');
                            if (str_starts_with($rawPhone, '0')) {
                                $rawPhone = '62' . substr($rawPhone, 1);
                            }
                            $waMessage = rawurlencode("Halo " . $c['name'] . ", terima kasih telah menghubungi PT Graha Lestari mengenai konsultasi " . ($c['subject'] ?: 'properti') . ". Tim kami siap membantu.");
                            $waUrl = !empty($rawPhone) ? "https://wa.me/{$rawPhone}?text={$waMessage}" : null;
                            ?>
                            <tr class="contact-row <?php echo $c['status'] === 'new' ? 'table-warning-subtle' : ''; ?>" data-status="<?php echo e($c['status']); ?>">
                                <td class="ps-4">
                                    <div class="fw-semibold text-dark small">
                                        <?php echo date('d M Y', strtotime($c['created_at'])); ?>
                                    </div>
                                    <small class="text-muted" style="font-size: 0.78rem;">
                                        <?php echo date('H:i', strtotime($c['created_at'])); ?> WIB
                                    </small>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark search-target-name"><?php echo e($c['name']); ?></div>
                                    <div class="small text-muted text-truncate search-target-email" style="max-width: 200px;">
                                        <i class="bi bi-envelope me-1"></i><?php echo e($c['email']); ?>
                                    </div>
                                    <?php if (!empty($c['phone'])): ?>
                                        <div class="small text-success fw-semibold search-target-phone">
                                            <i class="bi bi-whatsapp me-1"></i><?php echo e($c['phone']); ?>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border px-2.5 py-1.5 rounded-pill fw-semibold text-wrap" style="font-size: 0.8rem;">
                                        <?php echo e($c['subject'] ?: 'Konsultasi Umum'); ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="p-2.5 bg-light rounded-3 text-secondary small" style="line-height: 1.5; max-height: 90px; overflow-y: auto;">
                                        <?php echo nl2br(e($c['message'])); ?>
                                    </div>
                                </td>
                                <td>
                                    <form action="<?php echo url('admin/contacts/status/' . $c['id']); ?>" method="POST" class="d-inline">
                                        <select name="status" onchange="this.form.submit()" class="form-select form-select-sm rounded-pill fw-semibold <?php echo $statusClass; ?>" style="font-size: 0.78rem; cursor: pointer;">
                                            <option value="new" <?php echo $c['status'] === 'new' ? 'selected' : ''; ?>>🔴 Baru</option>
                                            <option value="read" <?php echo $c['status'] === 'read' ? 'selected' : ''; ?>>🔵 Dibaca</option>
                                            <option value="replied" <?php echo $c['status'] === 'replied' ? 'selected' : ''; ?>>🟢 Selesai</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="pe-4 text-end">
                                    <div class="d-flex align-items-center justify-content-end gap-1">
                                        <?php if ($waUrl): ?>
                                            <a href="<?php echo $waUrl; ?>" target="_blank" class="btn btn-sm btn-success rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 34px; height: 34px;" title="Balas via WhatsApp">
                                                <i class="bi bi-whatsapp"></i>
                                            </a>
                                        <?php endif; ?>
                                        
                                        <a href="mailto:<?php echo e($c['email']); ?>?subject=Balasan%20Konsultasi%20PT%20Graha%20Lestari" class="btn btn-sm btn-outline-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" title="Balas via Email">
                                            <i class="bi bi-reply-fill"></i>
                                        </a>

                                        <form action="<?php echo url('admin/contacts/delete/' . $c['id']); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pesan ini?');">
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle d-flex align-items-center justify-content-center" style="width: 34px; height: 34px;" title="Hapus Pesan">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                Belum ada pesan konsultasi yang masuk di database.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('contactSearchInput');
    const statusBtns = document.querySelectorAll('.filter-status-btn');
    const rows = document.querySelectorAll('.contact-row');

    let currentStatus = 'all';

    function filterTable() {
        const query = (searchInput.value || '').toLowerCase();

        rows.forEach(row => {
            const status = row.getAttribute('data-status');
            const textContent = row.textContent.toLowerCase();

            const matchesStatus = (currentStatus === 'all' || status === currentStatus);
            const matchesQuery = textContent.includes(query);

            if (matchesStatus && matchesQuery) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    if (searchInput) {
        searchInput.addEventListener('input', filterTable);
    }

    statusBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            statusBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            currentStatus = this.getAttribute('data-status');
            filterTable();
        });
    });
});
</script>
