<style>
@keyframes floatSoft2 {
    0% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(10px) rotate(1.5deg); }
    100% { transform: translateY(0px) rotate(0deg); }
}
@keyframes pulseGlowSoft {
    0% { transform: scale(1); opacity: 0.6; }
    50% { transform: scale(1.08); opacity: 0.9; }
    100% { transform: scale(1); opacity: 0.6; }
}
@keyframes slideUpNum {
    0% {
        opacity: 0;
        transform: translateY(35px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}
.hero-glow-bg {
    position: absolute;
    width: 380px;
    height: 380px;
    background: radial-gradient(circle, rgba(47, 111, 62, 0.15) 0%, rgba(107, 143, 113, 0.05) 55%, transparent 75%);
    border-radius: 50%;
    top: -40px;
    right: -40px;
    z-index: 0;
    pointer-events: none;
    animation: pulseGlowSoft 6s ease-in-out infinite;
}
.floating-badge-2 {
    animation: floatSoft2 6s ease-in-out infinite;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    background: rgba(255, 255, 255, 0.96) !important;
    border: 1px solid rgba(47, 111, 62, 0.2) !important;
    box-shadow: 0 14px 35px rgba(0, 0, 0, 0.1) !important;
}
.stat-box {
    transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    display: inline-block;
    width: 100%;
}
.stat-box:hover {
    transform: translateY(-6px);
}
.stat-number-anim {
    display: inline-block;
    animation: slideUpNum 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    will-change: transform, opacity;
}
</style>

<section class="py-5 position-relative overflow-hidden" style="background: linear-gradient(135deg, #F8F9F6 0%, #F1F5F2 100%); border-bottom: 1px solid var(--border-color);">
    <div class="container py-lg-5 py-3 position-relative" style="z-index: 2;">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 scroll-reveal">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="section-tag shadow-sm border border-success-subtle mb-0" style="padding: 0.45rem 1.2rem; font-size: 0.88rem;">
                        Developer & Kontraktor Terpercaya Ponorogo
                    </span>
                </div>
                
                <h1 class="display-4 fw-bold mb-3" style="color: var(--text-primary); line-height: 1.2; font-weight: 800;">
                    Wujudkan Hunian & Proyek Impian Bersama <span class="highlight-text" style="color: var(--primary-green);">PT Graha Lestari</span>
                </h1>

                <!-- Text Informasi dipertebal (bold) -->
                <p class="lead mb-4 fw-semibold" style="font-size: 1.15rem; line-height: 1.8; color: #1E2E22 !important; font-weight: 600;">
                    Kami menghadirkan layanan konstruksi rumah, renovasi, dan pengembangan properti berkualitas tinggi di Ponorogo dengan transparansi biaya, perencanaan matang, dan eksekusi tepat waktu.
                </p>

                <!-- Quick Trust Badges dengan Animasi Geser Ke Atas & Counter -->
                <div class="row g-3 pt-3 border-top" style="border-color: rgba(47, 111, 62, 0.2) !important;">
                    <div class="col-4">
                        <div class="stat-box">
                            <div class="fw-bold fs-3 stat-number-anim counter-val" data-target="100" data-suffix="+" style="color: var(--primary-green); font-weight: 800; animation-delay: 0.1s;">100+</div>
                            <div class="fw-bold text-dark" style="font-size: 0.92rem;">Proyek Selesai</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-box">
                            <div class="fw-bold fs-3 stat-number-anim counter-val" data-target="10" data-suffix="+" style="color: var(--primary-green); font-weight: 800; animation-delay: 0.3s;">10+</div>
                            <div class="fw-bold text-dark" style="font-size: 0.92rem;">Tahun Pengalaman</div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-box">
                            <div class="fw-bold fs-3 stat-number-anim counter-val" data-target="100" data-suffix="%" style="color: var(--primary-green); font-weight: 800; animation-delay: 0.5s;">100%</div>
                            <div class="fw-bold text-dark" style="font-size: 0.92rem;">Garansi Kualitas</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 scroll-reveal delay-1 position-relative">
                <!-- Ambient Glow Ornaments -->
                <div class="hero-glow-bg"></div>
                
                <div class="position-relative" style="z-index: 2;">
                    <div class="card-custom hero-img-card p-2 border-0 shadow-lg">
                        <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=1200&q=80" 
                             class="img-fluid w-100" 
                             alt="Proyek Properti PT Graha Lestari"
                             style="border-radius: 16px; height: 440px; object-fit: cover;">
                    </div>

                    <!-- Top Right Floating Ornament Badge -->
                    <div class="position-absolute top-0 end-0 m-3 p-2.5 px-3 rounded-pill d-flex align-items-center gap-2 floating-badge-2">
                        <i class="bi bi-patch-check-fill text-success fs-5"></i>
                        <span class="fw-bold text-dark" style="font-size: 0.85rem;">Garansi Struktur 100%</span>
                    </div>

                    <!-- Bottom Left Floating Overlay Badge -->
                    <div class="position-absolute bottom-0 start-0 m-4 p-3 rounded-4 border d-flex align-items-center gap-3 floating-badge" style="max-width: 290px;">
                        <div class="icon-box-green mb-0" style="width: 44px; height: 44px; font-size: 1.25rem; flex-shrink: 0; background-color: var(--primary-green); color: #FFFFFF;">
                            <i class="bi bi-award-fill"></i>
                        </div>
                        <div>
                            <div class="fw-bold text-dark" style="font-size: 0.92rem;">Kualitas Premium</div>
                            <div class="fw-semibold text-secondary" style="font-size: 0.78rem;">Pengawasan Berlapis & Finishing Rapi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 2. Section Katalog Rumah (1-Row Auto-Moving Carousel Slider) -->
<style>
.catalog-carousel-track {
    display: flex;
    flex-wrap: nowrap;
    gap: 1.5rem;
    overflow-x: auto;
    scroll-behavior: smooth;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
    padding-bottom: 1rem;
    padding-top: 0.5rem;
}
.catalog-carousel-track::-webkit-scrollbar {
    display: none;
}
.catalog-carousel-item {
    flex: 0 0 calc(33.333% - 1rem);
    max-width: calc(33.333% - 1rem);
}
@media (max-width: 991.98px) {
    .catalog-carousel-item {
        flex: 0 0 calc(50% - 0.75rem);
        max-width: calc(50% - 0.75rem);
    }
}
@media (max-width: 575.98px) {
    .catalog-carousel-item {
        flex: 0 0 calc(88% - 0.5rem);
        max-width: calc(88% - 0.5rem);
    }
}
.catalog-card-item {
    border-radius: 20px;
    border: 1px solid rgba(0, 0, 0, 0.08) !important;
    transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.35s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.35s ease;
    background-color: #FFFFFF;
}
.catalog-card-item:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 36px rgba(47, 111, 62, 0.12) !important;
    border-color: rgba(47, 111, 62, 0.3) !important;
}
.catalog-img-zoom {
    transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}
.catalog-card-item:hover .catalog-img-zoom {
    transform: scale(1.08);
}
.catalog-nav-btn {
    transition: all 0.25s ease;
}
.catalog-nav-btn:hover {
    transform: scale(1.08);
}
</style>

<section class="py-5" style="background-color: #FFFFFF; border-bottom: 1px solid var(--border-color);">
    <div class="container py-4">
        <!-- Section Header dengan Tombol Navigasi Slider -->
        <div class="row align-items-end mb-4">
            <div class="col-lg-8 scroll-reveal">
                <span class="section-tag"><i class="bi bi-house-gear me-1"></i> Katalog Hunian</span>
                <h2 class="section-title mb-2">Pilihan Katalog Rumah <span class="highlight-text">PT Graha Lestari</span></h2>
                <p class="section-subtitle mb-0">Gambaran umum konsep hunian modern, tipe bangunan, dan estimasi harga karya PT Graha Lestari.</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0 scroll-reveal">
                <div class="d-inline-flex gap-2">
                    <button class="btn btn-outline-success rounded-circle catalog-nav-btn d-flex align-items-center justify-content-center" id="catalogPrevBtn" aria-label="Sebelumnya" style="width: 44px; height: 44px;">
                        <i class="bi bi-chevron-left fs-5"></i>
                    </button>
                    <button class="btn btn-primary-green rounded-circle catalog-nav-btn d-flex align-items-center justify-content-center" id="catalogNextBtn" aria-label="Berikutnya" style="width: 44px; height: 44px;">
                        <i class="bi bi-chevron-right fs-5"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- 1-Row Multi-Card Auto-Moving Carousel Track -->
        <div class="position-relative catalog-slider-container scroll-reveal delay-1">
            <div class="catalog-carousel-track" id="catalogTrack">
                
                <?php 
                $displayHouses = !empty($houses) ? array_merge($houses, $houses) : [];
                if (!empty($displayHouses)): 
                ?>
                    <?php foreach ($displayHouses as $house): 
                        $houseImg = assetUrl($house['cover_image'] ?? '', 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80');
                        $isAvailable = ($house['status'] ?? 'available') === 'available';
                        $houseType = !empty($house['type']) ? $house['type'] : 'Rumah Modern';
                    ?>
                        <div class="catalog-carousel-item">
                            <a href="<?php echo url('portofolio'); ?>" class="text-decoration-none color-inherit d-block h-100">
                                <div class="card-custom h-100 bg-white shadow-sm overflow-hidden d-flex flex-column catalog-card-item">
                                    <!-- Image & Badges -->
                                    <div class="position-relative overflow-hidden" style="height: 230px; background-color: #EAECE8;">
                                        <img src="<?php echo $houseImg; ?>" 
                                             onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=800&q=80';"
                                             class="w-100 h-100 object-fit-cover catalog-img-zoom" 
                                             alt="<?php echo e($house['title']); ?>">
                                        


                                        <!-- Status Tag Top Right -->
                                        <span class="position-absolute top-0 end-0 px-3 py-1.5 m-3 rounded-pill shadow-sm fw-bold small <?php echo $isAvailable ? 'bg-success text-white' : 'bg-secondary text-white'; ?>" style="font-size: 0.78rem;">
                                            <?php echo $isAvailable ? 'Tersedia' : 'Terjual'; ?>
                                        </span>
                                    </div>

                                    <!-- Card Body -->
                                    <div class="p-4 d-flex flex-column flex-grow-1">
                                        <h4 class="fw-bold mb-2 text-dark" style="font-size: 1.15rem; line-height: 1.3;">
                                            <?php echo e($house['title']); ?>
                                        </h4>

                                        <div class="text-muted small mb-3 d-flex align-items-center gap-2 flex-wrap">
                                            <span class="d-flex align-items-center gap-1">
                                                <i class="bi bi-geo-alt-fill text-success"></i> <?php echo e($house['location'] ?? 'Ponorogo'); ?>
                                            </span>
                                            <span>•</span>
                                            <span class="fw-semibold text-dark"><?php echo e($house['area_size'] ?? 'Tipe Standar'); ?></span>
                                        </div>

                                        <!-- Room Specs -->
                                        <div class="d-flex align-items-center gap-3 text-secondary small mb-3 p-2.5 rounded-3" style="background-color: var(--sage-light);">
                                            <span class="d-flex align-items-center gap-1.5 fw-semibold text-dark">
                                                <i class="bi bi-door-closed-fill text-success"></i> <?php echo (int)($house['bedrooms'] ?? 2); ?> Kamar
                                            </span>
                                            <span class="text-muted">|</span>
                                            <span class="d-flex align-items-center gap-1.5 fw-semibold text-dark">
                                                <i class="bi bi-droplet-fill text-success"></i> <?php echo (int)($house['bathrooms'] ?? 1); ?> KM
                                            </span>
                                        </div>

                                        <p class="text-secondary small mb-4 line-clamp-2" style="line-height: 1.6;">
                                            <?php echo e($house['description'] ?? 'Pembangunan rumah impian berkualitas tinggi dengan standar pengawasan terbaik.'); ?>
                                        </p>

                                        <!-- Price & CTA Button -->
                                        <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                                            <div>
                                                <span class="extra-small text-muted d-block" style="font-size: 0.72rem; letter-spacing: 0.04em;">ESTIMASI BIAYA</span>
                                                <span class="fw-bold text-success" style="font-size: 0.95rem;"><?php echo e($house['price'] ?? 'Rp. 3.500.000/m2'); ?></span>
                                            </div>
                                            <span class="btn btn-sm btn-outline-success rounded-pill px-3 fw-semibold">
                                                Detail <i class="bi bi-arrow-right ms-1"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>

        <!-- Catalog Footer CTA Button -->
        <div class="mt-4 text-center scroll-reveal">
            <a href="<?php echo url('portofolio'); ?>" class="btn btn-outline-success rounded-pill px-4 py-2.5 fw-bold">
                Lihat Seluruh Katalog & Portofolio Lengkap <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- 3. Section Tentang Perusahaan (Brief Summary) -->
<section class="py-5" style="background-color: #FFFFFF;">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 scroll-reveal">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1504307651254-35680f356dfd?auto=format&fit=crop&w=1000&q=80" 
                         alt="Tentang PT Graha Lestari" 
                         class="img-fluid rounded-4 shadow-sm w-100" 
                         style="height: 380px; object-fit: cover;">
                    <div class="position-absolute top-0 end-0 m-3 p-3 bg-white rounded-3 shadow-sm border text-center d-block" style="max-width: 170px;">
                        <i class="bi bi-building-check text-success fs-2"></i>
                        <div class="fw-bold small text-dark mt-1">Developer Terpercaya</div>
                        <div class="extra-small text-muted" style="font-size: 0.75rem;">Ponorogo & Sekitarnya</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 scroll-reveal delay-1">
                <span class="section-tag">Tentang Kami</span>
                <h2 class="section-title">Mengenal Lebih Dekat <span class="highlight-text">PT Graha Lestari</span></h2>
                <p class="text-secondary mb-4" style="line-height: 1.7; font-size: 1.02rem;">
                    PT Graha Lestari adalah perusahaan kontraktor dan developer properti profesional berkedudukan di Ponorogo. Kami berdedikasi menciptakan karya arsitektur hunian impian, renovasi gedung, dan proyek komersial dengan mengutamakan legalitas resmi, kerapian hasil pekerjaan, serta efisiensi anggaran biaya.
                </p>

                <div class="row g-3 mb-4">
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-2 text-dark fw-semibold">
                            <i class="bi bi-patch-check-fill text-success fs-5"></i>
                            <span>Legalitas Resmi & Terjamin</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-2 text-dark fw-semibold">
                            <i class="bi bi-patch-check-fill text-success fs-5"></i>
                            <span>RAB Transparan Tanpa Hidden Cost</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-2 text-dark fw-semibold">
                            <i class="bi bi-patch-check-fill text-success fs-5"></i>
                            <span>Pengawasan Kualitas Berlapis</span>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="d-flex align-items-center gap-2 text-dark fw-semibold">
                            <i class="bi bi-patch-check-fill text-success fs-5"></i>
                            <span>Serah Terima Tepat Waktu</span>
                        </div>
                    </div>
                </div>

                <a href="<?php echo url('tentang-kami'); ?>" class="btn btn-outline-success rounded-pill px-4 py-2.5 fw-semibold">
                    Pelajari Selengkapnya Tentang Kami <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- 3. Section Mengapa Memilih PT Graha Lestari (6 Core Advantage Cards) -->
<section class="py-5" style="background-color: var(--bg-offwhite);">
    <div class="container py-4">
        <div class="row text-center mb-5 justify-content-center">
            <div class="col-lg-8 scroll-reveal">
                <span class="section-tag">Keunggulan Utama</span>
                <h2 class="section-title">Mengapa Memilih <span class="highlight-text">PT Graha Lestari</span>?</h2>
                <p class="section-subtitle">Solusi lengkap dan terpercaya untuk seluruh kebutuhan pembangunan rumah impian & proyek bisnis Anda di Ponorogo.</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- 1. Konsultasi Gratis -->
            <div class="col-md-6 col-lg-4 scroll-reveal delay-1">
                <div class="card-custom p-4 h-100 bg-white">
                    <div class="icon-box-green">
                        <i class="bi bi-headset"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="font-size: 1.2rem;">Konsultasi Gratis</h4>
                    <p class="text-secondary mb-0 small" style="line-height: 1.6;">
                        Diskusi denah, konsep arsitektur, dan perencanaan kebutuhan bangunan Anda secara komprehensif tanpa dipungut biaya apapun.
                    </p>
                </div>
            </div>

            <!-- 2. Survey Lokasi -->
            <div class="col-md-6 col-lg-4 scroll-reveal delay-2">
                <div class="card-custom p-4 h-100 bg-white">
                    <div class="icon-box-green">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="font-size: 1.2rem;">Survey Lokasi</h4>
                    <p class="text-secondary mb-0 small" style="line-height: 1.6;">
                        Tim teknis kami siap datang langsung ke lokasi proyek Anda di wilayah Ponorogo untuk pengukuran dan pemetaan lahan presisi.
                    </p>
                </div>
            </div>

            <!-- 3. Estimasi Biaya Transparan -->
            <div class="col-md-6 col-lg-4 scroll-reveal delay-3">
                <div class="card-custom p-4 h-100 bg-white">
                    <div class="icon-box-green">
                        <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="font-size: 1.2rem;">Estimasi Biaya Transparan</h4>
                    <p class="text-secondary mb-0 small" style="line-height: 1.6;">
                        Penyusunan Rencana Anggaran Biaya (RAB) yang jujur, rasional, dan terinci tanpa adanya biaya tersembunyi (*hidden cost*).
                    </p>
                </div>
            </div>

            <!-- 4. Tim Profesional -->
            <div class="col-md-6 col-lg-4 scroll-reveal delay-1">
                <div class="card-custom p-4 h-100 bg-white">
                    <div class="icon-box-green">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="font-size: 1.2rem;">Tim Profesional</h4>
                    <p class="text-secondary mb-0 small" style="line-height: 1.6;">
                        Didukung oleh arsitek, insinyur sipil, dan tenaga kerja teknis yang berpengalaman tinggi di bidang konstruksi properti.
                    </p>
                </div>
            </div>

            <!-- 5. Pengerjaan Tepat Waktu -->
            <div class="col-md-6 col-lg-4 scroll-reveal delay-2">
                <div class="card-custom p-4 h-100 bg-white">
                    <div class="icon-box-green">
                        <i class="bi bi-stopwatch-fill"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="font-size: 1.2rem;">Pengerjaan Tepat Waktu</h4>
                    <p class="text-secondary mb-0 small" style="line-height: 1.6;">
                        Manajerial waktu proyek yang terencana ketat demi menjamin penyelesaian pekerjaan sesuai kesepakatan jadwal serah terima.
                    </p>
                </div>
            </div>

            <!-- 6. Garansi Pekerjaan -->
            <div class="col-md-6 col-lg-4 scroll-reveal delay-3">
                <div class="card-custom p-4 h-100 bg-white">
                    <div class="icon-box-green">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4 class="fw-bold mb-2" style="font-size: 1.2rem;">Garansi Pekerjaan</h4>
                    <p class="text-secondary mb-0 small" style="line-height: 1.6;">
                        Garansi pemeliharaan pasca konstruksi untuk memastikan ketahanan struktur serta memberikan rasa tenang bagi Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- 5. Section Layanan Utama (Services Section) -->
<section class="py-5" style="background-color: var(--bg-offwhite);">
    <div class="container py-4">
        <div class="row text-center mb-5 justify-content-center">
            <div class="col-lg-8 scroll-reveal">
                <span class="section-tag">Layanan Utama</span>
                <h2 class="section-title">Layanan Terbaik Dari <span class="highlight-text">PT Graha Lestari</span></h2>
                <p class="section-subtitle">Solusi komprehensif mulai dari pembangunan rumah baru, renovasi total, hingga gedung komersial.</p>
            </div>
        </div>

        <div class="row g-4 justify-content-center">
            <?php if (!empty($services)): ?>
                <?php foreach ($services as $service): 
                    $rawIcon = trim($service['icon'] ?? 'tools');
                    $iconMap = [
                        'home' => 'house-door-fill',
                        'paint' => 'paint-bucket',
                        'paint-bucket' => 'paint-bucket',
                        'pencil-ruler' => 'pencil-square',
                        'pencil-square' => 'pencil-square',
                        'compass' => 'compass',
                        'building' => 'buildings',
                        'buildings' => 'buildings',
                        'wrench' => 'wrench-adjustable',
                    ];
                    $cleanIcon = str_replace('bi-', '', $iconMap[$rawIcon] ?? $rawIcon);
                    $iconClass = 'bi-' . ($cleanIcon ?: 'tools');
                ?>
                    <div class="col-md-6 col-lg-4 scroll-reveal">
                        <div class="card-custom p-4 h-100 bg-white text-center d-flex flex-column justify-content-between">
                            <div>
                                <div class="icon-box-green mx-auto">
                                    <i class="bi <?php echo $iconClass; ?>"></i>
                                </div>
                                <h4 class="fw-bold mb-3" style="font-size: 1.2rem;"><?php echo e($service['title']); ?></h4>
                                <p class="text-secondary small mb-0" style="line-height: 1.6;">
                                    <?php echo e($service['description']); ?>

                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Fallback Services Cards if Database is Empty (3 Feeds) -->
                <div class="col-md-6 col-lg-4 scroll-reveal">
                    <div class="card-custom p-4 h-100 bg-white text-center">
                        <div class="icon-box-green mx-auto"><i class="bi bi-paint-bucket"></i></div>
                        <h4 class="fw-bold mb-3" style="font-size: 1.2rem;">Renovasi rumah</h4>
                        <p class="text-secondary small mb-0">Pelayanan renovasi interior & eksterior rumah, kantor, dan komersial.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 scroll-reveal">
                    <div class="card-custom p-4 h-100 bg-white text-center">
                        <div class="icon-box-green mx-auto"><i class="bi bi-pencil-square"></i></div>
                        <h4 class="fw-bold mb-3" style="font-size: 1.2rem;">Jasa Desain Rumah</h4>
                        <p class="text-secondary small mb-0">Perencanaan arsitektur, gambar 3D, denah rumah, serta estimasi perhitungan RAB.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 scroll-reveal">
                    <div class="card-custom p-4 h-100 bg-white text-center">
                        <div class="icon-box-green mx-auto"><i class="bi bi-buildings"></i></div>
                        <h4 class="fw-bold mb-3" style="font-size: 1.2rem;">Pembuatan rumah & Gedung</h4>
                        <p class="text-secondary small mb-0">Pembangunan rumah tinggal, villa, ruko, toko, dan gedung komersial.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Single Main WhatsApp CTA for Services Section -->
        <div class="mt-5 text-center scroll-reveal">
            <a href="https://wa.me/<?php echo e(siteSetting('whatsapp_number', '6281359099658')); ?>?text=Halo%20PT%20Graha%20Lestari,%20saya%20tertarik%20dengan%20layanan%20konstruksi%20Anda" target="_blank" rel="noopener" class="btn-primary-green px-5 py-3 fs-6">
                <i class="bi bi-whatsapp me-2"></i> Diskusikan Proyek Anda Sekarang
            </a>
        </div>
    </div>
</section>

<!-- 6. Section Testimoni Klien (Client Reviews) -->
<section class="py-5" style="background-color: #FFFFFF;">
    <div class="container py-4">
        <div class="row text-center mb-5 justify-content-center">
            <div class="col-lg-8 scroll-reveal">
                <span class="section-tag">Ulasan Klien</span>
                <h2 class="section-title">Kepuasan & Kepercayaan <span class="highlight-text">Klien Kami</span></h2>
                <p class="section-subtitle">Pengalaman nyata dari pemilik rumah dan pengembang usaha yang mempercayakan proyeknya kepada PT Graha Lestari.</p>
            </div>
        </div>

        <div class="row g-4">
            <?php if (!empty($testimonials)): ?>
                <?php foreach ($testimonials as $testimonial): ?>
                    <div class="col-md-4 scroll-reveal">
                        <div class="card-custom p-4 h-100 bg-white d-flex flex-column justify-content-between border">
                            <div>
                                <div class="d-flex gap-1 mb-3" style="color: var(--soft-gold);">
                                    <?php 
                                    $rating = (int)($testimonial['rating'] ?? 5);
                                    for ($i = 0; $i < 5; $i++): 
                                        if ($i < $rating): ?>
                                            <i class="bi bi-star-fill"></i>
                                        <?php else: ?>
                                            <i class="bi bi-star"></i>
                                        <?php endif;
                                    endfor; 
                                    ?>
                                </div>
                                <p class="text-secondary mb-4" style="font-size: 0.95rem; font-style: italic; line-height: 1.7;">
                                    "<?php echo e($testimonial['message']); ?>"
                                </p>
                            </div>
                            <div class="d-flex align-items-center gap-3 pt-3 border-top" style="border-color: var(--border-color) !important;">
                                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 44px; height: 44px; background-color: var(--sage-light); color: var(--primary-green); flex-shrink: 0;">
                                    <?php echo strtoupper(substr($testimonial['client_name'], 0, 1)); ?>
                                </div>
                                <div>
                                    <div class="fw-bold text-dark" style="font-size: 0.95rem;"><?php echo e($testimonial['client_name']); ?></div>
                                    <div class="small text-muted"><?php echo e($testimonial['company_name'] ?? 'Klien PT Graha Lestari'); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- 7. Section CTA Consultation Banner (High Converting) -->
<section class="py-5" style="background-color: var(--bg-offwhite);">
    <div class="container py-3">
        <div class="p-5 rounded-4 position-relative overflow-hidden shadow-lg" style="background: linear-gradient(135deg, var(--primary-green) 0%, #1E2E22 100%); color: #FFFFFF;">
            <div class="row align-items-center position-relative" style="z-index: 2;">
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <span class="badge bg-white text-success px-3 py-2 rounded-pill fw-bold mb-3" style="font-size: 0.85rem;">Konsultasi Tanpa Biaya</span>
                    <h2 class="display-6 fw-bold text-white mb-3">Siap Membangun Hunian & Proyek Impian Anda di Ponorogo?</h2>
                    <p class="lead text-white-50 mb-0" style="font-size: 1.05rem; line-height: 1.6;">
                        Hubungi tim ahli kami sekarang untuk konsultasi denah, survey lokasi gratis, dan estimasi biaya (RAB) yang transparan.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="https://wa.me/<?php echo e(siteSetting('whatsapp_number', '6281359099658')); ?>?text=Halo%20PT%20Graha%20Lestari,%20saya%20ingin%20konsultasi%20gratis%20sekarang" target="_blank" rel="noopener" class="btn btn-light btn-lg px-4 py-3 rounded-pill fw-bold text-success shadow-sm" style="font-family: 'Plus Jakarta Sans', sans-serif;">
                        <i class="bi bi-whatsapp me-2"></i> Konsultasi Gratis Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let countersAnimated = false;
    const counterElements = document.querySelectorAll('.counter-val');

    function animateNumbers() {
        if (countersAnimated) return;
        countersAnimated = true;

        counterElements.forEach(el => {
            const target = parseInt(el.getAttribute('data-target'));
            const suffix = el.getAttribute('data-suffix') || '';
            let current = 0;
            const step = Math.max(1, Math.ceil(target / 45));
            
            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    el.textContent = target + suffix;
                    clearInterval(timer);
                } else {
                    el.textContent = current + suffix;
                }
            }, 25);
        });
    }

    // Trigger on IntersectionObserver
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                animateNumbers();
            }
        });
    }, { threshold: 0.2 });

    counterElements.forEach(el => observer.observe(el));

    // Catalog Slider Auto-Moving ("Slider Bergerak Sendiri") Controls
    const catalogTrack = document.getElementById('catalogTrack');
    const catalogPrevBtn = document.getElementById('catalogPrevBtn');
    const catalogNextBtn = document.getElementById('catalogNextBtn');

    if (catalogTrack) {
        let autoMoveInterval = null;
        let isUserInteracting = false;
        const moveSpeedMs = 2500; // Bergerak otomatis setiap 2.5 detik

        function getCardWidth() {
            const firstCard = catalogTrack.querySelector('.catalog-carousel-item');
            return firstCard ? firstCard.offsetWidth + 24 : 360;
        }

        function slideNext() {
            if (isUserInteracting) return;
            const maxScroll = catalogTrack.scrollWidth - catalogTrack.clientWidth;
            if (catalogTrack.scrollLeft >= maxScroll - 20) {
                catalogTrack.scrollTo({ left: 0, behavior: 'smooth' });
            } else {
                catalogTrack.scrollBy({ left: getCardWidth(), behavior: 'smooth' });
            }
        }

        function slidePrev() {
            if (catalogTrack.scrollLeft <= 20) {
                const maxScroll = catalogTrack.scrollWidth - catalogTrack.clientWidth;
                catalogTrack.scrollTo({ left: maxScroll, behavior: 'smooth' });
            } else {
                catalogTrack.scrollBy({ left: -getCardWidth(), behavior: 'smooth' });
            }
        }

        function startAutoMove() {
            stopAutoMove();
            autoMoveInterval = setInterval(slideNext, moveSpeedMs);
        }

        function stopAutoMove() {
            if (autoMoveInterval) {
                clearInterval(autoMoveInterval);
                autoMoveInterval = null;
            }
        }

        // Jalankan pergerakan otomatis secara kontinyu
        startAutoMove();

        // Jedakan pergerakan otomatis saat kursor di atas slider atau disapu di HP
        catalogTrack.addEventListener('mouseenter', function() { isUserInteracting = true; });
        catalogTrack.addEventListener('mouseleave', function() { isUserInteracting = false; });
        catalogTrack.addEventListener('touchstart', function() { isUserInteracting = true; }, { passive: true });
        catalogTrack.addEventListener('touchend', function() { 
            setTimeout(function() { isUserInteracting = false; }, 2000); 
        }, { passive: true });

        // Kontrol Manual Tombol Panah
        if (catalogPrevBtn) {
            catalogPrevBtn.addEventListener('click', function() {
                stopAutoMove();
                slidePrev();
                startAutoMove();
            });
        }

        if (catalogNextBtn) {
            catalogNextBtn.addEventListener('click', function() {
                stopAutoMove();
                slideNext();
                startAutoMove();
            });
        }
    }
});
</script>
