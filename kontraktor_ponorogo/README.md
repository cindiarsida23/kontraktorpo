# Website PT Graha Lestari (Developer & Kontraktor Properti)

Website resmi PT Graha Lestari dengan desain modern, bersih, profesional, dan elegan selayaknya developer properti premium. Dibangun menggunakan PHP Native (MVC), MySQL, Bootstrap 5.3, dan Google Fonts (Plus Jakarta Sans & Inter).

---

## 🌐 Akses Halaman Website

### 1. Halaman Publik (Pengunjung)
- **Beranda (Home)**: `http://localhost/kontraktor_ponorogo/`
- **Profil Perusahaan**: `http://localhost/kontraktor_ponorogo/tentang-kami`
- **Layanan**: `http://localhost/kontraktor_ponorogo/layanan`
- **Portofolio Proyek**: `http://localhost/kontraktor_ponorogo/portofolio`
- **Kontak & Konsultasi**: `http://localhost/kontraktor_ponorogo/kontak`

---

### 2. Halaman Admin Pengelola (Dashboard Admin)
Halaman admin dikhususkan untuk pengelola/administrator dalam mengelola konten rumah, layanan, dan proyek portofolio.

- **URL Login Admin**: `http://localhost/kontraktor_ponorogo/admin/login`
- **Dashboard Utama**: `http://localhost/kontraktor_ponorogo/admin`
- **Kelola Data Rumah**: `http://localhost/kontraktor_ponorogo/admin/houses`
- **Kelola Data Layanan**: `http://localhost/kontraktor_ponorogo/admin/services`
- **Kelola Data Portofolio Proyek**: `http://localhost/kontraktor_ponorogo/admin/projects`
- **Logout Admin**: `http://localhost/kontraktor_ponorogo/admin/logout`

#### 🔑 Kredensial Login Admin Default:
- **Email**: `admin@kontraktorponorogo.com`
- **Password**: `admin123`

---

## 📂 Struktur Folder Aplikasi

- `app/controllers` : Controller penanganan request (Frontend & Admin Dashboard)
- `app/models` : Model data MySQL (Houses, Projects, Services, Contact, Testimonials, Users)
- `app/core` : Base MVC Controller & Sistem Koneksi Database (PDO)
- `app/views/site` : Layout & View Halaman Publik (Off-White & Forest Green Theme)
- `app/views/admin` : View Dashboard & Form Manajemen Admin
- `app/views/auth` : Halaman Login Admin
- `config` : Konfigurasi database & aplikasi
- `database` : File skema & seeder SQL (`database/schema.sql`)
- `public` : Asset gambar, logo, dan file upload
- `index.php` : Router utama aplikasi (Front Controller)
- `keamanan.md` : Dokumentasi & panduan standar keamanan aplikasi

---

## 🛠️ Cara Penginstalan & Jalankan Aplikasi

1. Pastikan web server (XAMPP / Apache) dan MySQL service sudah aktif.
2. Salin/taruh folder proyek ini di direktori web server:
   `C:/xampp/htdocs/kontraktor_ponorogo`
3. Import file `database/schema.sql` ke dalam MySQL/phpMyAdmin:
   - Buat database `kontraktor_ponorogo`
   - Import `database/schema.sql`
4. Sesuaikan konfigurasi koneksi database di `config/database.php` jika diperlukan (host, username, password).
5. Buka browser dan akses `http://localhost/kontraktor_ponorogo/`.
