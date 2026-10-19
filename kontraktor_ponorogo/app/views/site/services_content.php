<!-- Hero Header Services -->
<section class="py-5" style="background: linear-gradient(135deg, #F8F9F6 0%, #F1F5F2 100%); border-bottom: 1px solid var(--border-color);">
    <div class="container py-4 text-center">
        <span class="section-tag mb-3"><i class="bi bi-gear-wide-connected me-1"></i> Layanan Komprehensif</span>
        <h1 class="display-4 fw-bold mb-3" style="color: var(--text-primary);">Layanan Konstruksi & <span class="highlight-text">Properti</span></h1>
        <p class="section-subtitle">
            Solusi profesional terpadu dari tahap perencanaan arsitektur, penyusunan RAB, hingga pengerjaan konstruksi dan renovasi di Ponorogo.
        </p>
    </div>
</section>

<!-- Section List Layanan Clean & Minimalis -->
<section class="py-5" style="background-color: #FFFFFF;">
    <div class="container py-4">
        <div class="row g-4 justify-content-center">
            <?php if (!empty($services)): ?>
                <?php 
                $iconMap = [
                    'home' => 'bi-house-door-fill',
                    'house' => 'bi-house-door-fill',
                    'paint' => 'bi-paint-bucket',
                    'paint-bucket' => 'bi-paint-bucket',
                    'building' => 'bi-buildings',
                    'buildings' => 'bi-buildings',
                    'pencil-ruler' => 'bi-pencil-square',
                    'pencil-square' => 'bi-pencil-square',
                    'compass' => 'bi-compass',
                    'wrench' => 'bi-wrench-adjustable',
                ];
                $delayCounter = 1;
                foreach ($services as $service): 
                    $raw = trim(str_replace('bi-', '', $service['icon'] ?? ''));
                    $iconClass = $iconMap[$raw] ?? ('bi-' . ($raw ?: 'tools'));
                ?>
                    <div class="col-md-6 col-lg-4 scroll-reveal delay-<?php echo $delayCounter; ?>">
                        <div class="card-custom p-4 h-100 bg-white border-0 shadow-sm d-flex flex-column">
                            <div class="icon-box-green mb-3">
                                <i class="bi <?php echo $iconClass; ?>"></i>
                            </div>
                            <h3 class="fw-bold mb-2" style="font-size: 1.2rem; color: var(--text-primary);"><?php echo e($service['title']); ?></h3>
                            <p class="text-secondary mb-0" style="font-size: 0.93rem; line-height: 1.65;"><?php echo e($service['description']); ?></p>
                        </div>
                    </div>
                <?php 
                    $delayCounter = ($delayCounter % 3) + 1;
                endforeach; ?>
            <?php else: ?>
                <!-- Fallback Clean Service Cards (3 Feeds) -->
                <div class="col-md-6 col-lg-4 scroll-reveal delay-1">
                    <div class="card-custom p-4 h-100 bg-white border-0 shadow-sm d-flex flex-column">
                        <div class="icon-box-green mb-3"><i class="bi bi-paint-bucket"></i></div>
                        <h3 class="fw-bold mb-2" style="font-size: 1.2rem; color: var(--text-primary);">Renovasi rumah</h3>
                        <p class="text-secondary mb-0" style="font-size: 0.93rem; line-height: 1.65;">Pelayanan renovasi interior & eksterior rumah, kantor, dan komersial.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 scroll-reveal delay-2">
                    <div class="card-custom p-4 h-100 bg-white border-0 shadow-sm d-flex flex-column">
                        <div class="icon-box-green mb-3"><i class="bi bi-pencil-square"></i></div>
                        <h3 class="fw-bold mb-2" style="font-size: 1.2rem; color: var(--text-primary);">Jasa Desain Rumah</h3>
                        <p class="text-secondary mb-0" style="font-size: 0.93rem; line-height: 1.65;">Perencanaan arsitektur, gambar 3D, denah rumah, serta estimasi perhitungan RAB.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 scroll-reveal delay-3">
                    <div class="card-custom p-4 h-100 bg-white border-0 shadow-sm d-flex flex-column">
                        <div class="icon-box-green mb-3"><i class="bi bi-buildings"></i></div>
                        <h3 class="fw-bold mb-2" style="font-size: 1.2rem; color: var(--text-primary);">Pembuatan rumah & Gedung</h3>
                        <p class="text-secondary mb-0" style="font-size: 0.93rem; line-height: 1.65;">Pembangunan rumah tinggal, villa, ruko, toko, dan gedung komersial.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Single Prominent Main CTA Button for All Services -->
        <div class="row mt-5">
            <div class="col-12 text-center scroll-reveal">
                <div class="p-4 p-md-5 rounded-4 bg-light border" style="border-color: var(--border-color) !important;">
                    <h3 class="fw-bold text-dark mb-2" style="font-size: 1.4rem;">Ingin Mendiskusikan Rencana Pembangunan Anda?</h3>
                    <p class="text-secondary mb-4 mx-auto" style="max-width: 600px; font-size: 0.98rem;">
                        Tim ahli PT Graha Lestari siap memberikan konsultasi gratis, perhitungan estimasi anggaran RAB, serta solusi terbaik untuk proyek Anda.
                    </p>
                    <a href="https://wa.me/<?php echo e(siteSetting('whatsapp_number', '6281359099658')); ?>?text=Halo%20PT%20Graha%20Lestari,%20saya%20ingin%20konsultasi%20layanan%20konstruksi" target="_blank" rel="noopener" class="btn-primary-green px-5 py-3 fs-6 shadow">
                        <i class="bi bi-whatsapp me-2 fs-5"></i> Konsultasi Gratis Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


