<!-- Hero Header Portfolio Page -->
<section class="py-5" style="background: linear-gradient(135deg, #F8F9F6 0%, #F1F5F2 100%); border-bottom: 1px solid var(--border-color);">
    <div class="container py-4 text-center">
        <span class="section-tag mb-3"><i class="bi bi-images me-1"></i> Galeri & Hasil Karya</span>
        <h1 class="display-4 fw-bold mb-3" style="color: var(--text-primary);">Portofolio <span class="highlight-text">PT Graha Lestari</span></h1>
        <p class="section-subtitle">
            Bukti nyata dedikasi dan kualitas konstruksi rumah impian, renovasi, serta pengembangan proyek komersial di Ponorogo.
        </p>
    </div>
</section>

<!-- Filter & Portfolio Items -->
<section class="py-5" style="background-color: var(--bg-offwhite);">
    <div class="container py-3">
        <!-- Filter Pills -->
        <div class="row g-4 mb-5">
            <div class="col-12 text-center">
                <div class="d-inline-flex flex-wrap gap-2 justify-content-center p-2 rounded-5 bg-white shadow-sm border" style="border-color: var(--border-color) !important;">
                    <button class="btn btn-primary-green px-4 py-2 rounded-pill filter-btn active" data-filter="all">Semua Proyek</button>
                    <button class="btn btn-outline-green px-4 py-2 rounded-pill filter-btn" data-filter="rumah">Konstruksi Rumah</button>
                    <button class="btn btn-outline-green px-4 py-2 rounded-pill filter-btn" data-filter="renovasi">Renovasi</button>
                    <button class="btn btn-outline-green px-4 py-2 rounded-pill filter-btn" data-filter="komersial">Komersial</button>
                </div>
            </div>
        </div>

        <!-- Portfolio Items Grid -->
        <div class="row g-4 portfolio-grid">
            <?php if (!empty($projects)): ?>
                <?php foreach ($projects as $project): ?>
                    <?php 
                    $catKey = strtolower($project['category'] ?? 'rumah');
                    if (str_contains($catKey, 'renovasi')) {
                        $filterCat = 'renovasi';
                    } elseif (str_contains($catKey, 'komersial') || str_contains($catKey, 'toko') || str_contains($catKey, 'kantor')) {
                        $filterCat = 'komersial';
                    } else {
                        $filterCat = 'rumah';
                    }
                    $projectImg = assetUrl($project['cover_image'] ?? '', 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80');
                    $statusStr = ($project['status'] ?? 'completed') === 'completed' ? 'Selesai' : (($project['status'] ?? '') === 'ongoing' ? 'Proses Kerjasama' : 'Perencanaan');
                    $statusBadgeBg = ($project['status'] ?? 'completed') === 'completed' ? 'bg-success text-white' : (($project['status'] ?? '') === 'ongoing' ? 'bg-warning text-dark' : 'bg-secondary text-white');
                    ?>
                    <div class="col-md-6 col-lg-4 portfolio-item scroll-reveal" data-category="<?php echo $filterCat; ?>">
                        <div class="card-custom h-100 bg-white border-0 shadow-sm overflow-hidden d-flex flex-column" style="border-radius: 20px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <!-- Image Container -->
                            <div class="position-relative overflow-hidden" style="height: 240px; background-color: #EAECE8;">
                                <img src="<?php echo $projectImg; ?>" 
                                     onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80';"
                                     class="w-100 h-100 object-fit-cover portfolio-card-img" 
                                     alt="<?php echo e($project['title']); ?>"
                                     style="transition: transform 0.5s ease;">
                                


                                <!-- Status Tag Top Right -->
                                <span class="position-absolute top-0 end-0 px-3 py-1.5 m-3 rounded-pill shadow-sm fw-bold small <?php echo $statusBadgeBg; ?>" style="font-size: 0.78rem;">
                                    <?php echo $statusStr; ?>
                                </span>
                            </div>

                            <!-- Card Body -->
                            <div class="p-4 d-flex flex-column flex-grow-1">
                                <h4 class="fw-bold mb-2" style="font-size: 1.18rem; color: var(--text-primary); line-height: 1.3;">
                                    <?php echo e($project['title']); ?>

                                </h4>

                                <div class="text-muted small mb-3 d-flex align-items-center justify-content-between flex-wrap gap-2">
                                    <span class="d-flex align-items-center gap-1">
                                        <i class="bi bi-geo-alt-fill text-success"></i>
                                        <span><?php echo e($project['location'] ?? 'Ponorogo'); ?></span>
                                    </span>
                                    <?php if (!empty($project['budget'])): ?>
                                        <span class="fw-bold text-success px-2 py-0.5 rounded bg-success-subtle" style="font-size: 0.85rem;">
                                            <?php echo e($project['budget']); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>

                                <p class="text-secondary small mb-4 line-clamp-2" style="line-height: 1.6;">
                                    <?php echo e($project['description'] ?? 'Pembangunan properti berkualitas tinggi dengan standar pengawasan ketat.'); ?>

                                </p>

                                <div class="mt-auto pt-3 border-top border-light d-flex align-items-center justify-content-between">
                                    <span class="small text-muted fw-semibold">PT Graha Lestari</span>
                                    <a href="https://wa.me/<?php echo e(siteSetting('whatsapp_number', '6281359099658')); ?>?text=Halo%20PT%20Graha%20Lestari,%20saya%20tertarik%20tanya%20detail%20proyek:%20<?php echo urlencode($project['title']); ?>" 
                                       target="_blank" rel="noopener" 
                                       class="btn btn-sm btn-outline-success rounded-pill px-3 fw-semibold">
                                        Diskusikan <i class="bi bi-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <?php if (!empty($houses)): ?>
                <?php foreach ($houses as $house): ?>
                    <?php 
                    $houseImg = assetUrl($house['cover_image'] ?? '', 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=800&q=80');
                    $isAvailable = ($house['status'] ?? 'available') === 'available';
                    ?>
                    <div class="col-md-6 col-lg-4 portfolio-item scroll-reveal" data-category="rumah">
                        <div class="card-custom h-100 bg-white border-0 shadow-sm overflow-hidden d-flex flex-column" style="border-radius: 20px; transition: transform 0.3s ease, box-shadow 0.3s ease;">
                            <!-- Image Container -->
                            <div class="position-relative overflow-hidden" style="height: 240px; background-color: #EAECE8;">
                                <img src="<?php echo $houseImg; ?>" 
                                     onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=800&q=80';"
                                     class="w-100 h-100 object-fit-cover portfolio-card-img" 
                                     alt="<?php echo e($house['title']); ?>"
                                     style="transition: transform 0.5s ease;">



                                <!-- Status Tag Top Right -->
                                <span class="position-absolute top-0 end-0 px-3 py-1.5 m-3 rounded-pill shadow-sm fw-bold small <?php echo $isAvailable ? 'bg-success text-white' : 'bg-secondary text-white'; ?>" style="font-size: 0.78rem;">
                                    <?php echo $isAvailable ? 'Tersedia' : 'Terjual'; ?>

                                </span>
                            </div>

                            <!-- Card Body -->
                            <div class="p-4 d-flex flex-column flex-grow-1">
                                <h4 class="fw-bold mb-2" style="font-size: 1.18rem; color: var(--text-primary); line-height: 1.3;">
                                    <?php echo e($house['title']); ?>

                                </h4>

                                <div class="text-muted small mb-2 d-flex align-items-center gap-2">
                                    <i class="bi bi-geo-alt-fill text-success"></i>
                                    <span><?php echo e($house['location'] ?? 'Ponorogo'); ?></span>
                                    <span class="text-muted">•</span>
                                    <span><?php echo e($house['area_size'] ?? 'Tipe Standar'); ?></span>
                                </div>

                                <div class="d-flex align-items-center gap-3 text-secondary small mb-3">
                                    <span><i class="bi bi-door-closed text-success me-1"></i><?php echo (int)($house['bedrooms'] ?? 3); ?> K. Tidur</span>
                                    <span><i class="bi bi-droplet text-success me-1"></i><?php echo (int)($house['bathrooms'] ?? 2); ?> K. Mandi</span>
                                </div>

                                <div class="mt-auto pt-3 border-top border-light d-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="small text-muted" style="font-size: 0.75rem;">Harga Unit</div>
                                        <div class="fw-bold text-success" style="font-size: 1.1rem;"><?php echo e($house['price']); ?></div>
                                    </div>
                                    <a href="https://wa.me/<?php echo e(siteSetting('whatsapp_number', '6281359099658')); ?>?text=Halo%20PT%20Graha%20Lestari,%20saya%20tertarik%20tanya%20unit%20rumah:%20<?php echo urlencode($house['title']); ?>" 
                                       target="_blank" rel="noopener" 
                                       class="btn btn-sm btn-outline-success rounded-pill px-3 fw-semibold">
                                        Tanya Unit <i class="bi bi-whatsapp ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- CTA Bottom -->
        <div class="mt-5 text-center scroll-reveal">
            <a href="https://wa.me/<?php echo e(siteSetting('whatsapp_number', '6281359099658')); ?>?text=Halo%20PT%20Graha%20Lestari,%20saya%20tertarik%20dengan%20proyek%20portofolio%20Anda" target="_blank" rel="noopener" class="btn-primary-green px-5 py-3 fs-6">
                <i class="bi bi-whatsapp me-2"></i> Konsultasikan Proyek Properti Anda
            </a>
        </div>
    </div>
</section>

<style>
.portfolio-card-img:hover {
    transform: scale(1.06);
}
.portfolio-item .card-custom:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08) !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const items = document.querySelectorAll('.portfolio-item');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => {
                b.classList.remove('btn-primary-green', 'active');
                b.classList.add('btn-outline-green');
            });
            this.classList.remove('btn-outline-green');
            this.classList.add('btn-primary-green', 'active');

            const filter = this.getAttribute('data-filter');

            items.forEach(item => {
                const cat = item.getAttribute('data-category');
                if (filter === 'all' || cat.includes(filter)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
});
</script>
