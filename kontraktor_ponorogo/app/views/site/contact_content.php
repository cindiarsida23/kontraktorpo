<!-- Hero Header Contact Page -->
<section class="py-5" style="background: linear-gradient(135deg, #F8F9F6 0%, #F1F5F2 100%); border-bottom: 1px solid var(--border-color);">
    <div class="container py-4 text-center">
        <span class="section-tag mb-3"><i class="bi bi-chat-left-dots me-1"></i> Kontak & Lokasi</span>
        <h1 class="display-4 fw-bold mb-3" style="color: var(--text-primary);">Hubungi <span class="highlight-text">PT Graha Lestari</span></h1>
        <p class="section-subtitle">
            Tim kami siap membantu kebutuhan konsultasi arsitektur, estimasi biaya RAB, dan pembangunan properti Anda di Ponorogo.
        </p>
    </div>
</section>

<!-- Contact Form & Info Section -->
<section class="py-5" style="background-color: #FFFFFF;">
    <div class="container py-4">
        <div class="row g-5">
            <!-- Left Info Column -->
            <div class="col-lg-5 scroll-reveal">
                <span class="section-tag mb-2">Informasi Kontak</span>
                <h2 class="section-title mb-4">Mari Berdiskusi Mengenai <span class="highlight-text">Proyek Anda</span></h2>
                <p class="text-secondary mb-4" style="line-height: 1.8;">
                    Kunjungi kantor kami atau hubungi kami melalui telepon & WhatsApp untuk mendapatkan konsultasi langsung dengan tim profesional PT Graha Lestari.
                </p>

                <div class="d-flex flex-column gap-3 mb-4">
                    <div class="card-custom p-3 d-flex align-items-center gap-3">
                        <div class="icon-box-green mb-0" style="width: 48px; height: 48px; font-size: 1.3rem; flex-shrink: 0;">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div>
                            <strong class="d-block text-dark" style="font-size: 0.95rem;">Alamat Kantor</strong>
                            <span class="text-muted small"><?php echo e(siteSetting('company_address', 'Jl. Raya Ponorogo, Kabupaten Ponorogo, Jawa Timur')); ?></span>
                        </div>
                    </div>

                    <div class="card-custom p-3 d-flex align-items-center gap-3">
                        <div class="icon-box-green mb-0" style="width: 48px; height: 48px; font-size: 1.3rem; flex-shrink: 0;">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <div>
                            <strong class="d-block text-dark" style="font-size: 0.95rem;">Telepon & WhatsApp</strong>
                            <span class="text-muted small">0813-5909-9658</span>
                        </div>
                    </div>

                    <div class="card-custom p-3 d-flex align-items-center gap-3">
                        <div class="icon-box-green mb-0" style="width: 48px; height: 48px; font-size: 1.3rem; flex-shrink: 0;">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <div>
                            <strong class="d-block text-dark" style="font-size: 0.95rem;">Email Resmi</strong>
                            <span class="text-muted small"><?php echo e(siteSetting('contact_email', 'info@kontraktorponorogo.com')); ?></span>
                        </div>
                    </div>

                    <div class="card-custom p-3 d-flex align-items-center gap-3">
                        <div class="icon-box-green mb-0" style="width: 48px; height: 48px; font-size: 1.3rem; flex-shrink: 0;">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                        <div>
                            <strong class="d-block text-dark" style="font-size: 0.95rem;">Jam Operasional</strong>
                            <div class="text-muted small">
                                <div><?php echo e(siteSetting('operating_hours_weekday', 'Senin - Jumat: 08:00 - 17:00 WIB')); ?></div>
                                <div class="opacity-75"><?php echo e(siteSetting('operating_hours_weekend', 'Sabtu: 08:00 - 15:00 WIB (Minggu Tutup)')); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Form Column -->
            <div class="col-lg-7 scroll-reveal">
                <div class="card-custom p-4 p-lg-5 bg-white">
                    <h3 class="fw-bold mb-4" style="color: var(--text-primary); font-size: 1.4rem;">Kirim Pesan Konsultasi</h3>
                    
                    <?php if (!empty($_SESSION['wa_forward_url'])): 
                        $waForwardUrl = $_SESSION['wa_forward_url'];
                        unset($_SESSION['wa_forward_url']);
                    ?>
                        <div class="p-4 rounded-4 bg-success-subtle border border-success mb-4 text-center">
                            <h5 class="fw-bold text-success mb-2">
                                <i class="bi bi-check-circle-fill me-2 fs-4"></i>Pesan Berhasil Tersimpan & Diteruskan!
                            </h5>
                            <p class="text-secondary small mb-3">
                                Pesan konsultasi Anda telah tersimpan di database admin. Klik tombol di bawah ini untuk langsung meneruskan ke WhatsApp Admin PT Graha Lestari.
                            </p>
                            <a href="<?php echo $waForwardUrl; ?>" target="_blank" rel="noopener" class="btn btn-success btn-lg rounded-pill px-4 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                                <i class="bi bi-whatsapp fs-5"></i> Lanjutkan Kirim ke WhatsApp Admin
                            </a>
                        </div>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                setTimeout(function() {
                                    window.open('<?php echo $waForwardUrl; ?>', '_blank');
                                }, 800);
                            });
                        </script>
                    <?php elseif (!empty($success)): ?>
                        <div class="alert alert-success border-0 rounded-3 shadow-sm mb-4">
                            <i class="bi bi-check-circle me-2"></i><?php echo e($success); ?>

                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4">
                            <i class="bi bi-exclamation-triangle me-2"></i><?php echo e($error); ?>

                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo url('contact/store'); ?>">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark small">Nama Lengkap *</label>
                                <input type="text" class="form-control p-3 rounded-3" style="border-color: var(--border-color);" name="name" placeholder="Masukkan nama Anda" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark small">Alamat Email *</label>
                                <input type="email" class="form-control p-3 rounded-3" style="border-color: var(--border-color);" name="email" placeholder="contoh@email.com" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark small">Nomor Telepon / WhatsApp</label>
                                <input type="text" class="form-control p-3 rounded-3" style="border-color: var(--border-color);" name="phone" placeholder="08123456789">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-dark small">Subjek / Jenis Proyek</label>
                                <input type="text" class="form-control p-3 rounded-3" style="border-color: var(--border-color);" name="subject" placeholder="Contoh: Konsultasi Rumah Minimalis">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold text-dark small">Detail Pesan / Rencana Bangunan *</label>
                                <textarea class="form-control p-3 rounded-3" style="border-color: var(--border-color);" name="message" rows="5" placeholder="Tuliskan lokasi lahan, rencana ukuran, atau pertanyaan Anda..." required></textarea>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn-primary-green w-100 py-3 text-center">
                                    <i class="bi bi-send-fill me-2"></i> Kirim Pesan Konsultasi
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Interactive Google Maps Location Section -->
<section class="py-5" style="background-color: var(--bg-offwhite); border-top: 1px solid var(--border-color);">
    <div class="container py-3">
        <div class="row text-center mb-4 justify-content-center">
            <div class="col-lg-8 scroll-reveal">
                <span class="section-tag mb-2"><i class="bi bi-geo-alt me-1"></i> Peta Lokasi</span>
                <h2 class="section-title">Lokasi Kantor <span class="highlight-text">PT Graha Lestari</span></h2>
                <p class="section-subtitle">Temukan lokasi kantor operasional kami di Ponorogo untuk konsultasi tatap muka langsung dengan tim kami.</p>
            </div>
        </div>

        <div class="card-custom p-2 bg-white shadow-sm scroll-reveal overflow-hidden">
            <div class="ratio ratio-21x9 rounded-4 overflow-hidden" style="min-height: 420px;">
                <iframe 
                    src="<?php echo e(siteSetting('google_maps_iframe', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126487.67499691901!2d111.40118537542967!3d-7.871146746865243!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e799f97914db48f%3A0x3027a76e352bb40!2sKabupaten%20Ponorogo%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid')); ?>" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</section>
