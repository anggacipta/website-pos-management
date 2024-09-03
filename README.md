# Website POS Management

Website POS Management adalah website untuk mengatur penjualan suatu produk. 
Website ini dibuat menggunakan Laravel 9.

## Persyaratan

- PHP >= 8.0
- Composer
- Node.js dan npm (atau yarn)
- Git
- Terhubung Internet

## Instalasi

Ikuti langkah-langkah berikut untuk menginstal proyek ini:

1. Clone repositori ini:

```bash
git clone https://github.com/anggacipta/website-pos-management.git
```

2. Masuk ke direktori proyek:

```bash
cd nama-direktori-setelah-clone
```

3. Instal dependensi PHP dengan Composer:

```bash
composer install
```

4. Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

5. Buat kunci aplikasi:

```bash
php artisan key:generate
```

6. Jalankan migrasi database (jika ada). Pastikan Anda sudah mengatur koneksi database di file `.env` sebelum menjalankan perintah ini:

```bash
php artisan migrate --seed
```

7. Jika proyek Anda menggunakan npm atau yarn untuk mengelola dependensi JavaScript, Anda juga perlu menjalankan perintah berikut:

```bash
npm install
# atau jika Anda menggunakan yarn
yarn install
```

8. Jika proyek Anda menggunakan Laravel Mix untuk mengkompilasi aset, Anda juga perlu menjalankan perintah berikut:

```bash
npm run dev
# atau jika Anda menggunakan yarn
yarn dev
```

9. Akhirnya, Anda dapat menjalankan server pengembangan Laravel dengan perintah berikut:

```bash
php artisan serve
```

Setelah menjalankan perintah ini, Anda harus dapat mengakses aplikasi Laravel Anda di `http://localhost:8000`.
