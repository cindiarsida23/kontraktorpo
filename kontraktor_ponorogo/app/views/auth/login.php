<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'Login Admin - PT Graha Lestari'); ?></title>
    <!-- Google Fonts: Plus Jakarta Sans & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5.3 & Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

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
        }

        body {
            background: linear-gradient(135deg, #F8F9F6 0%, #EBF2ED 100%);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem 1rem;
        }

        .login-card {
            background-color: var(--card-bg);
            border-radius: 24px;
            border: 1px solid var(--border-color);
            box-shadow: 0 20px 50px rgba(47, 111, 62, 0.09);
            width: 100%;
            max-width: 440px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .login-header {
            background: linear-gradient(180deg, var(--sage-light) 0%, rgba(240, 245, 241, 0.3) 100%);
            padding: 2.5rem 2rem 1.5rem 2rem;
            text-align: center;
            border-bottom: 1px solid var(--border-color);
        }

        .brand-logo {
            height: 64px;
            width: auto;
            object-fit: contain;
            margin-bottom: 1rem;
            filter: drop-shadow(0 4px 10px rgba(47, 111, 62, 0.15));
            transition: transform 0.3s ease;
        }

        .brand-logo:hover {
            transform: scale(1.05);
        }

        .brand-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary-green);
            letter-spacing: -0.02em;
            margin-bottom: 0.2rem;
        }

        .brand-subtitle {
            font-size: 0.82rem;
            color: var(--sage-green);
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .login-body {
            padding: 2rem 2.25rem 2.5rem 2.25rem;
        }

        .form-label {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600;
            font-size: 0.88rem;
            color: var(--text-primary);
            margin-bottom: 0.4rem;
        }

        .input-group-text {
            background-color: #FAFAFA;
            border-color: var(--border-color);
            border-radius: 12px 0 0 12px;
            color: var(--primary-green);
            font-size: 1.1rem;
            padding-left: 1.1rem;
            padding-right: 1.1rem;
        }

        .form-control {
            border-color: var(--border-color);
            border-radius: 0 12px 12px 0;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.25s ease;
        }

        .form-control-middle {
            border-radius: 0 !important;
        }

        .form-control:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 4px rgba(47, 111, 62, 0.12);
        }

        .btn-toggle-password {
            background-color: #FAFAFA;
            border: 1px solid var(--border-color);
            border-left: none;
            border-radius: 0 12px 12px 0 !important;
            color: var(--sage-green);
            padding-left: 1rem;
            padding-right: 1rem;
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .btn-toggle-password:hover {
            background-color: var(--sage-light);
            color: var(--primary-green);
            border-color: var(--border-color);
        }

        .btn-login {
            background-color: var(--primary-green);
            color: #FFFFFF;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 1rem;
            padding: 0.85rem 1.5rem;
            border-radius: 12px;
            border: none;
            width: 100%;
            transition: all 0.25s ease;
            box-shadow: 0 6px 18px rgba(47, 111, 62, 0.25);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            margin-top: 0.5rem;
        }

        .btn-login:hover {
            background-color: var(--primary-dark);
            color: #FFFFFF;
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(47, 111, 62, 0.35);
        }

        .back-link {
            color: var(--sage-green);
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 600;
            font-size: 0.88rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: color 0.2s ease, transform 0.2s ease;
        }

        .back-link:hover {
            color: var(--primary-green);
            transform: translateX(-3px);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <!-- Card Header with Logo & Brand Name -->
        <div class="login-header">
            <a href="<?php echo url(''); ?>">
                <img src="<?php echo url('public/images/logo-transparent.png'); ?>" alt="Logo PT Graha Lestari" class="brand-logo">
            </a>
            <h1 class="brand-title">PT Graha Lestari</h1>
            <span class="brand-subtitle">Portal Admin & Management</span>
        </div>

        <!-- Card Body with Login Form -->
        <div class="login-body">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4 d-flex align-items-center gap-2" style="font-size: 0.9rem;">
                    <i class="bi bi-exclamation-triangle-fill flex-shrink-0"></i>
                    <div><?php echo e($error); ?></div>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo url('admin/login'); ?>">
                <div class="mb-3">
                    <label class="form-label">Email Admin</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="nama@kontraktorponorogo.com" required autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control form-control-middle" id="passwordInput" name="password" placeholder="Masukkan password" required>
                        <button type="button" class="btn btn-toggle-password" id="togglePasswordBtn" title="Lihat/Sembunyikan Password">
                            <i class="bi bi-eye" id="togglePasswordIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right"></i> Masuk ke Dashboard
                </button>
            </form>

            <!-- Return to Home link -->
            <div class="text-center mt-4 pt-2">
                <a href="<?php echo url(''); ?>" class="back-link">
                    <i class="bi bi-arrow-left"></i> Kembali ke Website Utama
                </a>
            </div>
        </div>
    </div>

    <!-- Toggle Password Visibility Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('togglePasswordBtn');
            const passwordInput = document.getElementById('passwordInput');
            const toggleIcon = document.getElementById('togglePasswordIcon');

            if (toggleBtn && passwordInput && toggleIcon) {
                toggleBtn.addEventListener('click', function() {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    
                    if (isPassword) {
                        toggleIcon.classList.remove('bi-eye');
                        toggleIcon.classList.add('bi-eye-slash');
                        toggleBtn.setAttribute('title', 'Sembunyikan Password');
                    } else {
                        toggleIcon.classList.remove('bi-eye-slash');
                        toggleIcon.classList.add('bi-eye');
                        toggleBtn.setAttribute('title', 'Lihat Password');
                    }
                });
            }
        });
    </script>

</body>
</html>
