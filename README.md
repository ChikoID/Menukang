# Menukang

**Pembangunan Sistem Website C2C Marketplace Jasa Tukang Berbasis Web Menggunakan Sistem Filter dan Pemetaan Lokasi di Wilayah Pekanbaru**

Projek mata kuliah **Interaksi Manusia dan Komputer**
Program Studi Teknik Informatika, Jurusan Teknologi Informasi, T.A. 2025/2026

## Tentang Projek

Di Kota Pekanbaru, jasa tukang bangunan (renovasi, perbaikan atap, dinding, lantai, pengecoran) dan tukang kebun (pemangkasan pohon, potong rumput, penanaman bibit, pembuatan taman) masih dicari secara informal. Pelanggan biasanya mencari lewat rekomendasi keluarga, tetangga, grup WhatsApp, media sosial, atau perantara. Harga disepakati secara lisan dan tidak ada catatan kesepakatan tertulis.

Dari pengumpulan data terhadap tukang bangunan dan tukang kebun, ditemukan beberapa masalah:

- Pelanggan sulit menilai keahlian, pengalaman, dan jangkauan wilayah tukang, sementara tukang hanya mendapat panggilan dari lingkungan sekitarnya.
- Jarak dan jangkauan layanan menjadi sumber masalah, karena Pekanbaru terdiri dari 15 kecamatan dengan wilayah yang cukup luas.
- Kondisi lapangan sering berbeda dari foto yang dikirim pelanggan.
- Harga tidak memiliki acuan, dan belum jelas siapa yang menanggung material, alat, dan biaya survei.
- Tidak ada catatan kesepakatan yang dapat dirujuk kedua pihak saat pekerjaan tertunda atau bermasalah.

**Menukang** adalah marketplace C2C (*consumer to consumer*) yang mempertemukan pelanggan dengan tukang secara langsung. Pelanggan dapat mencari tukang berdasarkan jenis keahlian dan lokasi, sedangkan tukang dapat menjangkau pelanggan di luar lingkungan sekitarnya.

### Fitur yang Sudah Tersedia

- **Registrasi dan login** dengan tiga peran: **Admin**, **Tukang**, dan **Pelanggan**.
- **Dashboard terpisah** untuk setiap peran.
- **Profil tukang**: jenis tukang, area layanan, pengalaman, dan status aktif.
- **Admin** dapat mengelola data pengguna dan jenis tukang (tambah, lihat, ubah, hapus), lengkap dengan pencarian dan filter.

### Fitur yang Direncanakan

- Filter tukang berdasarkan jenis layanan, area, dan kriteria lainnya.
- Pemetaan lokasi tukang dan pelanggan di wilayah Pekanbaru.

## Anggota Kelompok

**Kelompok 11, Kelas 2 TI E**

| No | Nama | NIM |
|---|---|---|
| 1 | Chiko Maulana Ahmad | 2555301041 |
| 2 | Reynata Handra Vilano | 2555301167 |
| 3 | Zalva Zahiyah Manda Davia Putri | 2555301209 |

**Dosen Pengampu:** Rika Perdana Sari, S.T., M.Eng.

## Teknologi yang Digunakan

| Bagian | Teknologi |
|---|---|
| Backend | Laravel 13 (PHP 8.3 ke atas) |
| Frontend | Blade, Tailwind CSS 4, Flowbite 4 |
| Ikon | Font Awesome 7 dan Flowbite Icons |
| Database | SQLite (bawaan) atau MySQL |
| Build tool | Vite |
| Testing | Pest |

---

## Cara Instalasi

### 1. Persiapan

Pastikan perangkat lunak berikut sudah terpasang di komputer Anda:

| Perangkat Lunak | Versi Minimal | Cara Cek |
|---|---|---|
| PHP | 8.3 | `php -v` |
| Composer | 2.x | `composer -V` |
| Node.js | 20.19 atau 22.12 | `node -v` |
| npm | (ikut Node.js) | `npm -v` |
| Git | (bebas) | `git --version` |

