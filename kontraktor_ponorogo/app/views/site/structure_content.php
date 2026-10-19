<!-- Hero Header Structure Page -->
<section class="py-5" style="background: linear-gradient(135deg, #F8F9F6 0%, #F1F5F2 100%); border-bottom: 1px solid var(--border-color);">
    <div class="container py-4 text-center">
        <span class="section-tag mb-3"><i class="bi bi-diagram-3 me-1"></i> Manajemen & Organisasi</span>
        <h1 class="display-4 fw-bold mb-3" style="color: var(--text-primary);">Struktur Perusahaan <span class="highlight-text">PT. Graha Lestari Karya Utama</span></h1>
        <p class="section-subtitle">
            Bagan hirarki resmi kepemimpinan, manajemen, dan divisi operasional yang berdedikasi mengawal setiap proyek properti Anda.
        </p>
    </div>
</section>

<!-- Interactive Organizational Structure Chart -->
<section class="py-5" style="background-color: #FFFFFF;">
    <div class="container py-4">
        <div class="row text-center mb-5 justify-content-center">
            <div class="col-lg-8 scroll-reveal">
                <span class="section-tag">Bagan Resmi</span>
                <h2 class="section-title">Struktur Organisasi <span class="highlight-text">Perusahaan</span></h2>
                <p class="section-subtitle">Bagan hirarki manajemen PT. Graha Lestari Karya Utama.</p>
            </div>
        </div>

        <!-- Mobile Touch Scroll Hint -->
        <div class="d-block d-md-none text-center mb-3">
            <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold" style="font-size: 0.8rem;">
                <i class="bi bi-hand-index-thumb me-1"></i> Geser ke samping untuk melihat bagan lengkap
            </span>
        </div>

        <!-- Custom Organizational Chart Box -->
        <div class="p-4 p-md-5 bg-white rounded-4 border shadow-sm scroll-reveal overflow-x-auto" style="border-color: var(--border-color) !important;">
            
            <style>
                .org-chart-wrapper {
                    min-width: 840px;
                    padding: 2rem 1rem;
                    position: relative;
                }

                .org-node {
                    display: inline-flex;
                    flex-direction: column;
                    align-items: center;
                    margin: 0 auto;
                    position: relative;
                    z-index: 2;
                }

                /* Profile Photo Holder */
                .org-avatar {
                    width: 68px;
                    height: 68px;
                    border-radius: 50%;
                    background-color: #F0F5F1;
                    border: 3px solid #2F6F3E;
                    box-shadow: 0 4px 12px rgba(47, 111, 62, 0.2);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    color: #2F6F3E;
                    font-size: 1.7rem;
                    margin-bottom: -14px;
                    z-index: 4;
                    overflow: hidden;
                    transition: transform 0.3s ease, border-color 0.3s ease;
                }

                .org-avatar img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }

                .org-node:hover .org-avatar {
                    transform: scale(1.1);
                    border-color: #245831;
                }

                .org-node-name {
                    background-color: #2F6F3E;
                    color: #FFFFFF;
                    font-family: 'Plus Jakarta Sans', sans-serif;
                    font-weight: 800;
                    font-size: 0.92rem;
                    letter-spacing: 0.04em;
                    padding: 0.75rem 1.6rem 0.65rem 1.6rem;
                    border-radius: 50px;
                    box-shadow: 0 4px 14px rgba(47, 111, 62, 0.25);
                    text-align: center;
                    white-space: nowrap;
                    transition: transform 0.3s ease, background-color 0.3s ease;
                }

                .org-node:hover .org-node-name {
                    transform: scale(1.04);
                    background-color: #245831;
                }

                .org-node-role {
                    background-color: #FFFFFF;
                    border: 2px solid #C9A227;
                    color: #2F6F3E;
                    font-family: 'Plus Jakarta Sans', sans-serif;
                    font-weight: 700;
                    font-size: 0.76rem;
                    letter-spacing: 0.12em;
                    text-transform: uppercase;
                    padding: 0.35rem 1.4rem;
                    border-radius: 50px;
                    margin-top: -10px;
                    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
                    white-space: nowrap;
                    z-index: 3;
                }

                .vline {
                    width: 2px;
                    background-color: #4A6B53;
                    margin: 0 auto;
                }

                .hline {
                    height: 2px;
                    background-color: #4A6B53;
                }

                .dot-connector {
                    width: 8px;
                    height: 8px;
                    background-color: #4A6B53;
                    border-radius: 50%;
                    margin: 0 auto;
                }
            </style>

            <div class="org-chart-wrapper">
                <?php
                $getMember = function($key, $defaultName, $defaultRole, $defaultIcon) use ($members) {
                    $m = $members[$key] ?? [];
                    return [
                        'name' => strtoupper($m['name'] ?? $defaultName),
                        'role' => strtoupper($m['role_title'] ?? $defaultRole),
                        'photo' => $m['photo_path'] ?? null,
                        'icon' => $defaultIcon,
                    ];
                };

                $k1 = $getMember('komisaris_1', 'RICHWANTY SETYA SARI', 'KOMISARIS', 'bi-person-fill');
                $k2 = $getMember('komisaris_2', 'YANU VITA SARI', 'KOMISARIS', 'bi-person-fill');
                $dir = $getMember('direktur', 'DONY SAKTI DAMARA', 'DIREKTUR', 'bi-person-workspace');
                $gm = $getMember('gm', 'RESTU OKTA YANO', 'GENERAL MANAGER', 'bi-person-badge');
                $pengawas = $getMember('pengawas', 'JOHANS MARCELINO', 'PENGAWAS LAPANGAN', 'bi-person-gear');
                $arsitek = $getMember('arsitek', 'SONI PUTRA', 'ARSITEK', 'bi-pencil-ruler');
                $keuangan = $getMember('keuangan', 'LINDA KRISTIANA', 'KEUANGAN', 'bi-person');
                $gudang = $getMember('gudang', 'MUHAMMAD SUGIK', 'GUDANG', 'bi-box-seam');
                ?>

                <!-- LEVEL 1: KOMISARIS (2 Nodes side by side) -->
                <div class="row align-items-center justify-content-between mx-auto mb-0" style="max-width: 740px;">
                    <div class="col-5 text-center">
                        <div class="org-node">
                            <div class="org-avatar" title="Foto Profil <?php echo e($k1['name']); ?>">
                                <?php if (!empty($k1['photo'])): ?>
                                    <img src="<?php echo assetUrl($k1['photo']); ?>" alt="Foto Profil <?php echo e($k1['name']); ?>">
                                <?php else: ?>
                                    <i class="bi <?php echo $k1['icon']; ?>"></i>
                                <?php endif; ?>
                            </div>
                            <div class="org-node-name"><?php echo e($k1['name']); ?></div>
                            <div class="org-node-role"><?php echo e($k1['role']); ?></div>
                        </div>
                    </div>
                    <div class="col-5 text-center">
                        <div class="org-node">
                            <div class="org-avatar" title="Foto Profil <?php echo e($k2['name']); ?>">
                                <?php if (!empty($k2['photo'])): ?>
                                    <img src="<?php echo assetUrl($k2['photo']); ?>" alt="Foto Profil <?php echo e($k2['name']); ?>">
                                <?php else: ?>
                                    <i class="bi <?php echo $k2['icon']; ?>"></i>
                                <?php endif; ?>
                            </div>
                            <div class="org-node-name"><?php echo e($k2['name']); ?></div>
                            <div class="org-node-role"><?php echo e($k2['role']); ?></div>
                        </div>
                    </div>
                </div>

                <!-- Horizontal Line connecting 2 Komisaris -->
                <div class="position-relative my-2 mx-auto" style="max-width: 440px;">
                    <div class="hline"></div>
                    <div class="dot-connector position-absolute top-50 start-0 translate-middle-y"></div>
                    <div class="dot-connector position-absolute top-50 end-0 translate-middle-y"></div>
                    <div class="vline" style="height: 35px;"></div>
                </div>

                <!-- LEVEL 2: DIREKTUR -->
                <div class="text-center my-2">
                    <div class="org-node">
                        <div class="org-avatar" title="Foto Profil <?php echo e($dir['name']); ?>">
                            <?php if (!empty($dir['photo'])): ?>
                                <img src="<?php echo assetUrl($dir['photo']); ?>" alt="Foto Profil <?php echo e($dir['name']); ?>">
                            <?php else: ?>
                                <i class="bi <?php echo $dir['icon']; ?>"></i>
                            <?php endif; ?>
                        </div>
                        <div class="org-node-name"><?php echo e($dir['name']); ?></div>
                        <div class="org-node-role"><?php echo e($dir['role']); ?></div>
                    </div>
                </div>

                <!-- Vertical Line to General Manager -->
                <div class="my-2">
                    <div class="vline" style="height: 35px;"></div>
                </div>

                <!-- LEVEL 3: GENERAL MANAGER -->
                <div class="text-center my-2">
                    <div class="org-node">
                        <div class="org-avatar" title="Foto Profil <?php echo e($gm['name']); ?>">
                            <?php if (!empty($gm['photo'])): ?>
                                <img src="<?php echo assetUrl($gm['photo']); ?>" alt="Foto Profil <?php echo e($gm['name']); ?>">
                            <?php else: ?>
                                <i class="bi <?php echo $gm['icon']; ?>"></i>
                            <?php endif; ?>
                        </div>
                        <div class="org-node-name"><?php echo e($gm['name']); ?></div>
                        <div class="org-node-role"><?php echo e($gm['role']); ?></div>
                    </div>
                </div>

                <!-- Vertical Line down & Horizontal Line to 4 Staff -->
                <div class="my-2">
                    <div class="vline" style="height: 30px;"></div>
                </div>

                <!-- Horizontal Connector Line spanning 4 staff -->
                <div class="position-relative mx-auto mb-2" style="max-width: 780px;">
                    <div class="hline"></div>
                    <div class="d-flex justify-content-between position-absolute top-50 start-0 end-0 translate-middle-y">
                        <div class="dot-connector"></div>
                        <div class="dot-connector"></div>
                        <div class="dot-connector"></div>
                        <div class="dot-connector"></div>
                    </div>
                </div>

                <!-- Vertical Stubs down to 4 staff -->
                <div class="row text-center g-2 mx-auto mb-2" style="max-width: 820px;">
                    <div class="col-3"><div class="vline" style="height: 25px;"></div></div>
                    <div class="col-3"><div class="vline" style="height: 25px;"></div></div>
                    <div class="col-3"><div class="vline" style="height: 25px;"></div></div>
                    <div class="col-3"><div class="vline" style="height: 25px;"></div></div>
                </div>

                <!-- LEVEL 4: OPERATIONAL / DIVISIONS (4 Nodes) -->
                <div class="row text-center g-2 mx-auto" style="max-width: 860px;">
                    <!-- Node 1: Pengawas Lapangan -->
                    <div class="col-3 px-1">
                        <div class="org-node">
                            <div class="org-avatar" style="width: 58px; height: 58px; font-size: 1.4rem;" title="Foto Profil <?php echo e($pengawas['name']); ?>">
                                <?php if (!empty($pengawas['photo'])): ?>
                                    <img src="<?php echo assetUrl($pengawas['photo']); ?>" alt="Foto Profil <?php echo e($pengawas['name']); ?>">
                                <?php else: ?>
                                    <i class="bi <?php echo $pengawas['icon']; ?>"></i>
                                <?php endif; ?>
                            </div>
                            <div class="org-node-name" style="font-size: 0.82rem; padding: 0.65rem 0.95rem 0.55rem 0.95rem;"><?php echo e($pengawas['name']); ?></div>
                            <div class="org-node-role" style="font-size: 0.7rem; padding: 0.3rem 0.85rem;"><?php echo e($pengawas['role']); ?></div>
                        </div>
                    </div>

                    <!-- Node 2: Arsitek -->
                    <div class="col-3 px-1">
                        <div class="org-node">
                            <div class="org-avatar" style="width: 58px; height: 58px; font-size: 1.4rem;" title="Foto Profil <?php echo e($arsitek['name']); ?>">
                                <?php if (!empty($arsitek['photo'])): ?>
                                    <img src="<?php echo assetUrl($arsitek['photo']); ?>" alt="Foto Profil <?php echo e($arsitek['name']); ?>">
                                <?php else: ?>
                                    <i class="bi <?php echo $arsitek['icon']; ?>"></i>
                                <?php endif; ?>
                            </div>
                            <div class="org-node-name" style="font-size: 0.82rem; padding: 0.65rem 0.95rem 0.55rem 0.95rem;"><?php echo e($arsitek['name']); ?></div>
                            <div class="org-node-role" style="font-size: 0.7rem; padding: 0.3rem 0.85rem;"><?php echo e($arsitek['role']); ?></div>
                        </div>
                    </div>

                    <!-- Node 3: Keuangan -->
                    <div class="col-3 px-1">
                        <div class="org-node">
                            <div class="org-avatar" style="width: 58px; height: 58px; font-size: 1.4rem;" title="Foto Profil <?php echo e($keuangan['name']); ?>">
                                <?php if (!empty($keuangan['photo'])): ?>
                                    <img src="<?php echo assetUrl($keuangan['photo']); ?>" alt="Foto Profil <?php echo e($keuangan['name']); ?>">
                                <?php else: ?>
                                    <i class="bi <?php echo $keuangan['icon']; ?>"></i>
                                <?php endif; ?>
                            </div>
                            <div class="org-node-name" style="font-size: 0.82rem; padding: 0.65rem 0.95rem 0.55rem 0.95rem;"><?php echo e($keuangan['name']); ?></div>
                            <div class="org-node-role" style="font-size: 0.7rem; padding: 0.3rem 0.85rem;"><?php echo e($keuangan['role']); ?></div>
                        </div>
                    </div>

                    <!-- Node 4: Gudang -->
                    <div class="col-3 px-1">
                        <div class="org-node">
                            <div class="org-avatar" style="width: 58px; height: 58px; font-size: 1.4rem;" title="Foto Profil <?php echo e($gudang['name']); ?>">
                                <?php if (!empty($gudang['photo'])): ?>
                                    <img src="<?php echo assetUrl($gudang['photo']); ?>" alt="Foto Profil <?php echo e($gudang['name']); ?>">
                                <?php else: ?>
                                    <i class="bi <?php echo $gudang['icon']; ?>"></i>
                                <?php endif; ?>
                            </div>
                            <div class="org-node-name" style="font-size: 0.82rem; padding: 0.65rem 0.95rem 0.55rem 0.95rem;"><?php echo e($gudang['name']); ?></div>
                            <div class="org-node-role" style="font-size: 0.7rem; padding: 0.3rem 0.85rem;"><?php echo e($gudang['role']); ?></div>
                        </div>
                    </div>
                </div>

                <div class="text-end mt-4 pt-3 border-top">
                    <span class="small text-muted font-monospace" style="font-size: 0.75rem;">PT. GRAHA LESTARI KARYA UTAMA</span>
                </div>
            </div>
        </div>
    </div>
</section>
