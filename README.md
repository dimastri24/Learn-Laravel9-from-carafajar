# Belajar Laravel 9 Dasar (Beginner)

Dari playlist _Tutorial LARAVEL 9 Dasar Untuk Pemula_ oleh _cara fajar_

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

### Eloquent Relationship & N+1 Problem (Lazy vs Eager)

-   Pertama yg mesti kita lakuin adalah defining relationship antar table nya
-   Contoh disini relation students dgn class adalah many to one, jadi di model students kita define one to many inverse / `belongsTo()`
-   Sebaliknya class dengan students adalah one to many, jadi kita pake `hasMany()`
-   Yang terjadi dibelakang adalah pemanggilan join table dan secara default adalah lazy. Contoh pertama kita pakai eager. Hal ini dilakukan di controller nya
    <br><br>
-   Dasar perbedaan lazy dan eager adalah cara request data nya. Sebenernya ini berlaku di framework apapun dan konsep nya sama
-   gambaran apa yg terjadi dibelakang

```
lazy load
select * from table class
select * from student where class = 1A
select * from student where class = 1B
select * from student where class = 1C
select * from student where class = 1D
```

```
eager load
select * from table class
select * from student where class in (1A, 1B, 1C, 1D)
```

-   Masing" punya kelebihan dan kekurangan. Kapan penggunaannya tergantung scenario dan kebutuhan. Lebih jelas nya searching lagi aja di gugel, krn bakal panjang kalo di sini dan itu topik berbeda dgn materi laravel.
-   Disini kita install clockwork di project dan browser kita untuk liat performance dan query nya.
    <br><br>
-   Tambahan mengenai clockwork. Secara default dia gk nyala kalo running, tapi dia otomatis nyala kalo running nya mode debug. Bisa dilihat dalem file .env nya gini `APP_DEBUG=true`, jadi kalo nanti deploy jgn lupa di false. Jadi cara agar disable clockwork nya biar gk generate log bisa kita tulis gini `CLOCKWORK_ENABLE=false` di .env, biar clockwork nya aja yg mati tapi tetep running mode debug.

### Many to Many Relationship & Nested Relationship

-   Disini gk byk penjelasan krn cukup jelas hanya cara penerapan relationship di laravel ini
-   Cara nerapin relationship disini itu emang beda, jadi kita nge define relation nya belakangan. Tapi cara gini jadi lebih mudah dipahami karena pendekatan ke database nya. Kita bikin foreign nya manual di dalem migration terus baru kita define bahwa ini punya relation di model nya.
-   Define Many to many dgn `belongsToMany()` di dalem model nya.
    <br><br>
-   Nested relationship, intinya tuh bikin relation gk langsung. Disini contohnya students manggil teachers tapi lewat class krn mereka gk ada relation langsung sedangkan class dan teacher punya.
-   Cara manggil nya di controller kita panggil function dari model yg mau di join. Di StudentController, `with()`kan isinya manggil relation, nah disitu kita panggil `class.homeroomTeacher` yg awalnya cuma `class` (table) jadi ada `homeroomTeacher` function di dalem model Class. Saat kita mau tampilin juga sama yg dipanggil function nya.
-   Kalo dilihat return array nya dia berupa object, jadi sama aja kyk yg biasa kita tahu.

### Halaman Detail

-   Branch ini gk byk teori atau feature dari laravel. Disini kita cuma bikin detail page sama bebenahin page lain.
-   karena kita bikin detail page, jadi kita update bikin mvc baru utk detail page nya.

### CRUD

-   Basic CRUD di laravel dgn eloquent. Mulai dari insert, update, delete, soft delete, flash message dan validation.
-   Pertama insert data student, disini tambahan aku nyoba sendiri add ekskul student nya krn dia many to many menggunakan `attach()`. Konsep basic nya sama aja
    <br><br>
-   Kedua kita update data student, aku juga nyoba update ekskul student nya menggunakan `sync()`. Yg update juga basic nya sama aja
-   insert dan update ada yg mass assignment. Untuk menggunakannya ada syaratnya, name atribute input nya harus sama dgn nama column di table, terus kita juga harus ngasih tau column mana aja yg boleh diisi atau update dgn fillable di Model nya.
    <br><br>
