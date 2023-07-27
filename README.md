# backend-inosoft-test

Pengerjaan test Back-End dari Inosoft oleh Mohammad Nafis Naufally

## Installation

### Pulling Repository

Untuk mendapatkan salinan repository ini kami sarankan dilakukan dengan 2 cara yaitu melalui:
- Pull repository ini pada folder lokal yang kosong dan jalankan command
`` git clone https://github.com/MNafisN/backend-inosoft-test.git ``.
- Download arsip repository ini dan ekstrak ke direktori lokal.

### Requirements

- PHP versi 8.0 atau 8.1,
- Composer,
- MongoDB server,
- MongoDB driver yang kompatibel dengan versi PHP di atas.

### Setting Environment

- Pastikan PHP terinstall dengan cara mengecek versinya dengan menjalankan command `` php -v ``.
- Pastikan Composer terinstall dengan cara mengecek versinya dengan menjalankan command `` composer ``.
- Pastikan server MongoDB terinstall dengan cara mengecek versinya dengan menjalankan command `` mongod --version ``.
- Untuk mengimplementasikan database dari MongoDB, sebuah MongoDB driver perlu didownload dari website [PECL  (php.net)](https://pecl.php.net/package/mongodb). Versi yang didownload menyesuaikan versi PHP dan sistem operasi yang digunakan.
  - Untuk pengguna Windows, copy file .dll yang telah didownload ke dalam folder ext di dalam direktori php yang terinstall.
  - Edit file php.ini dan selipkan satu baris code `` extension = php_mongodb.dll `` pada bagian daftar ekstensi php.
  - Perlu diingat bahwa driver MongoDB ini belum mempunyai versi yang dapat diintegrasikan dengan PHP versi 8.2 ke atas dan hanya kompatible dengan PHP versi 8.1 ke bawah.

### Installing Project

Setting file .env project dengan cara menduplikat file .env.example atau .env.testing kemudian rename file tersebut menjadi .env dan tentukan nama aplikasi, database yang digunakan, dan juga file system untuk menentukan lokasi penyimpanan file.

Daftar command di bawah ini disarankan untuk dijalankan secara berurutan agar aplikasi siap dijalankan maupun dikembangkan lagi.
- `` php artisan key:generate --ansi ``
- `` php artisan route cache ``
- `` composer install ``
- `` php artisan jwt:secret ``
- `` php artisan migrate ``
- `` php artisan db:seed ``

### Running Project

Untuk menjalankan API pada aplikasi tersebut, jalankan command `` php artisan serve ``

## Application Testing

### Unit Testing

Untuk melakukan testing aplikasi menggunakan unit test, disarankan untuk mematikan terlebih dahulu authorization JWT yang sudah dirancang dengan cara mengganti sebuah baris code yang berhubungan dengan middleware `` auth:api ``. Baris code ini terletak pada file:
- routes/api.php `` line 39 & 55 ``
- app/Http/Controllers/KendaraanController.php `` line 21 ``
- app/Http/Controllers/PenjualanController.php `` line 16 ``

### Postman

Testing juga dapat dilakukan melalui daftar request collection dari Postman untuk testing fitur dari aplikasi tersebut. Berikut ini adalah link dokumentasi pada Postman collection di atas:

[API Postman Documentation](https://documenter.getpostman.com/view/26426855/2s946pZpN9).
