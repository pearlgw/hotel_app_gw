# 🏨 Hotel App Project

Proyek ini adalah sistem manajemen hotel yang saya bangun dengan Laravel 12, Livewire, Midtrans, Minio, Docker, dan MySQL. Proyek ini terinspirasi dari teman saya yang memperkenalkan saya pada teknologi Minio, dan sejak saat itu saya tertarik untuk mencoba dan mengintegrasikannya ke dalam aplikasi Laravel.

---

## 🧰 Tech Stack

| Teknologi | Keterangan |
|----------|------------|
| **Laravel 12** | Framework PHP |
| **Livewire** | Untuk membuat UI dinamis tanpa reload |
| **Midtrans** | Integrasi pembayaran |
| **Minio** | Penyimpanan objek alternatif S3 |
| **Docker** | Untuk lingkungan pengembangan |
| **MySQL** | Database utama |
| **Spatie Roles & Permissions** | Manajemen role |
| **Laravel Breeze** | Autentikasi dan starter kit |
| **DBeaver** | GUI database client |

---

## 🚀 Fitur Utama

- 🔐 Autentikasi dengan Laravel Breeze
- 🧑‍🤝‍🧑 Manajemen role dengan Spatie (admin, staff, order)
- 📦 Integrasi penyimpanan menggunakan Minio (via Docker)
- ⚡ UI interaktif tanpa reload dengan Livewire
- 💳 Pembayaran menggunakan Midtrans
- 🛏️ Sistem reservasi hotel untuk tamu walk-in maupun remote
- 🗄️ CRUD kamar, kategori dan transaksi reservasi

---

## 📦 Tentang Minio

**Minio** adalah solusi penyimpanan objek yang kompatibel dengan S3 (Amazon Simple Storage Service). Minio berguna sebagai alternatif lokal atau self-hosted dari S3 dan cocok untuk pengembangan, testing, atau deployment mandiri.

### 🔧 Kegunaan Minio di Proyek Ini:

- Menyimpan file gambar kamar.
- Mudah diintegrasikan ke Laravel lewat `s3` filesystem driver.
- Berjalan via Docker, sehingga setup-nya simpel dan tidak butuh server cloud tambahan.

### ⚙️ Efek di Laravel:

- Laravel dapat menggunakan Minio seolah-olah itu Amazon S3.
- Menggunakan filesystem Laravel bawaan untuk upload dan akses file.
- Dapat dikombinasikan dengan Livewire untuk upload tanpa reload.
- Membantu mengurangi beban storage lokal Laravel sehingga aplikasi lebih ringan dan scalable.

## 💳 Midtrans untuk Pembayaran

Sistem pembayaran terintegrasi dengan Midtrans, sehingga pelanggan bisa melakukan pembayaran saat:

- Melakukan reservasi dari jauh (online)

Midtrans digunakan dalam mode sandbox untuk development dan testing.

---

## 🗓️ Timeline

Proyek ini saya bangun dari hari **Senin, 24 Maret 2025 hingga Jumat, 28 Maret 2025** secara penuh.

---

## 🗂️ Database Design (ERD)

📌 *Tambahkan gambar ERD di sini*  
`/public/images/erd.png`  
![ERD](https://github.com/pearlgw/hotel_app_gw/blob/master/images/Sistem%20Hotel.png)

---

## 🖼️ Demo Aplikasi

📸 *Tambahkan screenshot hasil project kamu di sini*  
`/public/images/demo-1.png`  
`/public/images/demo-2.png`  
`/public/images/demo-3.png`

---

## 📎 Cara Menjalankan

```bash
git clone https://github.com/pearlgw/hotel_app_project.git
cd hotel_app_project
cp .env.example .env
composer install
php artisan key:generate

# Jalankan docker untuk Minio & MySQL
docker compose up -d

# Jalankan Laravel
php artisan migrate
php artisan serve
