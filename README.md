# ATWD
Aplikasi CodeIgniter untuk memberi data cuacu mengenai sebuah kota dalam periode hari ini sampai dengan 5 hari kedepan.
API yang digunakan : metaweather, google map reverse geocoding

Fitur-fitur yang terdapat pada aplikasi ini:
1. Search berdasarkan teks.
2. Search berdasarkan google map reverse geocoding.
3. Menampilkan cuaca mengenai kota yang bersangkutan.
4. Menampilkan history search.
5. Menyimpan history search.

Untuk menjalankan aplikasi ini dibutuhkan minimal PHP 5.6 dan MySQL.
1. Download repository ini menjadi sebuah .zip.
2. Ekstrak dan pastikan isi repository ini di dalam folder htdocs anda dengan nama folder ATWD. Contoh http://localhost/ATWD/{isi repository}.
3. Anda akan menemukan file sql bernama atwd.sql, jika anda mengikuti step 1 dan 2 maka file tersebut akan ditemukan di path http://localhost/ATWD/atwd.sql.
4. Import file sql tersebut ke MySQL anda dan pastikan bahwa nama database adalah atwd. Apabila anda ingin menggunakan database lain, maka harus dipastikan pada config database CodeIgniter nama database diganti dengan sesuai yang diinginkan.
5. File sql tersebut akan mengenerate sebuah tabel bernama history dengan 3 kolom yaitu id,teks dan datetime. Kolom id merupakan primary key dengan auto increment, teks merupakan sebuah varchar dan datetime merupakan kolom dengan atribut datetime.
6. Dalam file ini akan ditemukan 2 controller, dimana controller tersebut masing-masing akan menangani 2 halaman yang akan disediakan pada aplikasi ini yaitu controller home dan dkota. Controller home akan menangani beberapa action yang diperlukan pada halaman home sedangkan dkota akan menangani action yang diperlukan pada halaman action.
7. Untuk Model, terdapat 1 file yang bernama History dimana model ini akan menangani action insert dan select pada tabel history yang akan digunakan.
8. Untuk view anda dapat melihat di folder views, dimana terdapat 2 view yaitu home dan dkota. Yang perlu diperhatikan pada view ini yaitu untuk menjalankan API Google Map Reverse Geocoding, user diharapkan untuk menggunakan API key masing-masing. Untuk mengganti API key tersebut dapat ditemukan pada baris dimana API tersebut diload.
9. Apabila step 1-8 tidak ada masalah, maka bisa dilanjutkan untuk menjalankan aplikasi yaitu dengan mengakses salah satu file controller. Dipastikan bahwa Apache dan MySQL jalan. Silahkan akses http://localhost/ATWD/index.php/home

Catatan:
Jika ada masalah mengenai penginstallan atau deployment bisa contact ke email dibawah ini:
michaelchandrag114@yahoo.com

Terimakasih sebanyak-banyaknya.
