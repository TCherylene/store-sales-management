# Laravel Coding Test

Aplikasi ini merupakan hasil implementasi coding test menggunakan Laravel untuk pengelolaan user, salesman, toko, dan transaksi penjualan.

## Features

### Authentication

* Login
* Logout

### Dashboard

* Dashboard sebagai landing page setelah login

### Master User

* Create user
* Read/list user
* Update user

### Master Salesman

* List salesman
* Create salesman
* Detail salesman
* Update salesman
* Delete salesman
* Import data salesman dari Excel
* Export data salesman ke Excel
* Export data salesman ke PDF

### Master Toko

* List toko
* Create toko
* Detail toko
* Update toko
* Delete toko
* Import data toko dari Excel
* Export data toko ke Excel
* Export data toko ke PDF

### Penjualan

* List transaksi
* Create transaksi
* Detail transaksi
* Update transaksi
* Delete transaksi
* Import data penjualan dari Excel
* Export data penjualan ke Excel
* Export data penjualan ke PDF

## Installation

Clone repository kemudian install dependency:

```bash
composer install
npm install
```

Copy environment file:

```bash
cp .env.example .env
```

Generate application key:

```bash
php artisan key:generate
```

Sesuaikan konfigurasi database pada file `.env`.

Kemudian jalankan migration dan seeder:

```bash
php artisan migrate --seed
```

Jalankan aplikasi:

```bash
composer run dev
```

## Import Data

Import menggunakan file Excel dengan format `.xlsx` atau `.xls`.

Setiap module memiliki template import masing-masing:

* Salesman
* Toko
* Penjualan

Alur import:

1. Upload file Excel
2. Sistem membaca dan melakukan validasi setiap row
3. Hasil validasi ditampilkan dalam halaman preview
4. Data yang valid dapat di-import
5. Data existing akan di-update
6. Proses penyimpanan menggunakan database transaction

## Export Data

Data dapat diekspor berdasarkan module dalam format:

* Excel
* PDF

## Business Rules

* Kode salesman harus diawali dengan huruf.
* Area salesman ditentukan berdasarkan kode salesman.
* Salesman tidak dapat dihapus apabila merupakan satu-satunya salesman pada area yang masih digunakan oleh toko.
* Data toko memiliki kode toko baru dan kode toko lama.
* Area toko dikelola berdasarkan relasi toko dengan area sales.
* Data import existing akan di-update, sedangkan data baru akan dibuat.
* Data transaksi menggunakan identifier tersendiri untuk mendukung kebutuhan CRUD transaksi.

## Database

Project menggunakan database MySQL.

Struktur database mengikuti database yang diberikan pada coding test dengan penyesuaian minimal yang diperlukan untuk kebutuhan aplikasi, khususnya penambahan primary key pada data transaksi untuk mendukung proses CRUD dan route model binding.

## Notes

Fokus implementasi mencakup CRUD, validasi, relasi data, import/export, preview hasil import, serta penerapan business rules pada proses pengelolaan data.

## Author

Dibuat oleh **Cherylene Trevina**.