-   Ketiga kita coba implement session flash data nya. Biar bisa nampilin flash message kalo abis melakukan create dan update. Syntax nya ada dua, di dokumen begini `$request->session()->flash()` tapi ada juga yg gini `Session::flash()` seperti yg kita pake.
-   Keempat kita buat form validation, diliat" ini tuh backend validation. Kita bisa validate di controller langsung atau bikin file validasi teripsah caranya `php artisan make:request StorePostRequest` biar lebih detail kustomisasi nya. Munculin message nya kita pake flash message juga, cuma contoh kali ini simple aja pake yg bawaan jadi gk kita tulis di controller cuma tinggal panggil message nya di blade.
    <br><br>
-   Kelima kita delete student, delete ya simple tinggal panggil function `delete()` nya aja. Disini kita ceritanya mau pake konfirmasi gitu tapi krn kita full php, biar gampang kita bikin halaman baru aja.
-   Tambahan aku juga update table pivot student_extracurricular nya untuk column student_id nya jadi onDelete('cascade') agar kalau kita delete student, ekskul student itu juga ikut kehapus
    <br><br>
-   Terakhir kita nerapin soft delete pada students. Hal pertama yang kita lakukan adalah use SoftDeletes di model Student nya. Terus kita migrate table nya bikin column softDeletes, kalau di table hasilnya column deleted_at. Dengan begini kalau kita delete student, di table masih ada student nya dan deleted_at nya keisi timestamp, pada view bisa kita query mau dimunculin atau gk dgn method yg berbau trashed().
-   Cara restore nya gampang, kita cuma butuh id data nya, terus kita query trash ditambah where bkn find biasa abis itu kita `restore()`.
    <br><br>
-   Lalu bagaimana kalau kita beneran mau hapus data nya? Caranya dgn manggil function `forceDelete()` daripada `delete()` biasa. Disini aku dah byk modifikasi kodingan nya dari tutorial nya agar bisa menyusaikan saat mau soft delete dan force delete, sepeti merubah method routing ama controllernya, bentuk link nya jadi form yg nge post hidden data sampe ada multiple button submit.
-   Aku gk nyoba nerapin delete pivot table many to many student ekskul nya dgn method `detach()` karena dgn pakai sync() aja dah cukup untuk handle semua crud nya. Bahkan yg add bisa aku hapus aja krn useless tapi aku biarin dikomen aja.
-   Sampai sini aku gk bikin crud untuk yg lain krn sama aja, jadi aku spend more time pada hal yg beda ato gk dijelasin di playlist seperti handling many to many dan force delete.

### Pagination & Search

-   Untuk menguji data aku seed 2000 data student ke database, biar agak beda ku kasih 4 kelas baru nis mereka jadi 10102####.
-   Pakai paginate disini cukup simple, kita hanya perlu panggil function `paginate()` di query yg kita butuhin terus pass argumen yang kita butuhin. Paginate ada dua pertama yg itu yg kedua `simplePaginate()` sesuai namanya dia return data nya lebih dikit jadi lebih cepat juga. Tapi paginate tetep preferable krn additional data yg di return dah rapih tinggal kita pakai, seperti mulai dari total data yg dibelakang bisa digunakan utk dpt byk halaman dll seperti yg pernah aku pelajari dri playlist php dasar wpu.
-   Tinggal cara nampilin tombol pagination. Karena kita mau terima rapih aja utk saat ini, kita tinggal tulis `Paginator::useBootstrapFive();` di AppServiceProvider.php utk nge styling tombol" page nya. Kalo mau custom sendiri juga bisa bisa di cek langsung ke dokumen, default nya pake tailwind tapi kalo manual css framework lainnya juga bisa.
-   Selanjutnya kita bikin fitur search yg work align dgn pagination nya juga. Bikin search nya sama aja kyk biasanya, panggil `where()` / `orWhere()` isi query nya. Yang beda pas query ke table lain, pertama kita join `with()` dulu terus query nya di dalem `orWhereHas()`. Biar pagination nya tetep work tinggal kita kasih tau di view nya dgn `withQueryString()`, nanti dah otomatis dia ngenalin bahwa kita lagi send paramater lewat link biar di terusin ke page selanjutnya. Ini makanya kita pake GET request bkn POST.

