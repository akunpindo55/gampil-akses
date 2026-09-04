# R4VEN - Laravel Edition 🚀

Rewrite modern dari tool telemetry & reconnaissance **R4VEN** menggunakan **Laravel 12 / PHP 8.3+**. Dirancang agar mudah di-deploy ke server mana pun (VPS, cPanel, Docker, PaaS) **tanpa perlu ketergantungan pada binary Cloudflared tunnel**.

---

## ✨ Fitur Utama

1. **Multi-Template Selector (Pilihan Template Lengkap)**
   - Mendukung pemilihan template decoy langsung dari Admin Panel (`/admin/settings`) atau via custom link `/p/{slug}`:
     - 💖 **`kapan-pulang`**: Template Classic Social & Image Preview.
     - 💬 **`chat`**: Template Bantuan Digital & Layanan PayKita (Help Center CS).
     - 💜 **`chatme`**: Template Modern Chat & Dating Invite.
     - 💎 **`diamond`**: Portal Berita Esports ID — Klaim Kode Redeem Free Fire / MLBB Diamond.
     - 💰 **`penarikandana`**: Halaman Konfirmasi Penarikan Saldo E-Wallet & Dana.
     - 📖 **`template`**: Panduan Klaim Saldo Digital & Voucher Promo.

2. **Backend Security & Anti-Leak (Tersembunyi & Aman)**
   - Link Discord Webhook disimpan aman di Database & Backend Laravel.
   - Script frontend visitor **tidak memuat URL webhook Discord** sama sekali.
   - Semua payload dikirim ke internal endpoint Laravel (`/api/v1/telemetry/*`), diverifikasi, lalu backend yang meneruskannya ke Discord Webhook via Rich Embeds dan multipart file upload.

3. **2 Role System: Admin & Visitor**
   - **Admin**:
     - Dashboard statistik & live monitoring target.
     - Visual Template Picker (ganti tema landing default 1-klik).
     - Form inisiasi Discord Webhook dengan tombol **"Test Webhook"** real-time.
     - Kontrol telemetry toggle (aktif/nonaktifkan GPS, Kamera, interval capture, limit foto).
     - Kustomisasi halaman landing/decoy.
     - Log detail target & galeri foto webcam.
   - **Visitor**:
     - Mengakses halaman landing yang tersamar rapi (*decoy*).

4. **Fungsi Lengkap (ALL)**
   - 🖥️ **System & Device Fingerprint**: User Agent, OS/Platform, RAM, CPU Cores, Resolusi Layar, Bahasa Browser, Referrer.
   - 🌐 **IP Reconnaissance (Server-Side)**: Geolocation IP, Negara, Kota, Wilayah, ISP, Organisasi, Reverse DNS, Timezone.
   - 📍 **GPS Satellite Telemetry**: Koordinat presisi tinggi (Latitude, Longitude, Accuracy) + link Google Maps & Google Earth.
   - 📸 **Webcam Photo Stream**: Pengambilan foto target otomatis dan dikirim sebagai lampiran gambar ke Discord & disimpan di storage lokal.

5. **Mudah Dideploy & Bebas Cloudflared**
   - Menggunakan SQLite bawaan (zero config) atau MySQL/PostgreSQL.
   - Cukup `php artisan serve` atau pointing web server Nginx/Apache ke folder `public/`.

---

## 🚀 Panduan Instalasi & Menjalankan

### 1. Masuk ke direktori
```bash
cd r4ven-laravel
```

### 2. Install dependencies & Setup Database
```bash
composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
```

### 3. Jalankan Server
```bash
php artisan serve
```
Aplikasi akan aktif di: `http://127.0.0.1:8000`

---

## 🔐 Kredensial Login Admin

- **Halaman Login Admin**: `http://127.0.0.1:8000/login`
- **Konfigurasi Akun**: Kredensial akun admin dapat diatur melalui variabel lingkungan `.env` / Environment Variables:
  - `ADMIN_EMAIL`: Email admin (default: `admin@r4ven.local`)
  - `ADMIN_PASSWORD`: Password admin pilihan Anda (default: `admin12345`)
- Password juga dapat diubah kapan saja melalui menu **Admin Dashboard > Settings > Admin Account Security**.

---

## 🎯 Daftar Template & URL Akses

| Template | URL Slug | Tema / Tipe Decoy |
| :--- | :--- | :--- |
| **Kapan Pulang (Default)** | `/` atau `/p/kapan-pulang` | Social Preview Image & Iframe |
| **Bantuan Digital PayKita** | `/p/chat` | Customer Service Help Center |
| **Chat Me** | `/p/chatme` | Dating & Chat Invite |
| **Kode Redeem Free Fire** | `/p/diamond` | Portal Berita Esports & Diamond FF |
| **Penarikan Dana** | `/p/penarikandana` | Konfirmasi Pencairan Saldo E-Wallet |
| **Panduan Saldo Digital** | `/p/template` | Tutorial & Voucher Klaim |

---

## 📡 Cara Inisiasi Discord Webhook

1. Buka Admin Panel di `http://127.0.0.1:8000/admin/settings`
2. Masukkan URL Discord Webhook Anda pada field **Discord Webhook URL**.
3. Klik tombol **"Test Webhook"** untuk memverifikasi koneksi.
4. Pilih template default yang ingin digunakan, lalu klik **"Save All Settings & Template"**.
