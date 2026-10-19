# 🛡️ Panduan & Kebijakan Keamanan Aplikasi (keamanan.md)
**Website PT Graha Lestari (Developer & Kontraktor Properti)**

Dokumen ini memuat standar keamanan, mekanisme perlindungan data, serta praktik terbaik (*best practices*) yang diterapkan pada sistem aplikasi web PT Graha Lestari.

---

## 📋 Ringkasan Keamanan Utama

| Sektor Keamanan | Status | Mekanisme Perlindungan |
| :--- | :---: | :--- |
| **SQL Injection (SQLi)** | ✅ Terlindungi | PDO Prepared Statements dengan *parameterized queries* pada seluruh Model data. |
| **Cross-Site Scripting (XSS)** | ✅ Terlindungi | Fungsi Helper `e()` menggunakan `htmlspecialchars(..., ENT_QUOTES, 'UTF-8')`. |
| **Kredensial & Password** | ✅ Terlindungi | Enkripsi hashing standar PHP `password_hash()` (Bcrypt). |
| **Session Hijacking & Fixation** | ✅ Terlindungi | `session_regenerate_id(true)`, `cookie_httponly=1`, `use_strict_mode=1`. |
| **Upload File Berbahaya** | ✅ Terlindungi | Whitelist ekstensi gambar (`jpg`, `jpeg`, `png`, `webp`, `gif`, `svg`) & nama file acak unik. |
| **Keamanan Server & HTTP** | ✅ Terlindungi | Header keamanan HTTP, pembatasan akses file sensitif via `.htaccess`, dan pematikan *Directory Listing*. |

---

## ⚙️ 1. Proteksi Tingkat Kode Aplikasi (PHP Native MVC)

### A. Pencegahan SQL Injection (SQLi)
Seluruh query database dijalankan melalui class `Database` (`app/core/Database.php`) dan class `Model` (`app/core/Model.php`) menggunakan **PDO (PHP Data Objects)**.
- Query tidak pernah menggabungkan input mentah pengguna secara langsung (*string concatenation*).
- Menggunakan *bound parameters* (`prepare()` & `execute()`) untuk menjamin input diperlakukan sebagai data murni, bukan kode SQL.

### B. Pencegahan Cross-Site Scripting (XSS)
- Seluruh output teks yang ditampilkan di view menggunakan fungsi helper `e()` (`app/helpers.php`):
  ```php
  function e(string $value): string {
      return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
  }
  ```
- Ini memastikan karakter khusus seperti `<script>`, `>`, `<`, `"`, `'` diubah menjadi HTML entity aman.

### C. Manajemen Hashing Password
- Sistem tidak pernah menyimpan password dalam bentuk teks murni (*plain text*).
- Pembuatan dan pembaruan password menggunakan:
  ```php
  password_hash($password, PASSWORD_DEFAULT);
  ```
- Verifikasi saat login admin dilakukan dengan:
  ```php
  password_verify($password, $user['password_hash']);
  ```

### D. Keamanan Sesi (Session Security)
- **Cookie Security**: Pengaturan cookie session diperketat pada file `index.php`:
  - `session.cookie_httponly = 1`: Mencegah JavaScript (XSS) membaca cookie sesi.
  - `session.use_only_cookies = 1`: Memastikan sesi hanya ditransmisikan via cookie.
  - `session.use_strict_mode = 1`: Mencegah *Session Fixation* dari ID yang dibuat penyerang.
- **Session Regeneration**: Panggilan `session_regenerate_id(true)` dieksekusi saat login berhasil untuk mengganti ID sesi lama.

### E. Validasi & Pembatasan Upload File
Proses upload file pada `saveUploadedFile()` di `app/helpers.php` dilengkapi filter ketat:
1. **Whitelist Ekstensi**: Hanya mengizinkan jenis file `.jpg`, `.jpeg`, `.png`, `.webp`, `.gif`, `.svg`.
2. **Randomisasi Nama File**: Mengubah nama file asli menjadi format unik acak (`time() . '_' . uniqid() . '.' . $extension`) untuk mencegah pembacaan langsung atau pengisian nama file malicious.
3. **Penyimpanan Terisolasi**: File disimpan di direktori `uploads/` terpisah.

---

## 🔒 2. Keamanan Konfigurasi Web Server (.htaccess)

Konfigurasi `.htaccess` diperketat dengan aturan berikut:
1. **Pematikan Directory Browsing**:
   ```htaccess
   Options -Indexes
   ```
   Mencegah pengunjung melihat daftar isi folder jika file index tidak ditemukan.

2. **Penerapan HTTP Security Headers**:
   - `X-Content-Type-Options: nosniff`: Mencegah MIME-type sniffing.
   - `X-Frame-Options: SAMEORIGIN`: Mencegah serangan *Clickjacking* via iframe luar.
   - `X-XSS-Protection: 1; mode=block`: Mengaktifkan filter XSS bawaan browser.
   - `Referrer-Policy: strict-origin-when-cross-origin`: Melindungi data referrer.

3. **Proteksi File Sensitif**:
   ```htaccess
   <FilesMatch "^\.|\.(sql|env|json|md|log)$">
       Order allow,deny
       Deny from all
   </FilesMatch>
   ```
   Memblokir akses publik ke file konfigurasi, dump SQL (`schema.sql`), file `.env`, dan log server.

---

## 🔑 3. Panduan Operasional & Pemeliharaan Aman

### 1. Mengubah Kredensial Login Admin Default
> ⚠️ **SANGAT PENTING**: Ubah password default admin setelah instalasi awal!
- Default Email: `admin@kontraktorponorogo.com`
- Default Password: `admin123`
- Segera ubah melalui menu **Admin Dashboard > Manajemen Pengguna** atau perbarui record database.

### 2. Pengelolaan Pengguna (User Management)
- Gunakan fitur status `active` / `inactive` pada menu Manajemen Pengguna untuk menonaktifkan akses staf yang sudah tidak bertugas tanpa menghapus riwayat data.

### 3. Backup Database Secara Berkala
- Lakukan ekspor (*dump*) berkala pada database MySQL `kontraktor_ponorogo`.
- Simpan file backup database di lokasi privat yang aman dan **di luar direktori publik web server**.

---

## 🚀 4. Rekomendasi Peningkatan Keamanan Lanjutan (Production Deployment)

Ketika sistem dideploy ke server *production* (hosting / VPS), direkomendasikan untuk mengaktifkan:

1. **Sertifikat SSL/TLS (HTTPS)**:
   - Wajib mengaktifkan HTTPS agar lalu lintas data login admin dan formulir kontak terenkripsi.
   - Tambahkan arahan HTTP to HTTPS redirect pada `.htaccess`.
   - Setel `session.cookie_secure = 1` pada server HTTPS.

2. **Perlindungan CSRF (Cross-Site Request Forgery)**:
   - Menambahkan CSRF Token berbasis sesi pada form POST admin & form kontak publik.

3. **Limitasi Login (Rate Limiting)**:
   - Mengaktifkan pembatasan percobaan login (misal: maksimal 5 kali percobaan gagal sebelum diblokir sementara) untuk mencegah serangan *Brute Force*.

---

*Dokumen Keamanan PT Graha Lestari — Diperbarui secara berkala sesuai perkembangan kode dan kebutuhan sistem.*
