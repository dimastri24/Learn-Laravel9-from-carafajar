# Belajar Laravel 9 Dasar (Beginner)

Dari playlist 'Tutorial LARAVEL 9 Dasar Untuk Pemula' oleh 'cara fajar'

[Documentation Laravel 9](https://laravel.com/docs/9.x)

## Branch Content (include commit)

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
    <br><br>
-   Database Migrate adalah semacam version control untuk database seperti git.
-   Cara migrate database. Bikin database dulu, terus ketik cli `php artisan migrate` untuk bikin semua table yang dah disiapin. Cli ini juga dipakai setiap abis bikin atau update table baru, agar dibuatkan ke database nya.
-   Cara bikin table `php artisan make:migration create_students_table`. Agar di generate otomatis, ikutin suffix nya create_namatable_table. Nama table sebaiknya plural.
-   Method `up()` untuk run migration dan `down()` untuk rollback migration.
-   Setiap kali migrate akan tercatat di database dalam bentuk nomor batch migrate nya
-   Untuk Tambah column, di cli nya kita kasih nama sejelas" nya misal `php artisan make:migration add_gender_column_to_students_table`. Suffix agar ke detect table mana yg mau diubah dengan kasih namatable_table di akhir.
-   Cara rollback. `php artisan migrate:rollback` ini bakal rollback satu batch. Rollback ke batch tertentu `php artisan migrate:rollback --step=2`. Sama dengan 2 brarti semua akan ke rollback sampe termasuk batch 2. Nanti pas di migrate lagi akan jadi satu batch.
-   Untuk Update column kita perlu install `composer require doctrine/dbal` terlebih dahulu. cli nya sama seperti kita nambah kolom krn jatuhnya update table juga.

### MVC

-   Model dan Controller, dalam dokumentasi cek langsung ke bagian `Eloquent ORM/Getting Started` untuk Model dan `The Basics/Controller` utk Controller nya. Disini hanya basic standar bgt agar model nya jalan, lebih lanjutnya di pembahasan selanjutnya kalau ada yang dipakai.
-   Basic bikin model `php artisan make:model Student`.
-   Basic bikin controller `php artisan make:controller StudentController`.
-   View sudah cukup dibahas basic nya pada blade template
-   Bagaimana data di pass dari database hingga ke page.
    <br>Request -> Route -> Controller -> Model -> Database -> Model -> Controller -> View -> Response
    <br> Contoh nya bisa disaksikan langsung tentang Student
-   Query data ada 3 cara, eloquent query (recommend), query builder(ok), row builder(not recommend)

### Database Seeding + Factory (Faker)

-   Disini nyelesain bikin mvc untuk Class. Kemudian kita truncate isi table students sama class.
-   Seeding dilakukan utk load data sample ke database -> table yang kosong. Biasanya saat abis pull atau clone, kita gk punya data database nya. Jadi kita inject mass dulu dgn seeder ini.
-   Bikin seeder `php artisan make:seeder ClassSeeder`.
-   Basic Run seeder `php artisan db:seed --class=ClassSeeder`.
-   Multiple seeding, panggil class seeder yg lain di DatabaseSeeder.php. Abis itu run dengan `php artisan db:seed`. Jangan lupa parent table di atas child table agar di run duluan biar gk error foreign key nya.
    <br><br>
-   Mulai dari sini kemungkinan udh gk nulis manual comman artisan nya, tapi kita pakai extension.
-   Project laravel udh include Faker di --dev, tapi disini aku mau update pake yg versi baru Faker nya jadi ku install ulang.
-   Kita generate Factory nya pake artisan. Abis itu kita bikin rule untuk generate data nya, gk semua harus dari faker, tapi faker dpt membantu ngisi. Setelah itu kita create di Seeder nya.
-   Tambahan, aku ganti timezone jadi ke jakarta, di dalem /config/app.php dan /app/Providers/AppServiceProvider.php

### Query Builder vs Eloquent & Collection Methods

-   Query builder lebih friendly bagi yg php vanilla atau suka pindah" bahasa tapi kuat basic nya karena masih dekat mainan dgn query dan function nya mudah dipahami.
-   Eloquent bentuknya function semua jadi mesti hapalan tapi baiknya bolak balik dokumen. Lebih disarankan jika udh pake framework krn lebih aman dan function nya lebih ringkas.
-   Basic perbandingan ada di /app/Http/Controllers/StudentController.php
-   Kalau basic crud nya sih gk beda jauh ya tapi mungkin kalo dah mass query atau where clause nya ribet atau dah joinan jadi baru kerasa bedanya.
    <br><br>
-   Penjelasannya ada di dokumentasi `/Digging Deeper/Collections/Available Methods`
-   Intinya sih method collection ini bakal ngebantu kita kalo lagi query atau pokoknya ngurus data.
