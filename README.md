# Gaming Store - Laravel Marketplace

Gaming Store adalah aplikasi marketplace berbasis Laravel untuk jual beli item game, dengan fitur dompet digital, negosiasi harga, dashboard admin/seller/buyer, dan chat real-time.

## Fitur Utama

-   Registrasi & login multi-role (buyer, seller, admin)
-   Dashboard khusus untuk buyer, seller, dan admin
-   Manajemen produk & kategori
-   Dompet digital (top up, transaksi, riwayat)
-   Negosiasi harga antara buyer & seller
-   Sistem pesanan & review
-   Chat (bukan real-time)
-   Responsive UI (Tailwind CSS)

## Setup & Instalasi

Ikuti langkah berikut untuk menjalankan project ini secara lokal:

### 1. Clone Repository

```bash
git clone https://github.com/username/Gaming-Store.git
cd Gaming-Store
```

### 2. Install Dependency PHP & JS

```bash
composer install
npm install
```

### 3. Copy & Konfigurasi .env

```bash
cp .env.example .env
```

Edit file `.env` sesuai kebutuhan (database, mail, dsb).

### 4. Setup Midtrans Payment Gateway

Untuk mengaktifkan pembayaran dengan Midtrans:

1. Daftar akun di [Midtrans Dashboard](https://dashboard.midtrans.com/).
2. Ambil `SERVER_KEY` dan `CLIENT_KEY` dari menu Settings > Access Keys.
3. Tambahkan ke file `.env`:

    ```env
    MIDTRANS_SERVER_KEY=your_server_key
    MIDTRANS_CLIENT_KEY=your_client_key
    MIDTRANS_IS_PRODUCTION=false
    MIDTRANS_MERCHANT_ID=your_merchant_id
    ```

4. Pastikan callback URL diatur ke:

    - `https://your-domain.com/midtrans/callback` (atau sesuai route di aplikasi)

5. Untuk mode production, ubah `MIDTRANS_IS_PRODUCTION=true` dan pastikan domain sudah HTTPS.

### 5. Generate Key

```bash
php artisan key:generate
```

### 6. Migrasi & Seed Database

```bash
php artisan migrate --seed
```

### 7. Link Storage

```bash
php artisan storage:link
```

### 8. Build Asset Frontend

```bash
npm run build
```

atau untuk development:

```bash
npm run dev
```

### 9. Jalankan Server

```bash
php artisan serve
```

atau gunakan Laragon/XAMPP sesuai kebutuhan.

---

## Akun Demo (Opsional)

-   Admin: admin@example.com / password
-   Seller: seller@example.com / password
-   Buyer: buyer@example.com / password

## Kontribusi

Pull request & issue sangat diterima! Silakan fork repo ini dan buat PR untuk fitur/bugfix.

## Lisensi

MIT. Lihat LICENSE file.