### Upload Image

-   Basic nya berlaku utk segala file gk hanya image aja. Kita bikin column image nya di table students. Jangan lupa fillable di model Student nya kita kasih tau juga. Setelah itu kita ganti `FILESYSTEM_DISK=local`jadi `FILESYSTEM_DISK=public` biar kesimpen didalem storage kita.
-   Abis itu kita tambah input file di form add student kita, jgn lupa enctype nya. Balik ke controller, ke method store() kita pakai function `store()` untuk nyimpen file yg dikirm. Udah gitu aja, laravel udh otomatis generate nama baru. Tapi disini kita mau bikin rule nama sendiri jadi pake nya `storeAs()`.
-   Disini baru tahu walaupun pake mass assignment kita masih bisa beda name attr input nya dgn nama column. Caranya dgn secara explisit bikin key baru didalem $request dgn nama yg sama dgn nama column nya, lalu diisi dgn value yg kita mau seperti di codingan kita.
-   Sekarang cara nampilin nya. Pertama kita harus ketik command ini dulu `php artisan storage:link` gunanya agar isi yg di dalem storage/app/public/_ bisa di aksess dgn meng clone real time ke folder public/storage/_. Tinggal ke view, kita butuh function `asset()` untuk manggil file nya. Basic nya udh sampe sini.
-   Tambahan nya disini aku nyoba update file image nya. Tapi yg kita mau file yg udh di upload itu dihapus. Awalnya sama kita cek dulu ada file baru nya atau gk. Terus di dalem kita cek pernah upload foto gk yg disimpen di database. Terakhir kita cek foto lamanya beneran ada gk di storage kita. Abis itu baru kita hapus pake `Storage::delete()`. Ada cara lain yg semacam vanila php nya dgn `unlink()`, krn kalo pake Storage itu class milik laravel. Udah gitu cara delete nya. Sisanya sama tinggal kita upload yg baru.
-   Di stack overflow ada yg bilang utk upload dulu yg baru, terus baru kita hapus yg lama.
-   Selain itu selama uji coba terus aku menemukan tentang masalah file path nya. Kalo yg serba laravel way itu pasti urusan nya langsung ke folder storage jadi path nya langsung aja kita arahin ke dalem storage. Misal directory kita gini storage/app/public/photo , path kita cuma jadi photo/ aja udah beres. Makanya ini work saat kita nge storeAs() dan Storage::delete() nya. Sebaliknya, yg butuh akses langsung seperti saat nampilin di view, itu yg di akses folder public bkn storage. Directory kita public/storage/photo/ path kita jadi storage/photo/ . Nah path ini work juga saat dipake di unlink().

### Authentication and Authorization (Login, Logout, Middleware)

-   Commit pertama tentang authentication yg berarti kira bikin login dan sedikit nyinggung middleware.
-   Kita bikin table roles dulu, terus add foreign key role_id di table users. Bikin role nya terakhir bikin user admin nya. Abis itu kita bikin route nya.
-   Untuk basic middleware, ada file yg bisa kita lihat utk dipelajari, mulai dari app/Http/Kernel.php dari situ kita bisa lihat ada byk routing nya. Untuk authenticate user login kita pakai yg `auth` dimana dia lari ke Authenticate.php dimana dia akan return ke view after login nya. Penggunaan middleware nya ada di web.php kita. Route kedua kita pakai `guest` untuk yg udh login biar gk login lagi, nanti lari ke RedirectIfAuthenticated.php terus ke RouteServiceProvider.php disitu kita edit const HOME nya jadi '/' krn route home kita itu.
-   Abis itu bikin halaman sama form login nya. Isinya gk macem" kyk form login biasanya. Ini juga krn kita bikin maual gk pake template, bikin controller sendiri juga. laravel punya yg namanya stater kit buat mempermudah bikin gini"an nya form nya authentication nya dll.
-   Selanjutnya bikin controller authenticate() nya disana bakal ngerjain semuanya ama laravel sendiri di balik layar, kita cuma tinggal function `Auth::attempt()`sama bikin `session()` nya beres. Ini berlaku selama kita pakai table users yg dah dibikinin ya.
-   Cek jika beneran bisa login apa gk. Akses langsung ke halaman bakal mental ke login, isi asal"an bakal di reject. Masuk pake user admin baru di acc dan bisa landing ke dalem. Print user sapa yg lagi login bisa.
-   Sekarang bikin logout. Simple aja bikin link logout, route logout, sama controller logout nya. Di dalem method nya tinggal panggil `Auth::logout` sama invalidate session selesai.
    <br><br>
