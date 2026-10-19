CREATE DATABASE IF NOT EXISTS kontraktor_ponorogo CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE kontraktor_ponorogo;

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin', 'manager', 'staff') NOT NULL DEFAULT 'admin',
    status ENUM('active', 'inactive') NOT NULL DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS services (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    slug VARCHAR(150) NOT NULL UNIQUE,
    description TEXT,
    icon VARCHAR(100) DEFAULT NULL,
    sort_order INT UNSIGNED DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS projects (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) NOT NULL UNIQUE,
    location VARCHAR(200) DEFAULT NULL,
    category VARCHAR(100) DEFAULT NULL,
    budget VARCHAR(100) DEFAULT NULL,
    status ENUM('ongoing', 'completed', 'planning') NOT NULL DEFAULT 'planning',
    description TEXT,
    cover_image VARCHAR(255) DEFAULT NULL,
    start_date DATE DEFAULT NULL,
    end_date DATE DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS houses (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    slug VARCHAR(200) NOT NULL UNIQUE,
    price VARCHAR(100) NOT NULL,
    location VARCHAR(200) DEFAULT NULL,
    area_size VARCHAR(100) DEFAULT NULL,
    bedrooms INT UNSIGNED DEFAULT 0,
    bathrooms INT UNSIGNED DEFAULT 0,
    type VARCHAR(100) DEFAULT NULL,
    description TEXT,
    cover_image VARCHAR(255) DEFAULT NULL,
    status ENUM('available', 'sold') NOT NULL DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS project_images (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    project_id INT UNSIGNED NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    caption VARCHAR(200) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_project_images_project FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS testimonials (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(120) NOT NULL,
    company_name VARCHAR(150) DEFAULT NULL,
    message TEXT NOT NULL,
    rating TINYINT UNSIGNED DEFAULT 5,
    is_active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS contacts (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(30) DEFAULT NULL,
    subject VARCHAR(180) DEFAULT NULL,
    message TEXT NOT NULL,
    status ENUM('new', 'read', 'replied') NOT NULL DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS site_settings (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    key_name VARCHAR(100) NOT NULL UNIQUE,
    key_value TEXT,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO users (name, email, password_hash, role, status) VALUES
('Administrator', 'admin@kontraktorponorogo.com', '$2y$10$idqxhGmWwvuIBNVI4Owwnea9NCEk0u3Y9ltcr/M8x37leN4pJQycm', 'admin', 'active');

INSERT INTO services (title, slug, description, icon, sort_order) VALUES
('Renovasi rumah', 'renovasi-rumah', 'Pelayanan renovasi interior & eksterior rumah, kantor, dan komersial.', 'paint-bucket', 1),
('Jasa Desain Rumah', 'jasa-desain-rumah', 'Perencanaan arsitektur, gambar 3D, denah rumah, serta estimasi perhitungan RAB.', 'pencil-ruler', 2),
('Pembuatan rumah & Gedung', 'pembuatan-rumah-gedung', 'Pembangunan rumah tinggal, villa, ruko, toko, dan gedung komersial.', 'building', 3);

INSERT INTO houses (title, slug, price, location, area_size, bedrooms, bathrooms, type, description, cover_image, status) VALUES
('Cluster Villa Asri', 'cluster-villa-asri', 'Rp 540.000.000', 'Ponorogo', '120 m²', 3, 2, 'Villa', 'Rumah modern dengan desain asri, ruang keluarga terbuka, dan taman kecil depan rumah.', 'uploads/houses/cluster-villa-asri.jpg', 'available'),
('Rumah Minimalis 2 Lantai', 'rumah-minimalis-2-lantai', 'Rp 680.000.000', 'Batuanjung', '150 m²', 4, 3, 'Minimalis', 'Desain minimalis modern dengan 2 lantai untuk keluarga yang membutuhkan ruang lebih lega.', 'uploads/houses/rumah-minimalis-2-lantai.jpg', 'available'),
('Townhouse Premium', 'townhouse-premium', 'Rp 780.000.000', 'Ponorogo', '170 m²', 4, 3, 'Townhouse', 'Townhouse premium dengan konsep nyaman, elegan, dan didukung fasilitas pendukung yang lengkap.', 'uploads/houses/townhouse-premium.jpg', 'sold');

INSERT INTO projects (title, slug, location, category, budget, status, description, cover_image, start_date, end_date) VALUES
('Rumah Tinggal Modern', 'rumah-tinggal-modern', 'Ponorogo', 'Rumah', 'Rp. 3.500.000/m2', 'completed', 'Proyek pembangunan rumah tinggal modern dengan desain fungsional.', 'uploads/projects/rumah-tinggal-modern.jpg', '2024-01-10', '2024-06-20'),
('Kantor CV Mitra Jaya', 'kantor-cv-mitra-jaya', 'Ponorogo', 'Komersial', 'Rp. 3.500.000/m2', 'ongoing', 'Pembangunan kantor usaha dilengkapi ruang kerja dan area reception.', 'uploads/projects/kantor-cv-mitra-jaya.jpg', '2025-02-15', NULL),
('Renovasi Toko', 'renovasi-toko', 'Sleman', 'Renovasi', 'Rp. 3.500.000/m2', 'completed', 'Renovasi toko dengan konsep lebih modern dan luas.', 'uploads/projects/renovasi-toko.jpg', '2024-08-01', '2024-10-15');

INSERT INTO site_settings (key_name, key_value) VALUES
('site_name', 'Kontraktor Ponorogo'),
('site_tagline', 'Jasa Konstruksi & Renovasi Profesional'),
('whatsapp_number', '6281359099658'),
('email_contact', 'info@kontraktorponorogo.com'),
('company_address', 'Jl. Raya Ponorogo, Kabupaten Ponorogo, Jawa Timur, Indonesia');

CREATE TABLE IF NOT EXISTS company_structures (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    position_key VARCHAR(50) NOT NULL UNIQUE,
    name VARCHAR(150) NOT NULL,
    role_title VARCHAR(150) NOT NULL,
    photo_path VARCHAR(255) DEFAULT NULL,
    sort_order INT UNSIGNED DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO company_structures (position_key, name, role_title, sort_order) VALUES
('komisaris_1', 'RICHWANTY SETYA SARI', 'KOMISARIS', 1),
('komisaris_2', 'YANU VITA SARI', 'KOMISARIS', 2),
('direktur', 'DONY SAKTI DAMARA', 'DIREKTUR', 3),
('gm', 'RESTU OKTA YANO', 'GENERAL MANAGER', 4),
('pengawas', 'JOHANS MARCELINO', 'PENGAWAS LAPANGAN', 5),
('arsitek', 'SONI PUTRA', 'ARSITEK', 6),
('keuangan', 'LINDA KRISTIANA', 'KEUANGAN', 7),
('gudang', 'MUHAMMAD SUGIK', 'GUDANG', 8);