> **Pengguna Windows:** cara paling mudah adalah memakai [Laragon](https://laragon.org/), karena PHP, Composer, Node.js, dan MySQL sudah tersedia di dalamnya. Letakkan projek di folder `C:\laragon\www`.

Pastikan juga ekstensi PHP berikut aktif di `php.ini`: `pdo_sqlite` (atau `pdo_mysql` jika memakai MySQL), `mbstring`, `openssl`, `fileinfo`, dan `curl`.

### 2. Clone Repository

```bash
git clone https://github.com/ChikoID/Menukang.git
cd Menukang
```

### 3. Install Dependency PHP

```bash
composer install
```

### 4. Siapkan File `.env`

Salin file contoh konfigurasi, lalu buat application key:

```bash
cp .env.example .env
php artisan key:generate
```

> Di Command Prompt Windows, gunakan `copy .env.example .env` sebagai pengganti `cp`.

Jika ingin nama aplikasi tampil sebagai "Menukang", ubah baris berikut di `.env`:

```env
APP_NAME=Menukang
```

### 5. Siapkan Database

Pilih **salah satu** cara di bawah ini.

#### Pilihan A: SQLite (paling mudah, tanpa server database)

Konfigurasi bawaan sudah memakai SQLite. Anda cukup membuat file database kosong:

```bash
# Linux / macOS / Git Bash
touch database/database.sqlite

# Windows PowerShell
New-Item database/database.sqlite
```

#### Pilihan B: MySQL

1. Buat database baru, misalnya `menukang`, melalui phpMyAdmin, HeidiSQL, atau terminal MySQL.
2. Ubah bagian database di `.env` menjadi seperti ini (hapus tanda `#` di depannya):

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=menukang
   DB_USERNAME=root
   DB_PASSWORD=
   ```

   Sesuaikan `DB_USERNAME` dan `DB_PASSWORD` dengan pengaturan MySQL Anda. Di Laragon, bawaannya adalah `root` tanpa password.

### 6. Jalankan Migrasi dan Seeder

Perintah ini membuat semua tabel sekaligus mengisi akun awal:

```bash
php artisan migrate --seed
```

Seeder akan membuat akun berikut:

| Peran | Email | Password |
|---|---|---|
| Admin | `admin@menukang.test` | `password` |
| Pengguna uji (tanpa peran) | `test@example.com` | `password` |

> ⚠️ **Penting:** akun di atas hanya untuk keperluan pengembangan. Segera ganti password jika aplikasi dipasang di server yang dapat diakses publik.

Untuk membuat ulang akun admin saja, tanpa mengulang semua seeder, jalankan:

```bash
php artisan db:seed --class=AdminSeeder
```

### 7. Install Dependency Frontend

```bash
npm install
```

### 8. Jalankan Aplikasi

**Mode pengembangan** (tampilan langsung diperbarui saat file diubah). Jalankan dua perintah ini di **dua terminal terpisah**:

```bash
# Terminal 1: server Laravel
php artisan serve

# Terminal 2: server Vite untuk CSS dan JavaScript
npm run dev
```

Kemudian buka **http://localhost:8000** di browser.

**Mode build** (tanpa perlu menjalankan `npm run dev`):

```bash
npm run build
php artisan serve
```

> **Pengguna Laragon:** setelah menekan tombol **Start All**, aplikasi bisa dibuka melalui **http://menukang.test** tanpa `php artisan serve`. Anda tetap perlu menjalankan `npm run dev` atau `npm run build` terlebih dahulu.

### 9. Login

Buka halaman **/login**, lalu masuk dengan akun admin dari langkah 6. Anda akan diarahkan ke dashboard admin.

Akun tukang dan pelanggan dapat dibuat melalui halaman **/register**, atau oleh admin melalui menu **Pengguna**.

---

## Cara Cepat (Instalasi Otomatis)

Projek ini menyediakan script yang menjalankan langkah 3, 4, 6 (tanpa seeder), 7, dan build frontend sekaligus:

```bash
composer run setup
php artisan db:seed
```

Jika memakai SQLite, buat dulu file `database/database.sqlite` seperti pada langkah 5 sebelum menjalankan perintah di atas.

## Menjalankan Test

```bash
php artisan test
```

## Mengatasi Masalah yang Sering Terjadi

| Masalah | Solusi |
|---|---|
| `Unable to locate file in Vite manifest` | Jalankan `npm run build`, atau biarkan `npm run dev` tetap berjalan. |
| `No application encryption key has been specified` | Jalankan `php artisan key:generate`. |
| `Database file at path [...] does not exist` | Buat file `database/database.sqlite` (lihat langkah 5, pilihan A). |
| `SQLSTATE[HY000] [1049] Unknown database` | Database MySQL belum dibuat, atau nama di `DB_DATABASE` tidak sesuai. |
| `could not find driver` | Aktifkan ekstensi `pdo_sqlite` atau `pdo_mysql` di `php.ini`, lalu restart terminal atau Laragon. |
| Tampilan berantakan atau tidak ada style | Pastikan `npm run dev` sedang berjalan atau `npm run build` sudah dijalankan, lalu muat ulang halaman dengan `Ctrl + F5`. |
| Perubahan `.env` tidak terbaca | Jalankan `php artisan config:clear`. |