-   Waktunya buat fitur batas akses user sesuai role masing". Hal utama yg kita butuhkan adalah bikin Middleware `php artisan make:middleware MustAdmin`. Pada titik ini kita gk bikin full crud utk yg lain tapi cuma student doang, maka dari itu middleware yg kita bikin hanya dua, MustAdmin dan MustAdminOrTeacher krn mereka yg punya akses ke student. Abis bikin middleware, jgn lupa di register ke Kernel agar bisa dipakai.
-   Logic rule nya akan di dalem middleware yg kita bikin, bisa apa aja sesuai yg kita mau. Disini simple aja kita mau filter user yg bisa akses dgn role tertentu yg gk bakal kita abort aja.
-   Terakhir tinggal kita hide tampilan yg gk dibutuhin oleh user nya.

## Note

-   Yeay playlist belajar laravel 9 dasar selesai 👏👏👏
-   Gk nyangka bikin note pembelajaran sebanyak ini. Dipikir pikir knp waktu itu pas belajar React gk dibikin gini aja ketimbang naro catatan didalem coding nya langsung. Waktu itu blm bljr Git sih ya wajar tapi ywdhlah terlanjur hehe.
-   Users :
    -   admin | admin@email.com | rahasia
    -   teacher | teacher@email.com | rahasia
    -   student | student@email.com | rahasia
-   Disini emang gk akan di terapin kesemua seperti yg kubilang sebelumnya, tapi setidaknya paham akan cara penggunaanya. Kalo lebih explore lagi bisa nyoba sendiri di project berbeda atau bisa aja aku kerjain disini juga 'mungkin'.

<br/>

# Trips, Trick & Fitur Laravel

Lanjutan ke playlist yg _Tips, Trick & Fitur Laravel_. Repo ini akan tetap dipakai untuk sebagian dari tutorialnya, karena kalo diliat, ada yang bakal diterapin ke palylist API atau bikin project baru.
Maka Dari itu, aku gk bakal bikin branch setiap video melainkan hanya commit biasa aja, jadi kalo butuh sesuatu langsung checkout pake id commit nya.

## Commit content

### Branch Master

-   Master akan selalu jadi hasil commit paling baru

### Blade Component

-   Documentasi nya ada di The Basics -> Blade Templates -> Components
-   Sebelumnya kita bikin template layout, skrg kita bikin template component utk component yg lebih kecil
-   Pertama harus bikin component nya dulu pake artiasn `php artisan make:component Alert` , nanti dibikinin dua file, view sama class.
-   Basic nya kyk pake React, bikin component kecil yg reusable utk dipanggil di halaman lain. Bisa passing attributes yg isinya dynamic data itu sendiri.
-   Passing data nya lewat class yg dibikinin tadi. Define atau initialize variable utk nampung data yg di passing terus panggil di constructor nya.
-   Ngoper data di component dan tempat manggilin nya tinggal liat di code nya atau di dokument.
-   lupa nambahin, disini cuma implement dikin aja component alert nya utk yg success kalo add, edit, delete student

### Slug & Pretty URl

-   Slug ini digunakan utk merubah sebuah string biasanya digunakan utk merubah url.
-   Biar enak kita bikin column baru slug di table students, terus kita mau mass update biar gk null. codinganya ku tinggalin commented disana.
-   Data slug yg kita simpen ngambil dari nama terus seperator nya pake underscore `Str::slug($request->name, '_');`
-   Gunainnya tinggal yang awalnya pake id ganti pake slug di url dan controller nya
-   Disini aku coba implement di student detail, view edit, view delete, restore students
