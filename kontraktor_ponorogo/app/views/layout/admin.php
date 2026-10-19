<?php
$authUser = currentUser();
$requestUri = parse_url($_SERVER['REQUEST_URI'] ?? '/admin', PHP_URL_PATH);
$basePath = basePath();
if (str_starts_with($requestUri, $basePath)) {
    $requestUri = substr($requestUri, strlen($basePath));
}
$requestUri = rtrim($requestUri, '/') ?: '/admin';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'Admin Dashboard - PT Graha Lestari'); ?></title>
    <!-- Google Fonts: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Chart.js CDN for Admin Analytics -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --primary-green: #2F6F3E;
            --primary-dark: #245831;
            --sage-green: #6B8F71;
            --sage-light: #F0F5F1;
            --bg-offwhite: #F8F9F6;
            --card-bg: #FFFFFF;
            --text-primary: #2C2C2C;
            --border-color: #E5E7EB;
            --sidebar-bg: #1E2E22;
            --sidebar-hover: #273A2C;
            --sidebar-width: 260px;
        }

        body {
            background-color: var(--bg-offwhite);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6, .brand-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Sidebar Styling */
        .admin-sidebar {
            width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            color: #FFFFFF;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 1040;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
            border-right: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.06);
        }

        .sidebar-brand {
            padding: 1.75rem 1.25rem 1.5rem 1.25rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .sidebar-brand-box {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
            background: transparent;
            border: none;
            box-shadow: none;
            transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        .sidebar-brand:hover .sidebar-brand-box {
            transform: translateY(-3px) scale(1.06);
        }

        .sidebar-brand-logo {
            max-height: 76px;
            max-width: 140px;
            width: auto;
            height: auto;
            object-fit: contain;
            filter: drop-shadow(0 6px 16px rgba(0, 0, 0, 0.45)) drop-shadow(0 0 1px rgba(255, 255, 255, 0.2));
        }

        .sidebar-brand-title {
            font-size: 1.18rem;
            font-weight: 800;
            color: #FFFFFF;
            line-height: 1.25;
            display: block;
            margin-top: 0.5rem;
            letter-spacing: -0.01em;
            text-align: center;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .sidebar-brand-subtitle {
            font-size: 0.72rem;
            color: #A3C9A8;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            display: block;
            margin-top: 0.2rem;
            text-align: center;
        }

        .sidebar-menu {
            padding: 1.25rem 0.85rem;
            list-style: none;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            flex-grow: 1;
            overflow-y: auto;
        }

        .menu-label {
            font-size: 0.68rem;
            font-weight: 700;
            color: #8E9B90;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.6rem 0.85rem 0.25rem 0.85rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.75rem 1rem;
            color: #D2DAD4;
            text-decoration: none;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600;
            font-size: 0.94rem;
            border-radius: 12px;
            transition: all 0.25s ease;
        }

        .sidebar-link i {
            font-size: 1.15rem;
            color: var(--sage-green);
            transition: transform 0.2s ease, color 0.2s ease;
        }

        .sidebar-link:hover {
            background-color: var(--sidebar-hover);
            color: #FFFFFF;
        }

        .sidebar-link:hover i {
            color: #FFFFFF;
            transform: translateX(2px);
        }

        .sidebar-link.active {
            background-color: var(--primary-green);
            color: #FFFFFF;
            box-shadow: 0 4px 14px rgba(47, 111, 62, 0.4);
        }

        .sidebar-link.active i {
            color: #FFFFFF;
        }

        /* Sidebar Footer User Info */
        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            background-color: rgba(0, 0, 0, 0.15);
        }

        /* Main Wrapper */
        .admin-wrapper {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease;
        }

        /* Admin Header Bar */
        .admin-header {
            background-color: #FFFFFF;
            border-bottom: 1px solid var(--border-color);
            padding: 0.9rem 1.75rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1030;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.02);
        }

        .mobile-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--text-primary);
            cursor: pointer;
        }

        .admin-body {
            padding: 2rem 1.75rem;
            flex-grow: 1;
        }

        /* Cards & Tables in Admin */
        .card-custom, .table-card, .stats-card {
            background-color: var(--card-bg);
            border-radius: 20px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
            overflow: hidden;
        }

        .btn-primary-green {
            background-color: var(--primary-green);
            color: #FFFFFF;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            padding: 0.6rem 1.3rem;
            border-radius: 10px;
            border: none;
            transition: all 0.25s ease;
            box-shadow: 0 4px 14px rgba(47, 111, 62, 0.2);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
        }

        .btn-primary-green:hover {
            background-color: var(--primary-dark);
            color: #FFFFFF;
            transform: translateY(-2px);
        }

        @media (max-width: 991.98px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .admin-wrapper {
                margin-left: 0;
            }

            .mobile-toggle {
                display: block;
            }
        }

        @media (max-width: 767.98px) {
            .admin-body {
                padding: 1.25rem 1rem;
            }
            .admin-header {
                padding: 0.75rem 1rem;
            }
            .page-title {
                font-size: 1.4rem !important;
            }
        }
    </style>
