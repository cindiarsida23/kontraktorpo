<?php

function basePath(): string
{
    return '/kontraktor_ponorogo';
}

function url(string $path): string
{
    return basePath() . '/' . ltrim($path, '/');
}

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

function redirect(string $path): void
{
    $target = url($path);
    header('Location: ' . $target);
    exit;
}

function isLoggedIn(): bool
{
    return isset($_SESSION['user_id']);
}

function currentUser(): ?array
{
    if (!isLoggedIn()) {
        return null;
    }

    return [
        'id' => $_SESSION['user_id'],
        'name' => $_SESSION['user_name'] ?? 'Admin',
        'email' => $_SESSION['user_email'] ?? '',
    ];
}

function flash(string $key, ?string $message = null): ?string
{
    if ($message === null) {
        if (!isset($_SESSION[$key])) {
            return null;
        }

        $value = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $value;
    }

    $_SESSION[$key] = $message;
    return $message;
}

function ensureUploadDirectory(string $path): void
{
    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }
}

function saveUploadedFile(array $file, string $folder): ?string
{
    if (!isset($file['name']) || $file['name'] === '') {
        return null;
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return null;
    }

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'svg'];
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

    if (!in_array($extension, $allowedExtensions, true)) {
        return null;
    }

    $baseDir = __DIR__ . '/../uploads/' . trim($folder, '/');
    ensureUploadDirectory($baseDir);

    $safeName = time() . '_' . uniqid() . '.' . $extension;
    $destination = $baseDir . '/' . $safeName;

    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return 'uploads/' . trim($folder, '/') . '/' . $safeName;
    }

    return null;
}

function assetUrl(?string $path, string $defaultFallback = 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80'): string
{
    if (empty($path)) {
        return $defaultFallback;
    }

    $cleanPath = ltrim($path, '/');
    $localFile = __DIR__ . '/../' . $cleanPath;

    if (file_exists($localFile) && is_file($localFile)) {
        return url($cleanPath);
    }

    // High quality architectural fallback images based on keyword hints
    if (str_contains($cleanPath, 'mitra-jaya') || str_contains($cleanPath, 'toko') || str_contains($cleanPath, 'komersial')) {
        return 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&w=800&q=80';
    } elseif (str_contains($cleanPath, 'renovasi')) {
        return 'https://images.unsplash.com/photo-1513694203232-719a280e022f?auto=format&fit=crop&w=800&q=80';
    } elseif (str_contains($cleanPath, 'villa')) {
        return 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?auto=format&fit=crop&w=800&q=80';
    } elseif (str_contains($cleanPath, 'minimalis')) {
        return 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=800&q=80';
    } elseif (str_contains($cleanPath, 'townhouse')) {
        return 'https://images.unsplash.com/photo-1600566753376-12c8ab7fb75b?auto=format&fit=crop&w=800&q=80';
    }

    return $defaultFallback;
}

function siteSetting(string $key, string $default = ''): string
{
    static $settingsMap = null;

    if ($settingsMap === null) {
        try {
            require_once __DIR__ . '/models/SiteSettingModel.php';
            $settingModel = new SiteSettingModel();
            $settingsMap = $settingModel->getAllAsMap();
        } catch (\Throwable $e) {
            $settingsMap = [];
        }
    }

    $val = $settingsMap[$key] ?? $default;

    if ($key === 'google_maps_iframe' && !empty($val)) {
        return sanitizeGoogleMapsUrl($val);
    }

    return $val;
}

function sanitizeGoogleMapsUrl(string $input): string
{
    $input = trim($input);
    if (empty($input)) {
        return 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126487.67499691901!2d111.40118537542967!3d-7.871146746865243!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e799f97914db48f%3A0x3027a76e352bb40!2sKabupaten%20Ponorogo%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid';
    }

    // Case 1: HTML iframe tag pasted -> extract src attribute
    if (preg_match('/src=["\']([^"\']+)["\']/i', $input, $matches)) {
        $input = $matches[1];
    }

    // Case 2: Already an embed URL
    if (str_contains($input, 'google.com/maps/embed') || str_contains($input, 'output=embed')) {
        return htmlspecialchars_decode($input);
    }

    // Case 3: Short link maps.app.goo.gl or standard google maps link
    if (str_contains($input, 'maps.app.goo.gl') || str_contains($input, 'google.com/maps')) {
        $effectiveUrl = $input;
        if (str_contains($input, 'maps.app.goo.gl')) {
            $ch = curl_init($input);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_exec($ch);
            $effectiveUrl = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL) ?: $input;
            curl_close($ch);
        }

        // Extract coordinates @lat,lng
        if (preg_match('/@(-?\d+\.\d+),(-?\d+\.\d+)/', $effectiveUrl, $coords)) {
            return "https://maps.google.com/maps?q={$coords[1]},{$coords[2]}&z=17&output=embed";
        }

        return "https://maps.google.com/maps?q=" . urlencode($input) . "&output=embed";
    }

    return "https://maps.google.com/maps?q=" . urlencode($input) . "&output=embed";
}

