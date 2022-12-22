# Belajar Laravel 9 Dasar (Beginner)

Dari playlist 'Tutorial LARAVEL 9 Dasar Untuk Pemula' oleh 'cara fajar'

[Documentation Laravel 9](https://laravel.com/docs/9.x)

## Branch Content

### Master

-   Latest code

### Basic Route

-   Cara Instal Laravel atau create project laravel = `composer create-project laravel/laravel example-app`
-   Run project = `php artisan serve`
-   Jika kita pull atau clone dari github, kita harus download dulu package vendor nya dengan `composer install`. Ini kyk kalo kita pakai node itu npm install buat download node_module nya
-   selanjutnya kita bikin file '.env' agar bisa running configuration nya
-   Basic Routing untuk web, ada di /routes/web.php

### Blade Templates

-   Basic menggunakan Blade template directive nya seperti if statement, switch, looping <br>
    Hasil translate blade ada di dalam /storage/framework/views/
-   Basic membuat layout templating dgn blade, ada di /resources/views/

### ENV & Database Migration

-   File .env digunakan sebagai source config bagi kita, dan di dalamnya dpt berisi hal yg sensitive. Jadi di gitignore dan bila kita mau pull ya harus kita bikin dulu file nya. Ini [Link contoh file .env](https://github.com/laravel/laravel/blob/master/.env.example). Data yg ada di .env akan di retrieve oleh file yang bersangkutan di dalam folder /config/
-   Database Migrate adalah semacam version control untuk database seperti git.
-   Cara migrate database. Bikin database dulu, terus ketik cli `php artisan migrate` untuk bikin semua table yang dah disiapin. Cli ini juga dipakai setiap abis bikin atau update table baru, agar dibuatkan ke database nya.
-   Cara bikin table `php artisan make:migration create_students_table`. Agar di generate otomatis, ikutin suffix nya create_namatable_table. Nama table sebaiknya plural.
-   Method `up()` untuk run migration dan `down()` untuk rollback migration.
-   Setiap kali migrate akan tercatat di database dalam bentuk nomor batch migrate nya
-   Untuk Tambah column, di cli nya kita kasih nama sejelas" nya misal `php artisan make:migration add_gender_column_to_students_table`. Suffix agar ke detect table mana yg mau diubah dengan kasih namatable_table di akhir.
-   Cara rollback. `php artisan migrate:rollback` ini bakal rollback satu batch. Rollback ke batch tertentu `php artisan migrate:rollback --step=2`. Sama dengan 2 brarti semua akan ke rollback sampe termasuk batch 2. Nanti pas di migrate lagi akan jadi satu batch.
-   Untuk Update column kita perlu install `composer require doctrine/dbal` terlebih dahulu. cli nya sama seperti kita nambah kolom krn jatuhnya update table juga.
