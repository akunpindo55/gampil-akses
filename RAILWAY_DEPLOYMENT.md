# Deploy Laravel ke Railway

Repositori ini sudah dioptimalkan untuk di-deploy ke Railway, lengkap dengan konfigurasi database dan penyimpanan lokal (Storage).

## 1. Deploy Aplikasi

1. Buka dashboard Railway (https://railway.app/).
2. Buat project baru (`New Project`) dan pilih **Deploy from GitHub repo**.
3. Pilih repository ini. Railway akan secara otomatis mendeteksi bahwa ini adalah aplikasi Laravel (menggunakan Nixpacks).

## 2. Setup Database

1. Di dalam project Railway Anda, klik **New** -> **Database** -> pilih **PostgreSQL** atau **MySQL**.
2. Setelah database siap, hubungkan database tersebut ke aplikasi Laravel Anda.
3. Buka aplikasi Laravel di dashboard Railway, lalu masuk ke tab **Variables**.
4. Railway secara otomatis akan memasukkan variable database (seperti `DATABASE_URL` atau `MYSQL_URL`) jika Anda menghubungkan service. Aplikasi Anda sudah dikonfigurasi untuk membaca variabel ini secara otomatis.
5. Tambahkan variable berikut di tab **Variables**:
   - `APP_ENV`: `production`
   - `APP_KEY`: (generate menggunakan `php artisan key:generate --show` di lokal Anda dan paste di sini)
   - `APP_DEBUG`: `false`
   - `APP_URL`: URL yang diberikan oleh Railway
   - `DB_CONNECTION`: `pgsql` (jika PostgreSQL) atau `mysql` (jika MySQL)
   - `FILESYSTEM_DISK`: `public` (jika Anda menggunakan upload file)

## 3. Setup Penyimpanan (Storage Volume)

Karena Railway container bersifat ephemeral (di-reset saat di-deploy ulang), file yang di-upload oleh user akan hilang jika tidak menggunakan Volume.

Untuk menyimpan data secara permanen:
1. Buka aplikasi Laravel Anda di Railway.
2. Masuk ke tab **Volumes**.
3. Klik **New Volume**.
4. Pada isian **Mount Path**, masukkan: `/app/storage`
5. Aplikasi akan otomatis menggunakan volume ini untuk seluruh isi folder `storage/`, sehingga gambar dan file tidak akan hilang ketika aplikasi di-deploy ulang.
