<div class="dashboard-shell">
    <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <div class="eyebrow" style="color: var(--sage-green); font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.08em;">Konfigurasi Sistem</div>
            <h1 class="page-title mb-1 fw-bold text-dark">Pengaturan Website & Footer</h1>
            <p class="mb-0 text-muted">Kelola deskripsi perusahaan, akun media sosial, alamat kantor, dan kontak publik.</p>
        </div>
        <div>
            <a href="<?php echo url(''); ?>" target="_blank" class="btn btn-outline-success rounded-pill px-4 py-2 fw-semibold d-inline-flex align-items-center gap-2">
                <i class="bi bi-eye"></i> Lihat Hasil di Website
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

    <form action="<?php echo url('admin/settings/store'); ?>" method="POST">
        <div class="row g-4">
            <!-- Left Column: Deskripsi & Media Sosial -->
            <div class="col-lg-7">
                <!-- Card Media Sosial -->
                <div class="card-custom p-4 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i class="bi bi-share-fill fs-5"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Media Sosial Footer</h5>
                            <small class="text-muted">Atur username dan tautan profil TikTok, Instagram, dan YouTube</small>
                        </div>
                    </div>

                    <!-- TikTok -->
                    <div class="mb-4 p-3 rounded-3" style="background-color: #F9FAFB; border: 1px solid #E5E7EB;">
                        <div class="d-flex align-items-center gap-2 mb-2 text-dark fw-bold">
                            <i class="bi bi-tiktok text-dark fs-5"></i> TikTok
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-semibold">Username TikTok</label>
                                <input type="text" name="tiktok_username" class="form-control rounded-3" value="<?php echo e($settings['tiktok_username'] ?? '@grahalestari_konstruksi'); ?>" placeholder="@username">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-semibold">Link URL TikTok</label>
                                <input type="url" name="tiktok_url" class="form-control rounded-3" value="<?php echo e($settings['tiktok_url'] ?? 'https://www.tiktok.com/@grahalestari_konstruksi'); ?>" placeholder="https://www.tiktok.com/@username">
                            </div>
                        </div>
                    </div>

                    <!-- Instagram -->
                    <div class="mb-4 p-3 rounded-3" style="background-color: #F9FAFB; border: 1px solid #E5E7EB;">
                        <div class="d-flex align-items-center gap-2 mb-2 text-dark fw-bold">
                            <i class="bi bi-instagram text-danger fs-5"></i> Instagram
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-semibold">Username Instagram</label>
                                <input type="text" name="instagram_username" class="form-control rounded-3" value="<?php echo e($settings['instagram_username'] ?? '@grahalestari_konstruksi'); ?>" placeholder="@username">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-semibold">Link URL Instagram</label>
                                <input type="url" name="instagram_url" class="form-control rounded-3" value="<?php echo e($settings['instagram_url'] ?? 'https://www.instagram.com/grahalestari_konstruksi'); ?>" placeholder="https://www.instagram.com/username">
                            </div>
                        </div>
                    </div>

                    <!-- YouTube -->
                    <div class="p-3 rounded-3" style="background-color: #F9FAFB; border: 1px solid #E5E7EB;">
                        <div class="d-flex align-items-center gap-2 mb-2 text-dark fw-bold">
                            <i class="bi bi-youtube text-danger fs-5"></i> YouTube
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-semibold">Username YouTube</label>
                                <input type="text" name="youtube_username" class="form-control rounded-3" value="<?php echo e($settings['youtube_username'] ?? '@grahalestaripropertichanne1993'); ?>" placeholder="@channel">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small fw-semibold">Link URL YouTube</label>
                                <input type="url" name="youtube_url" class="form-control rounded-3" value="<?php echo e($settings['youtube_url'] ?? 'https://www.youtube.com/@grahalestaripropertichanne1993'); ?>" placeholder="https://www.youtube.com/@channel">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Profil Perusahaan (About Text) -->
                <div class="card-custom p-4">
                    <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i class="bi bi-building fs-5"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Profil Singkat Perusahaan</h5>
                            <small class="text-muted">Ditampilkan pada kolom pertama footer website</small>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Deskripsi Footer Perusahaan</label>
                        <textarea name="footer_about_text" class="form-control rounded-3" rows="4" placeholder="Tuliskan gambaran singkat PT Graha Lestari..."><?php echo e($settings['footer_about_text'] ?? 'Perusahaan kontraktor dan developer properti terpercaya di Ponorogo. Berkomitmen menghadirkan hunian & proyek berkualitas tinggi, elegan, transparan, dan tepat waktu.'); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- Right Column: Informasi Kontak & Jam Operasional -->
            <div class="col-lg-5">
                <!-- Card Kontak & Alamat -->
                <div class="card-custom p-4 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i class="bi bi-geo-alt-fill fs-5"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Alamat & Kontak</h5>
                            <small class="text-muted">Informasi alamat fisik dan surel resmi</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Alamat Lengkap Kantor</label>
                        <textarea name="company_address" class="form-control rounded-3" rows="3" placeholder="Alamat kantor lengkap..."><?php echo e($settings['company_address'] ?? 'Jl. Raya Ponorogo, Kabupaten Ponorogo, Jawa Timur, Indonesia'); ?></textarea>
                        <small class="text-muted">Alamat ini akan ditampilkan di halaman Kontak dan Footer seluruh halaman website.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Email Kontak Publik</label>
                        <input type="email" name="contact_email" class="form-control rounded-3" value="<?php echo e($settings['contact_email'] ?? 'info@kontraktorponorogo.com'); ?>" placeholder="info@kontraktorponorogo.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Nomor WhatsApp Konsultasi</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-success fw-bold"><i class="bi bi-whatsapp"></i></span>
                            <input type="text" name="whatsapp_number" class="form-control rounded-3" value="<?php echo e($settings['whatsapp_number'] ?? '6281359099658'); ?>" placeholder="6281359099658">
                        </div>
                        <small class="text-muted">Gunakan format internasional tanpa tanda + (contoh: 6281359099658)</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Link / Embed Google Maps</label>
                        <textarea name="google_maps_iframe" class="form-control rounded-3" rows="3" placeholder="https://maps.app.goo.gl/... atau link sematkan peta"><?php echo e($settings['google_maps_iframe'] ?? 'https://maps.google.com/maps?q=-7.8558509,111.467583&z=17&output=embed'); ?></textarea>
                        <small class="text-muted"><i class="bi bi-info-circle me-1"></i>Bisa memasukkan link bagikan (maps.app.goo.gl), kode &lt;iframe&gt;, atau URL sematkan peta. Sistem akan otomatis memformatnya agar peta tampil dengan benar.</small>
                    </div>
                </div>

                <!-- Card Jam Operasional -->
                <div class="card-custom p-4 mb-4">
                    <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center" style="width: 42px; height: 42px;">
                            <i class="bi bi-clock-fill fs-5"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0 text-dark">Jam Operasional Kantor</h5>
                            <small class="text-muted">Waktu pelayanan kantor untuk klien</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Hari Kerja (Senin - Jumat)</label>
                        <input type="text" name="operating_hours_weekday" class="form-control rounded-3" value="<?php echo e($settings['operating_hours_weekday'] ?? 'Senin - Jumat: 08:00 - 17:00 WIB'); ?>" placeholder="Senin - Jumat: 08:00 - 17:00 WIB">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-dark">Akhir Pekan (Sabtu - Minggu)</label>
                        <input type="text" name="operating_hours_weekend" class="form-control rounded-3" value="<?php echo e($settings['operating_hours_weekend'] ?? 'Sabtu: 08:00 - 15:00 WIB (Minggu Tutup)'); ?>" placeholder="Sabtu: 08:00 - 15:00 WIB (Minggu Tutup)">
                    </div>
                </div>

                <!-- Action Button Card -->
                <div class="card-custom p-4 bg-light border-0 shadow-sm text-center">
                    <button type="submit" class="btn btn-primary-green btn-lg w-100 rounded-pill py-3 fw-bold shadow-sm">
                        <i class="bi bi-floppy-fill me-2"></i> Simpan Perubahan Pengaturan
                    </button>
                    <small class="text-muted d-block mt-2">Perubahan akan langsung terupdate di seluruh footer halaman website.</small>
                </div>
            </div>
        </div>
    </form>
</div>
