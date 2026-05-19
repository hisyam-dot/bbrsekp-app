# BBRSEKP Information System

Sistem Informasi Desa berbasis web untuk menampilkan data wilayah (Provinsi, Kabupaten, Kecamatan, Desa) serta dokumen dan informasi pendukung.

---

## 🚀 Fitur Utama

- Manajemen wilayah (Provinsi, Kabupaten, Kecamatan, Desa)
- Manajemen data desa dan informasi
- Upload dokumen (foto, laporan, bahan paparan, dll)
- Pencarian data + pencarian populer
- Dashboard admin (Filament)
- Role user (Admin & Pegawai)

---

## 🛠️ Teknologi

- Laravel 10+
- Filament Admin Panel
- MySQL
- Tailwind CSS
- Livewire

---

## 📦 Instalasi

### 1. Clone / Extract Project

```bash
git clone <repo-url>
cd bbrsekp
```

---

### 2. Install Dependency

```bash
composer install
npm install
npm run build
```

---

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

---

### 4. Setup Database

- Buat database: `bbrsekp`
- Import file `.sql`

Atur `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bbrsekp
DB_USERNAME=root
DB_PASSWORD=
```

---

### 5. Storage Link

```bash
php artisan storage:link

## Admin Secret Code

Set di .env:
ADMIN_SECRET_CODE=BBRSEKP2026
```
