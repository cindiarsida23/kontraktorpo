<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'PT Graha Lestari - Developer Properti & Kontraktor Terpercaya'); ?></title>
    <!-- Google Fonts: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --primary-green: #2F6F3E;
            --primary-dark: #245831;
            --sage-green: #6B8F71;
            --sage-light: #F0F5F1;
            --soft-gold: #C9A227;
            --bg-offwhite: #F8F9F6;
            --card-bg: #FFFFFF;
            --text-primary: #2C2C2C;
            --text-muted: #666666;
            --border-color: #E5E7EB;
            --footer-bg: #1E2E22;
        }

        * {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background-color: var(--bg-offwhite);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, h6, .navbar-brand {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-primary);
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        /* Keyframe Animations */
        @keyframes floatSoft {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        @keyframes pulseGlow {
            0% { box-shadow: 0 4px 14px rgba(47, 111, 62, 0.2); }
            50% { box-shadow: 0 8px 24px rgba(47, 111, 62, 0.38); }
            100% { box-shadow: 0 4px 14px rgba(47, 111, 62, 0.2); }
        }

        /* Floating Action Buttons (WhatsApp & TikTok) */
        .floating-actions-container {
            position: fixed;
            bottom: 28px;
            right: 28px;
            z-index: 1080;
            display: flex;
            flex-direction: column;
            gap: 14px;
            align-items: flex-end;
        }

        .floating-btn-item {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .floating-btn-icon {
            width: 54px;
            height: 54px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #FFFFFF;
            font-size: 1.55rem;
            box-shadow: 0 8px 22px rgba(0, 0, 0, 0.22);
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
            position: relative;
        }

        .floating-btn-wa .floating-btn-icon {
            background-color: #25D366;
            box-shadow: 0 8px 25px rgba(37, 211, 102, 0.42);
        }

        .floating-btn-tiktok .floating-btn-icon {
            background: #010101;
            border: 2px solid #25F4EE;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4);
        }

        .floating-btn-label {
            background: rgba(20, 20, 20, 0.88);
            color: #FFFFFF;
            font-weight: 600;
            font-size: 0.82rem;
            padding: 6px 14px;
            border-radius: 30px;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            white-space: nowrap;
            opacity: 0;
            transform: translateX(10px);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            pointer-events: none;
        }

        .floating-btn-item:hover .floating-btn-label {
            opacity: 1;
            transform: translateX(0);
        }

        .floating-btn-item:hover .floating-btn-icon {
            transform: scale(1.12) translateY(-3px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
        }

        @media (max-width: 576px) {
            .floating-actions-container {
                bottom: 20px;
                right: 20px;
                gap: 10px;
            }
            .floating-btn-icon {
                width: 48px;
                height: 48px;
                font-size: 1.35rem;
            }
            .floating-btn-label {
                display: none;
            }
        }

        /* Navbar Styling & Glassmorphism Scroll */
        .navbar {
            background-color: #FFFFFF !important;
            border-bottom: 1px solid var(--border-color);
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.03);
            padding: 0.9rem 0;
            transition: all 0.3s ease;
        }

        .navbar.nav-scrolled {
            background: rgba(255, 255, 255, 0.92) !important;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06) !important;
            padding: 0.65rem 0;
        }

        .navbar-brand-title {
            font-size: 1.45rem;
            font-weight: 800;
            color: var(--primary-green) !important;
            line-height: 1.2;
            display: block;
        }

        .navbar-brand-subtitle {
            font-size: 0.72rem;
            font-weight: 600;
            color: var(--sage-green);
            letter-spacing: 0.05em;
            text-transform: uppercase;
            display: block;
        }

        .navbar-logo-img {
            height: 46px;
            width: auto;
            object-fit: contain;
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .navbar-logo-img:hover {
            transform: scale(1.08) rotate(-2deg);
        }

        .navbar-nav {
            gap: 0.4rem;
        }

        .nav-link {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600;
            font-size: 0.96rem;
            color: var(--text-primary) !important;
            padding: 0.55rem 0.95rem !important;
            border-radius: 10px;
            transition: all 0.25s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 4px;
            left: 50%;
            width: 0;
            height: 2px;
            background-color: var(--primary-green);
            transition: width 0.3s ease, left 0.3s ease;
            border-radius: 2px;
        }

        .nav-link:hover::after, .nav-link.active::after {
            width: 50%;
            left: 25%;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--primary-green) !important;
            background-color: var(--sage-light);
        }

        .btn-cta-nav {
            background-color: var(--primary-green);
            color: #FFFFFF !important;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 0.92rem;
            padding: 0.65rem 1.4rem;
            border-radius: 50px;
            border: none;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            animation: pulseGlow 4s infinite ease-in-out;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .btn-cta-nav::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(60deg, transparent, rgba(255, 255, 255, 0.25), transparent);
            transform: rotate(30deg) translateX(-100%);
            transition: transform 0.8s ease;
        }

        .btn-cta-nav:hover::after {
            transform: rotate(30deg) translateX(100%);
        }

        .btn-cta-nav:hover {
            background-color: var(--primary-dark);
            color: #FFFFFF !important;
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 8px 24px rgba(47, 111, 62, 0.35);
        }

        /* Primary & Outline Buttons */
        .btn-primary-green {
            background-color: var(--primary-green);
            color: #FFFFFF;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            padding: 0.8rem 1.8rem;
            border-radius: 50px;
            border: none;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 4px 16px rgba(47, 111, 62, 0.22);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-primary-green:hover {
            background-color: var(--primary-dark);
            color: #FFFFFF;
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 8px 24px rgba(47, 111, 62, 0.32);
        }

        .btn-outline-green {
            background-color: transparent;
            color: var(--primary-green);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            padding: 0.8rem 1.8rem;
            border-radius: 50px;
            border: 2px solid var(--primary-green);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-outline-green:hover {
            background-color: var(--primary-green);
            color: #FFFFFF;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(47, 111, 62, 0.2);
        }

        /* Card Styles with Smooth Hover Lift */
        .card-custom {
            background-color: var(--card-bg);
            border-radius: 20px;
            border: 1px solid var(--border-color);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.4s ease;
            overflow: hidden;
        }

        .card-custom:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 36px rgba(47, 111, 62, 0.12);
            border-color: var(--sage-green);
        }

        .card-img-rounded {
            border-radius: 16px;
            overflow: hidden;
        }

        .card-img-rounded img {
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .card-custom:hover .card-img-rounded img {
            transform: scale(1.08);
        }

        /* Floating Hero Showcase Image & Badge */
        .floating-badge {
            animation: floatSoft 5s ease-in-out infinite;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, 0.95) !important;
            border: 1px solid rgba(229, 231, 235, 0.8) !important;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08) !important;
            transition: transform 0.3s ease;
        }

        .hero-img-card {
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .hero-img-card:hover {
            transform: translateY(-6px) scale(1.02);
            box-shadow: 0 20px 45px rgba(47, 111, 62, 0.16) !important;
        }

        /* Section Title Styling */
        .section-tag {
            display: inline-block;
            background-color: var(--sage-light);
            color: var(--primary-green);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 0.82rem;
            padding: 0.38rem 1.1rem;
            border-radius: 50px;
            margin-bottom: 0.75rem;
            letter-spacing: 0.03em;
            transition: transform 0.3s ease;
        }

        .section-tag:hover {
            transform: scale(1.04);
        }

        .section-title {
            font-size: clamp(1.8rem, 3vw, 2.5rem);
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1.25;
            margin-bottom: 1rem;
        }

        .section-subtitle {
            color: var(--text-muted);
            font-size: 1.05rem;
            max-width: 680px;
            margin-left: auto;
            margin-right: auto;
        }

        .highlight-text {
            color: var(--primary-green);
        }

        /* Icon Container & Hover Rotate */
        .icon-box-green {
            width: 56px;
            height: 56px;
            background-color: var(--sage-light);
            color: var(--primary-green);
            border-radius: 16px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 1.2rem;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .card-custom:hover .icon-box-green {
            background-color: var(--primary-green);
            color: #FFFFFF;
            transform: scale(1.1) rotate(5deg);
        }

        /* Staggered Scroll Reveal Animation */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }

        .scroll-reveal.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .delay-1 { transition-delay: 0.1s; }
        .delay-2 { transition-delay: 0.2s; }
        .delay-3 { transition-delay: 0.3s; }
        .delay-4 { transition-delay: 0.4s; }

        /* Footer Styling */
        footer {
            background-color: var(--footer-bg);
            color: #FFFFFF;
            padding-top: 4.5rem;
            padding-bottom: 2.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        footer h5 {
            color: #FFFFFF;
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 1.25rem;
        }

        .footer-text {
            color: #C2C9C3;
            font-size: 0.94rem;
            line-height: 1.7;
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.65rem;
        }

        .footer-links a {
            color: #D4DAD5;
            text-decoration: none;
            font-size: 0.94rem;
            transition: color 0.25s ease, transform 0.25s ease;
            display: inline-block;
        }

        .footer-links a:hover {
            color: var(--sage-green);
            transform: translateX(4px);
        }

        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            color: #D4DAD5;
            font-size: 0.94rem;
            margin-bottom: 0.8rem;
        }

        .footer-contact-item i {
            color: var(--sage-green);
            font-size: 1.1rem;
            margin-top: 0.15rem;
        }

        .social-icon-btn-sm {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.08);
            color: #FFFFFF;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.05rem;
            flex-shrink: 0;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .footer-social-link {
            color: #D4DAD5;
            text-decoration: none;
            transition: color 0.25s ease;
        }

        .footer-social-link:hover .social-icon-btn-sm {
            background-color: var(--primary-green);
            color: #FFFFFF !important;
            transform: scale(1.1);
            border-color: var(--primary-green);
            box-shadow: 0 4px 12px rgba(47, 111, 62, 0.4);
        }

        .footer-social-link:hover .footer-social-username {
            color: var(--sage-green);
        }

        .footer-social-username {
            font-size: 0.9rem;
            color: #D4DAD5;
            transition: color 0.25s ease;
            word-break: break-all;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 3.5rem;
            padding-top: 1.5rem;
            color: #9CA59E;
            font-size: 0.88rem;
        }

        /* ------------------------------------------------------------- */
        /* COMPREHENSIVE RESPONSIVE DESIGN SYSTEM (Desktop, Tablet, Mobile) */
        /* ------------------------------------------------------------- */

        html, body {
            overflow-x: hidden;
            max-width: 100%;
        }

        /* Hover Dropdown Styling (Desktop) */
        @media (min-width: 992px) {
            .nav-item.dropdown:hover .dropdown-menu {
                display: block;
                margin-top: 0.2rem !important;
                animation: fadeIn 0.25s ease;
            }
        }

        .dropdown-menu {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08) !important;
            border: 1px solid var(--border-color) !important;
        }

        .dropdown-item {
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: var(--sage-light) !important;
            color: var(--primary-green) !important;
        }

        /* Mobile & Tablet Navbar Expansion Drawer Styling (< 992px) */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background-color: #FFFFFF;
                border: 1px solid var(--border-color);
                border-radius: 16px;
                padding: 1.2rem;
                margin-top: 0.75rem;
                box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08);
            }

            .navbar-nav {
                gap: 0.5rem;
            }

            .nav-link {
                padding: 0.65rem 1rem !important;
                border-radius: 10px;
                font-size: 1rem;
            }

            .btn-cta-nav {
                width: 100%;
                justify-content: center;
                margin-top: 0.5rem;
                padding: 0.75rem 1.4rem;
            }

            .dropdown-menu {
                border: 1px solid var(--border-color) !important;
                box-shadow: none !important;
                background-color: var(--bg-offwhite) !important;
                margin-top: 0.4rem !important;
            }
        }

        /* Tablet Screen Optimizations (768px - 991.98px) */
        @media (min-width: 768px) and (max-width: 991.98px) {
            .section-title {
                font-size: 2.1rem !important;
            }
            .display-4 {
                font-size: 2.5rem !important;
            }
            .hero-img-card img {
                height: 360px !important;
            }
            .floating-badge {
                max-width: 250px !important;
            }
        }

        /* Mobile Phone Screen Optimizations (< 767.98px) */
        @media (max-width: 767.98px) {
            .navbar-brand-title {
                font-size: 1.2rem !important;
            }
            .navbar-brand-subtitle {
                font-size: 0.65rem !important;
            }
            .navbar-logo-img {
                height: 36px !important;
            }
            .section-tag {
                font-size: 0.78rem !important;
                padding: 0.3rem 0.9rem !important;
            }
            .section-title {
                font-size: 1.65rem !important;
                line-height: 1.3 !important;
            }
            .section-subtitle {
                font-size: 0.95rem !important;
            }
            .display-4 {
                font-size: 1.85rem !important;
                line-height: 1.25 !important;
            }
            .display-6 {
                font-size: 1.45rem !important;
            }
            .hero-img-card img {
                height: 280px !important;
            }
            .floating-badge {
                padding: 0.45rem 0.75rem !important;
                max-width: 210px !important;
                margin: 0.4rem !important;
                bottom: 0 !important;
                left: 0 !important;
            }
            .floating-badge .icon-box-green {
                width: 32px !important;
                height: 32px !important;
                font-size: 0.95rem !important;
                margin-bottom: 0 !important;
            }
            .floating-badge div div:first-child {
                font-size: 0.78rem !important;
            }
            .floating-badge div div:last-child {
                font-size: 0.68rem !important;
            }
            .floating-badge-2 {
                padding: 0.35rem 0.75rem !important;
                margin: 0.4rem !important;
                top: 0 !important;
                right: 0 !important;
            }
            .floating-badge-2 span {
                font-size: 0.72rem !important;
            }
            .floating-badge-2 i {
                font-size: 1rem !important;
            }
            .stat-box .fs-3 {
                font-size: 1.4rem !important;
            }
            .stat-box div:last-child {
                font-size: 0.78rem !important;
            }
            .card-custom {
                border-radius: 16px;
            }
            .btn-primary-green, .btn-outline-green {
                padding: 0.7rem 1.4rem !important;
                font-size: 0.9rem !important;
            }
            footer {
                padding-top: 3rem;
                padding-bottom: 2rem;
            }
            footer h5 {
                margin-top: 1rem;
            }
            .footer-contact-item {
                font-size: 0.88rem;
            }
        }

        /* Small Smartphone Screen Optimizations (< 480px) */
        @media (max-width: 479.98px) {
            .container {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
            .display-4 {
                font-size: 1.65rem !important;
            }
            .section-title {
                font-size: 1.45rem !important;
            }
            .hero-img-card img {
                height: 240px !important;
            }
            .floating-badge {
                max-width: 180px !important;
                padding: 0.35rem 0.55rem !important;
            }
            .floating-badge div div:last-child {
                display: none !important;
            }
            .floating-badge-2 {
                padding: 0.35rem 0.55rem !important;
            }
        }
    </style>
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a href="<?php echo url(''); ?>" class="navbar-brand d-flex align-items-center gap-3 text-decoration-none">
                <img src="<?php echo url('public/images/logo-transparent.png'); ?>" alt="Logo PT Graha Lestari" class="navbar-logo-img">
                <div class="d-flex flex-column">
                    <span class="navbar-brand-title">PT Graha Lestari</span>
                    <span class="navbar-brand-subtitle">Developer & Kontraktor Properti</span>
                </div>
            </a>
            
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link <?php echo isset($title) && strpos($title, 'Home') !== false ? 'active' : ''; ?>" href="<?php echo url(''); ?>">Beranda</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?php echo isset($title) && (strpos($title, 'Tentang') !== false || strpos($title, 'Struktur') !== false) ? 'active' : ''; ?>" href="#" id="profilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profil
                        </a>
                        <ul class="dropdown-menu border-0 shadow-lg rounded-4 mt-2" aria-labelledby="profilDropdown" style="background: #FFFFFF; min-width: 210px; padding: 0.5rem;">
                            <li>
                                <a class="dropdown-item rounded-3 py-2 px-3 fw-semibold text-dark d-flex align-items-center gap-2" href="<?php echo url('tentang-kami'); ?>">
                                    <i class="bi bi-building text-success"></i> Tentang Kami
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item rounded-3 py-2 px-3 fw-semibold text-dark d-flex align-items-center gap-2" href="<?php echo url('struktur-perusahaan'); ?>">
                                    <i class="bi bi-diagram-3 text-success"></i> Struktur Perusahaan
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo isset($title) && strpos($title, 'Layanan') !== false ? 'active' : ''; ?>" href="<?php echo url('layanan'); ?>">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo isset($title) && strpos($title, 'Portofolio') !== false ? 'active' : ''; ?>" href="<?php echo url('portofolio'); ?>">Portofolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo isset($title) && strpos($title, 'Kontak') !== false ? 'active' : ''; ?>" href="<?php echo url('kontak'); ?>">Kontak</a>
                    </li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a href="https://wa.me/<?php echo e(siteSetting('whatsapp_number', '6281359099658')); ?>?text=Halo%20PT%20Graha%20Lestari,%20saya%20ingin%20konsultasi%20properti" target="_blank" rel="noopener" class="btn-cta-nav">
                            <i class="bi bi-whatsapp"></i> Konsultasi Gratis
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content Area -->
    <main>
        <?php include $content; ?>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row g-4 justify-content-between">
                <!-- Column 1: Company Profile Info -->
                <div class="col-lg-5">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="<?php echo url('public/images/logo-transparent.png'); ?>" alt="Logo PT Graha Lestari" style="height: 46px; width: auto;">
                        <span class="fs-4 fw-bold text-white">PT Graha Lestari</span>
                    </div>
                    <p class="footer-text mb-0" style="max-width: 440px;">
                        <?php echo e(siteSetting('footer_about_text', 'Perusahaan kontraktor dan developer properti terpercaya di Ponorogo. Berkomitmen menghadirkan hunian & proyek berkualitas tinggi, elegan, transparan, dan tepat waktu.')); ?>

                    </p>
                </div>

                <!-- Column 2: Media Sosial dengan Logo & Username -->
                <div class="col-lg-3 col-md-6">
                    <h5>Media Sosial</h5>
                    <ul class="footer-links mt-3" style="gap: 0.85rem;">
                        <li>
                            <a href="<?php echo e(siteSetting('tiktok_url', 'https://www.tiktok.com/@grahalestari_konstruksi')); ?>" target="_blank" rel="noopener" class="footer-social-link d-flex align-items-center gap-2.5">
                                <span class="social-icon-btn-sm"><i class="bi bi-tiktok"></i></span>
                                <span class="footer-social-username"><?php echo e(siteSetting('tiktok_username', '@grahalestari_konstruksi')); ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(siteSetting('instagram_url', 'https://www.instagram.com/grahalestari_konstruksi')); ?>" target="_blank" rel="noopener" class="footer-social-link d-flex align-items-center gap-2.5">
                                <span class="social-icon-btn-sm"><i class="bi bi-instagram"></i></span>
                                <span class="footer-social-username"><?php echo e(siteSetting('instagram_username', '@grahalestari_konstruksi')); ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(siteSetting('youtube_url', 'https://www.youtube.com/@grahalestaripropertichanne1993')); ?>" target="_blank" rel="noopener" class="footer-social-link d-flex align-items-center gap-2.5">
                                <span class="social-icon-btn-sm"><i class="bi bi-youtube"></i></span>
                                <span class="footer-social-username"><?php echo e(siteSetting('youtube_username', '@grahalestaripropertichanne1993')); ?></span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 3: Lokasi, Email & Jam Operasional -->
                <div class="col-lg-4 col-md-6">
                    <h5>Kontak & Operasional</h5>
                    <div class="footer-contact-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span><?php echo e(siteSetting('company_address', 'Jl. Raya Ponorogo, Kabupaten Ponorogo, Jawa Timur, Indonesia')); ?></span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="bi bi-envelope-fill"></i>
                        <span><?php echo e(siteSetting('contact_email', 'info@kontraktorponorogo.com')); ?></span>
                    </div>
                    <div class="footer-contact-item">
                        <i class="bi bi-clock-fill"></i>
                        <div class="d-flex flex-column gap-1">
                            <div><?php echo e(siteSetting('operating_hours_weekday', 'Senin - Jumat: 08:00 - 17:00 WIB')); ?></div>
                            <div style="font-size: 0.85rem; color: #9CA59E;"><?php echo e(siteSetting('operating_hours_weekend', 'Sabtu: 08:00 - 15:00 WIB (Minggu Tutup)')); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom text-center">
                <p class="mb-0">&copy; <?php echo date('Y'); ?> PT Graha Lestari. All Rights Reserved. Developer & Kontraktor Properti Terpercaya.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Navbar Glassmorphism Scroll Effect
            const nav = document.querySelector('.navbar');
            window.addEventListener('scroll', function() {
                if (window.scrollY > 30) {
                    nav.classList.add('nav-scrolled');
                } else {
                    nav.classList.remove('nav-scrolled');
                }
            });

            // Staggered Scroll Reveal Observer
            const revealElements = document.querySelectorAll('.scroll-reveal');
            const observerOptions = {
                root: null,
                rootMargin: '0px 0px -50px 0px',
                threshold: 0.1
            };

            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, observerOptions);

            revealElements.forEach(el => revealObserver.observe(el));
        });
    </script>
    <!-- Floating Action Buttons (WhatsApp & TikTok) -->
    <div class="floating-actions-container">
        <!-- Floating WhatsApp Button -->
        <a href="https://wa.me/<?php echo e(siteSetting('whatsapp_number', '6281359099658')); ?>?text=Halo%20PT%20Graha%20Lestari,%20saya%20ingin%20konsultasi%20properti" 
           target="_blank" rel="noopener" class="floating-btn-item floating-btn-wa" title="Konsultasi WhatsApp" aria-label="Hubungi WhatsApp">
            <span class="floating-btn-label">Konsultasi WhatsApp</span>
            <span class="floating-btn-icon">
                <i class="bi bi-whatsapp"></i>
            </span>
        </a>

        <!-- Floating TikTok Button -->
        <a href="<?php echo e(siteSetting('tiktok_url', 'https://www.tiktok.com/@grahalestari_konstruksi')); ?>" 
           target="_blank" rel="noopener" class="floating-btn-item floating-btn-tiktok" title="TikTok Official" aria-label="Kunjungi TikTok Official">
            <span class="floating-btn-label">TikTok Official</span>
            <span class="floating-btn-icon">
                <i class="bi bi-tiktok"></i>
            </span>
        </a>
    </div>

</body>
</html>