</head>
<body>

    <!-- Left Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <!-- Top Brand Header (Matching Reference Design) -->
        <a href="<?php echo url('admin'); ?>" class="sidebar-brand">
            <div class="sidebar-brand-box mb-1">
                <img src="<?php echo url('public/images/logo-transparent.png'); ?>" alt="Logo PT Graha Lestari" class="sidebar-brand-logo">
            </div>
            <div class="d-flex flex-column align-items-center text-center">
                <span class="sidebar-brand-title">PT Graha Lestari</span>
                <span class="sidebar-brand-subtitle">Panel Pengelola</span>
            </div>
        </a>

        <!-- Sidebar Menu Links -->
        <ul class="sidebar-menu">
            <li class="menu-label">Menu Utama</li>
            
            <li>
                <a href="<?php echo url('admin'); ?>" class="sidebar-link <?php echo ($requestUri === '/admin') ? 'active' : ''; ?>">
                    <i class="bi bi-grid-1x2-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li>
                <a href="<?php echo url('admin/houses'); ?>" class="sidebar-link <?php echo (strpos($requestUri, '/admin/houses') === 0) ? 'active' : ''; ?>">
                    <i class="bi bi-house-door-fill"></i>
                    <span>Katalog Rumah</span>
                </a>
            </li>
            
            <li>
                <a href="<?php echo url('admin/services'); ?>" class="sidebar-link <?php echo (strpos($requestUri, '/admin/services') === 0) ? 'active' : ''; ?>">
                    <i class="bi bi-tools"></i>
                    <span>Layanan</span>
                </a>
            </li>
            
            <li>
                <a href="<?php echo url('admin/projects'); ?>" class="sidebar-link <?php echo (strpos($requestUri, '/admin/projects') === 0) ? 'active' : ''; ?>">
                    <i class="bi bi-diagram-3-fill"></i>
                    <span>Portofolio Proyek</span>
                </a>
            </li>

            <li>
                <a href="<?php echo url('admin/contacts'); ?>" class="sidebar-link <?php echo (strpos($requestUri, '/admin/contacts') === 0) ? 'active' : ''; ?>">
                    <i class="bi bi-chat-left-text-fill"></i>
                    <span>Pesan Konsultasi</span>
                    <?php
                    try {
                        require_once __DIR__ . '/../../models/ContactModel.php';
                        $cModelBadge = new ContactModel();
                        $unreadCnt = $cModelBadge->getUnreadCount();
                        if ($unreadCnt > 0) {
                            echo '<span class="badge bg-danger rounded-pill ms-auto" style="font-size: 0.75rem;">' . $unreadCnt . '</span>';
                        }
                    } catch (\Throwable $e) {}
                    ?>
                </a>
            </li>

            <li>
                <a href="<?php echo url('admin/testimonials'); ?>" class="sidebar-link <?php echo (strpos($requestUri, '/admin/testimonials') === 0) ? 'active' : ''; ?>">
                    <i class="bi bi-star-fill"></i>
                    <span>Testimoni Klien</span>
                </a>
            </li>

            <li>
                <a href="<?php echo url('admin/structure'); ?>" class="sidebar-link <?php echo (strpos($requestUri, '/admin/structure') === 0) ? 'active' : ''; ?>">
                    <i class="bi bi-diagram-3"></i>
                    <span>Struktur Perusahaan</span>
                </a>
            </li>

            <li>
                <a href="<?php echo url('admin/users'); ?>" class="sidebar-link <?php echo (strpos($requestUri, '/admin/users') === 0) ? 'active' : ''; ?>">
                    <i class="bi bi-person-gear"></i>
                    <span>Manajemen Pengguna</span>
                </a>
            </li>

            <li>
                <a href="<?php echo url('admin/settings'); ?>" class="sidebar-link <?php echo (strpos($requestUri, '/admin/settings') === 0) ? 'active' : ''; ?>">
                    <i class="bi bi-gear-fill"></i>
                    <span>Pengaturan Website</span>
                </a>
            </li>

            <li class="menu-label mt-3">Akses Eksternal</li>
            
            <li>
                <a href="<?php echo url(''); ?>" target="_blank" class="sidebar-link">
                    <i class="bi bi-box-arrow-up-right"></i>
                    <span>Lihat Website Utama</span>
                </a>
            </li>
        </ul>

        <!-- Sidebar Footer User Profile -->
        <div class="sidebar-footer d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <div class="rounded-circle bg-success text-white fw-bold d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 0.9rem;">
                    <?php echo strtoupper(substr($authUser['name'] ?? 'A', 0, 1)); ?>
                </div>
                <div class="d-flex flex-column text-truncate" style="max-width: 130px;">
                    <span class="fw-bold text-white small text-truncate"><?php echo e($authUser['name'] ?? 'Administrator'); ?></span>
                    <span class="text-muted extra-small" style="font-size: 0.72rem;">Admin Mode</span>
                </div>
            </div>
            <a href="<?php echo url('admin/logout'); ?>" class="text-white-50 hover-white fs-5" title="Logout">
                <i class="bi bi-box-arrow-right"></i>
            </a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="admin-wrapper">
        <!-- Top Admin Header Bar -->
        <header class="admin-header">
            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-light border rounded-3 p-2 d-flex align-items-center justify-content-center" id="sidebarToggleBtn" style="width: 38px; height: 38px;" title="Toggle Menu">
                    <i class="bi bi-list fs-5"></i>
                </button>
                <nav aria-label="breadcrumb" class="mb-0 d-none d-sm-block ms-1">
                    <ol class="breadcrumb mb-0 small text-muted">
                        <li class="breadcrumb-item"><a href="<?php echo url('admin'); ?>" class="text-muted text-decoration-none">Admin</a></li>
                        <li class="breadcrumb-item active text-dark fw-semibold" aria-current="page"><?php echo e($title ?? 'Dashboard'); ?></li>
                    </ol>
                </nav>
            </div>

            <div class="d-flex align-items-center gap-3">
                <!-- Date Pill -->
                <div class="bg-light border rounded-pill px-3 py-1.5 small text-secondary fw-semibold d-none d-md-flex align-items-center gap-1.5" style="font-size: 0.83rem;">
                    <i class="bi bi-calendar-event text-success"></i>
                    <span><?php echo date('d M Y'); ?></span>
                </div>

                <!-- Notification Bell -->
                <a href="<?php echo url('admin/contacts'); ?>" class="btn btn-light border rounded-circle position-relative p-0 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;" title="Pesan Masuk">
                    <i class="bi bi-bell text-secondary"></i>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                        <span class="visually-hidden">New notifications</span>
                    </span>
                </a>

                <!-- User Profile Pill -->
                <div class="dropdown">
                    <button class="btn btn-light rounded-pill border px-3 py-1.5 dropdown-toggle d-flex align-items-center gap-2.5 fw-semibold shadow-sm" type="button" data-bs-toggle="dropdown" style="font-size: 0.88rem;">
                        <div class="rounded-circle bg-success text-white fw-bold d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-size: 0.82rem; background-color: #2F6F3E !important;">
                            <?php echo strtoupper(substr($authUser['name'] ?? 'A', 0, 2)); ?>
                        </div>
                        <div class="text-start d-none d-sm-block leading-tight">
                            <div class="fw-bold text-dark" style="font-size: 0.88rem; line-height: 1.1;"><?php echo e($authUser['name'] ?? 'Administrator'); ?></div>
                            <small class="text-muted extra-small" style="font-size: 0.72rem;">SuperAdmin</small>
                        </div>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2">
                        <li><span class="dropdown-item-text small text-muted">Masuk sebagai <?php echo e($authUser['email'] ?? 'admin'); ?></span></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger fw-semibold" href="<?php echo url('admin/logout'); ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Admin Content Body -->
        <main class="admin-body">
            <?php if (!empty($success)): ?>
                <div class="alert alert-success border-0 rounded-3 shadow-sm mb-4 d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill"></i>
                    <div><?php echo e($success); ?></div>
                </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4 d-flex align-items-center gap-2">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    <div><?php echo e($error); ?></div>
                </div>
            <?php endif; ?>

            <?php include $content; ?>
        </main>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('sidebarToggleBtn');
            const sidebar = document.getElementById('adminSidebar');

            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });
            }
        });
    </script>
</body>
</html>
