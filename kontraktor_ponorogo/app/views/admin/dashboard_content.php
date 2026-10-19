<div class="dashboard-shell">
    <!-- Top Stats Row (3 Key Metrics Cards) -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stats-card house-card h-100 p-4 bg-white rounded-4 border shadow-sm">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="rounded-circle bg-success-subtle text-success p-2.5 d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; font-size: 1.3rem;">
                        <i class="bi bi-house-door-fill"></i>
                    </div>
                    <span class="badge bg-success-subtle text-success rounded-pill px-2.5 py-1 fw-bold extra-small">Aktif</span>
                </div>
                <div class="text-muted small fw-semibold">Katalog Rumah</div>
                <h2 class="fw-bold text-dark my-1" style="font-size: 1.8rem;"><?php echo (int)($houseCount ?? 0); ?></h2>
                <div class="text-muted extra-small" style="font-size: 0.78rem;">Properti siap dipasarkan</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stats-card project-card h-100 p-4 bg-white rounded-4 border shadow-sm">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="rounded-circle bg-success-subtle text-success p-2.5 d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; font-size: 1.3rem;">
                        <i class="bi bi-diagram-3-fill"></i>
                    </div>
                    <span class="badge bg-success-subtle text-success rounded-pill px-2.5 py-1 fw-bold extra-small">Berjalan</span>
                </div>
                <div class="text-muted small fw-semibold">Portofolio Proyek</div>
                <h2 class="fw-bold text-dark my-1" style="font-size: 1.8rem;"><?php echo (int)($projectCount ?? 0); ?></h2>
                <div class="text-muted extra-small" style="font-size: 0.78rem;">Proyek konstruksi aktif</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stats-card contact-card h-100 p-4 bg-white rounded-4 border shadow-sm">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="rounded-circle bg-success-subtle text-success p-2.5 d-flex align-items-center justify-content-center" style="width: 46px; height: 46px; font-size: 1.3rem;">
                        <i class="bi bi-chat-left-text-fill"></i>
                    </div>
                    <span class="badge bg-success text-white rounded-pill px-2.5 py-1 fw-bold extra-small" style="background-color: #2F6F3E !important;"><?php echo (int)($contactNew ?? 0); ?> Baru</span>
                </div>
                <div class="text-muted small fw-semibold">Pesan Konsultasi</div>
                <h2 class="fw-bold text-dark my-1" style="font-size: 1.8rem;"><?php echo (int)($contactCount ?? 0); ?></h2>
                <div class="text-muted extra-small" style="font-size: 0.78rem;">Masuk dari form website</div>
            </div>
        </div>
    </div>

    <!-- Main 2-Column Content Layout (Matching Reference Design) -->
    <div class="row g-4">
        
        <!-- LEFT COLUMN (8 Cols): Statistik Grafik + Pesan Terbaru Table -->
        <div class="col-lg-8">
            <!-- 1. STATISTIK Card with Interactive Chart -->
            <div class="card-custom bg-white p-4 mb-4 rounded-4 border shadow-sm">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <div class="eyebrow text-uppercase fw-bold text-muted extra-small" style="letter-spacing: 0.08em; font-size: 0.75rem;">STATISTIK</div>
                        <h4 class="fw-bold text-dark mb-0" style="font-size: 1.25rem;">Grafik Status Pesan & Properti</h4>
                    </div>
                    <a href="<?php echo url('admin/contacts'); ?>" class="btn btn-sm btn-light border rounded-3 px-3 py-1.5 fw-semibold d-inline-flex align-items-center gap-1.5 text-secondary" style="font-size: 0.85rem;">
                        <i class="bi bi-box-arrow-up-right"></i> Detail
                    </a>
                </div>

                <!-- Chart Canvas Box -->
                <div style="position: relative; height: 260px; width: 100%;">
                    <canvas id="statusOverviewChart"></canvas>
                </div>
            </div>

            <!-- 2. Pesan Terbaru Table Card -->
            <div class="card-custom bg-white p-0 rounded-4 border shadow-sm overflow-hidden">
                <div class="p-4 border-bottom d-flex align-items-center justify-content-between">
                    <div>
                        <div class="eyebrow text-uppercase fw-bold text-muted extra-small" style="letter-spacing: 0.08em; font-size: 0.75rem;">KOMUNIKASI</div>
                        <h5 class="fw-bold text-dark mb-0">Pesan Terbaru</h5>
                    </div>
                    <a href="<?php echo url('admin/contacts'); ?>" class="btn btn-sm btn-outline-success rounded-pill px-3 py-1 fw-semibold" style="font-size: 0.82rem; color: #2F6F3E; border-color: #2F6F3E;">
                        Lihat Semua Pesan <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4" style="font-size: 0.82rem;">Nama</th>
                                <th style="font-size: 0.82rem;">Email</th>
                                <th style="font-size: 0.82rem;">Subjek Proyek</th>
                                <th class="pe-4 text-end" style="font-size: 0.82rem;">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($latestContacts)): ?>
                                <?php foreach ($latestContacts as $c): ?>
                                    <tr>
                                        <td class="ps-4 fw-semibold text-dark"><?php echo e($c['name']); ?></td>
                                        <td class="text-secondary small"><?php echo e($c['email']); ?></td>
                                        <td>
                                            <span class="badge bg-light text-dark border px-2.5 py-1 rounded-pill fw-normal" style="font-size: 0.78rem;">
                                                <?php echo e($c['subject'] ?: 'Konsultasi Umum'); ?>

                                            </span>
                                        </td>
                                        <td class="pe-4 text-end text-muted extra-small" style="font-size: 0.78rem;">
                                            <?php echo date('d M H:i', strtotime($c['created_at'])); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted small">Belum ada pesan terbaru yang masuk.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN (4 Cols): ADMIN Aksi Cepat & Info Sistem Panel -->
        <div class="col-lg-4">
            <div class="card-custom bg-white p-4 rounded-4 border shadow-sm h-100">
                <div class="mb-4">
                    <div class="eyebrow text-uppercase fw-bold text-muted extra-small" style="letter-spacing: 0.08em; font-size: 0.75rem;">ADMIN</div>
                    <h4 class="fw-bold text-dark mb-0 d-flex align-items-center gap-1.5" style="font-size: 1.25rem;">
                        <i class="bi bi-lightning-charge-fill text-success"></i> Aksi Cepat
                    </h4>
                </div>

                <!-- Info Box 1: Versi Sistem -->
                <div class="p-3 rounded-4 mb-3 bg-light border d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; font-size: 1.1rem;">
                            <i class="bi bi-hdd-stack-fill"></i>
                        </div>
                        <div>
                            <div class="fw-bold text-dark" style="font-size: 0.92rem;">Versi Sistem</div>
                            <small class="text-muted" style="font-size: 0.78rem;">v1.0.0 – PT Graha Lestari</small>
                        </div>
                    </div>
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1 extra-small fw-bold">Aktif</span>
                </div>

                <!-- Info Box 2: Hak Akses -->
                <div class="p-3 rounded-4 mb-4 bg-light border d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-success-subtle text-success d-flex align-items-center justify-content-center" style="width: 42px; height: 42px; font-size: 1.1rem;">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <div>
                            <div class="fw-bold text-dark" style="font-size: 0.92rem;">Hak Akses</div>
                            <small class="text-muted" style="font-size: 0.78rem;">SuperAdmin (Akses Penuh)</small>
                        </div>
                    </div>
                </div>

                <!-- Stacked Action Buttons matching Reference UI -->
                <div class="d-flex flex-column gap-2.5">
                    <!-- Primary Green Action Button -->
                    <a href="<?php echo url('admin/houses/create'); ?>" class="btn btn-success rounded-3 py-2.5 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2" style="font-size: 0.92rem; background-color: #2F6F3E; border-color: #2F6F3E;">
                        <i class="bi bi-plus-lg"></i> Tambah Rumah Baru
                    </a>

                    <a href="<?php echo url('admin/projects/create'); ?>" class="btn btn-light border rounded-3 py-2.5 fw-semibold text-secondary d-flex align-items-center justify-content-center gap-2" style="font-size: 0.9rem;">
                        <i class="bi bi-building"></i> Tambah Proyek Baru
                    </a>

                    <a href="<?php echo url('admin/contacts'); ?>" class="btn btn-light border rounded-3 py-2.5 fw-semibold text-secondary d-flex align-items-center justify-content-center gap-2" style="font-size: 0.9rem;">
                        <i class="bi bi-chat-left-dots-fill"></i> Kelola Pesan Konsultasi
                    </a>

                    <a href="<?php echo url('admin/settings'); ?>" class="btn btn-light border rounded-3 py-2.5 fw-semibold text-secondary d-flex align-items-center justify-content-center gap-2" style="font-size: 0.9rem;">
                        <i class="bi bi-gear-fill"></i> Pengaturan Website
                    </a>

                    <a href="<?php echo url('admin/structure'); ?>" class="btn btn-light border rounded-3 py-2.5 fw-semibold text-secondary d-flex align-items-center justify-content-center gap-2" style="font-size: 0.9rem;">
                        <i class="bi bi-diagram-3-fill"></i> Struktur Perusahaan
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Render Chart.js Bar Chart -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('statusOverviewChart');
    if (!ctx) return;

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Pending / Baru', 'Diproses', 'Selesai', 'Rumah Ready'],
            datasets: [{
                label: 'Jumlah Data',
                data: [
                    <?php echo (int)($contactNew ?? 0); ?>,
                    <?php echo (int)($contactRead ?? 0); ?>,
                    <?php echo (int)($contactReplied ?? 0); ?>,
                    <?php echo (int)($houseAvailable ?? 0); ?>

                ],
                backgroundColor: [
                    'rgba(47, 111, 62, 0.85)',   // Brand Green (#2F6F3E)
                    'rgba(25, 135, 84, 0.85)',   // Forest Green (#198754)
                    'rgba(82, 183, 136, 0.85)',  // Mint Green (#52B788)
                    'rgba(116, 198, 157, 0.85)'  // Sage Light (#74C69D)
                ],
                borderColor: [
                    '#2F6F3E',
                    '#198754',
                    '#52B788',
                    '#74C69D'
                ],
                borderWidth: 1.5,
                borderRadius: 8,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(30, 46, 34, 0.95)',
                    padding: 10,
                    cornerRadius: 8
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            family: 'Plus Jakarta Sans',
                            size: 11,
                            weight: '600'
                        },
                        color: '#6C757D'
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0,
                        font: {
                            family: 'Plus Jakarta Sans',
                            size: 11
                        },
                        color: '#6C757D'
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.04)'
                    }
                }
            }
        }
    });
});
</script>
