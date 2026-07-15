# VernonEdu

**VernonEdu** adalah sebuah "Sistem Informasi Pendaftaran dan Penjadwalan Kelas Online" berbasis web yang dirancang khusus untuk mentransformasi dan mendigitalisasi proses administrasi lembaga pendidikan nonformal. Dibangun menggunakan arsitektur teknologi modern (**Laravel 12, React, Vite, dan TailwindCSS**), sistem ini hadir sebagai solusi strategis untuk menggantikan metode pengelolaan manual yang selama ini membatasi skalabilitas lembaga.

## Latar Belakang dan Permasalahan
Di era transformasi digital yang semakin pesat, integrasi teknologi informasi menjadi pilar utama dalam meningkatkan efisiensi operasional lembaga pendidikan. Namun, proses pendaftaran dan penjadwalan kelas pada awalnya masih dikelola secara manual menggunakan *WhatsApp* dan *spreadsheet*. Menurut Connolly & Begg (2021), pengelolaan data tanpa dukungan Sistem Manajemen Basis Data (DBMS) yang terstruktur dapat memicu inkonsistensi data, memperlambat pemrosesan, serta menghambat efektivitas pengambilan keputusan. Metode manual ini sangat tidak *scalable*, rawan kesalahan (*human error*), dan memiliki keterbatasan besar terkait keamanan data saat jumlah peserta bertambah.

## Solusi Strategis & User Experience (UX)
Untuk mengatasi masalah tersebut, VernonEdu melakukan migrasi penuh ke sistem berbasis web yang tersentralisasi dengan DBMS. Hal ini sejalan dengan pandangan Satzinger dkk. (2021) bahwa sistem informasi yang tepat guna tidak hanya berfungsi sebagai alat penyimpanan, tetapi juga mengotomatisasi proses bisnis yang kompleks.

Berdasarkan penelitian Pratama dkk. (2023), platform pendaftaran yang responsif dapat **meningkatkan konversi pendaftar hingga dua kali lipat** karena kemudahan akses yang ditawarkan. Oleh karena itu, VernonEdu sangat mengutamakan kenyamanan *User Experience (UX)* dengan memberikan transparansi informasi secara *real-time* kepada calon peserta—seperti melihat ketersediaan program, jadwal, dan detail harga—melalui antarmuka yang modern dan interaktif.

## Optimalisasi Teknologi
Urgensi pengembangan sistem berbasis web ini sejalan dengan temuan Saputra & Dahlan (2024) mengenai implementasi *framework* modern. Dengan memanfaatkan ekosistem Laravel dan React, sistem ini:
* **Mengoptimalkan Performa & Keamanan:** Menjamin pertukaran data yang aman, konsisten, dan handal (terutama untuk transaksi).
* **Terintegrasi Penuh:** Dilengkapi integrasi Payment Gateway otomatis via Midtrans dan notifikasi email untuk mengeliminasi konfirmasi manual.

Melalui sistem informasi ini, proses administrasi VernonEdu bertransformasi menjadi jauh lebih profesional, efisien, terintegrasi, dan siap mendukung pertumbuhan serta skalabilitas lembaga di masa depan.

---

# Requirements

Pastikan software berikut sudah terinstall di komputer:

* PHP **8.2+**
* Composer
* Node.js **18+**
* npm
* MySQL / MariaDB
* Web server (Apache)
* Docker

---

# Cara Menjalankan dengan Docker

Proyek ini sudah dikonfigurasi penuh dengan Docker untuk memudahkan proses *development* dan demonstrasi aplikasi. Anda tidak perlu menginstal PHP, Node.js, atau MySQL secara manual di komputer Anda, cukup pastikan **Docker Desktop** sudah terinstal dan berjalan.

1. Buka terminal (Command Prompt / PowerShell / Terminal).
2. Arahkan direktori terminal ke folder proyek ini.
3. Jalankan perintah berikut:
   ```bash
   docker compose up
   ```
   *(Gunakan perintah `docker compose up -d` jika ingin menjalankan container di background)*
4. Tunggu hingga proses *build* dan persiapan selesai. Docker akan otomatis men-download image, menjalankan `composer install`, `npm install`, dan migrasi database.
5. Setelah selesai, aplikasi dapat diakses melalui browser:
   - **Aplikasi Utama:** [http://localhost:8000](http://localhost:8000)
   - **Mailpit (Testing Email):** [http://localhost:8025](http://localhost:8025)

---

# Fitur Utama:

**Berikut panduan penggunaan aplikasi:**

1. Registrasi dan login pengguna.
2. Login ke Dashboard Admin.
3. Pemilihan program kelas dan jadwal pembelajaran online.
4. Pembayaran melalui Midtrans Payment Gateway.
5. Pengelolaan database menggunakan Laravel Eloquent ORM.
6. Notifikasi melalui email.
7. Dashboard peserta.


---

# Panduan Penggunaan Web:

## 1. Alur User

### 1.1 Halaman Beranda (Home)
Halaman Beranda merupakan halaman pertama yang ditampilkan ketika pengguna membuka website VernonEdu. Pada halaman ini tersedia informasi mengenai profil VernonEdu, daftar program pembelajaran, keunggulan layanan, testimoni peserta, serta menu Login dan Registrasi. Halaman ini bertujuan memberikan gambaran awal mengenai layanan yang tersedia sehingga calon peserta dapat mengenal sistem sebelum membuat akun.

### 1.2 Halaman Registrasi
Menu Registrasi digunakan oleh calon peserta untuk membuat akun baru agar dapat menggunakan seluruh layanan yang tersedia pada sistem. Pengguna diwajibkan mengisi data diri seperti nama lengkap, alamat email, nomor telepon, password, serta konfirmasi password. Setelah seluruh data diisi dengan benar, sistem akan menyimpan data pengguna dan mengirimkan permintaan registrasi.

* **Halaman Registrasi Gagal:** Apabila data yang dimasukkan tidak memenuhi validasi sistem, seperti email telah digunakan, password tidak sesuai konfirmasi, atau terdapat data yang belum diisi, maka sistem akan menampilkan pesan kesalahan sebagai informasi kepada pengguna agar melakukan perbaikan sebelum proses registrasi dilanjutkan.
* **Halaman Registrasi Berhasil:** Halaman ini ditampilkan setelah pengguna berhasil melakukan proses registrasi akun. Sistem akan menampilkan pesan bahwa registrasi telah berhasil dilakukan dan akun masih menunggu proses validasi oleh admin. Selama akun belum diverifikasi, pengguna belum dapat melakukan login.
* **Email Aktivasi Akun:** Setelah proses registrasi berhasil dan akun telah dikonfirmasi oleh admin, sistem akan mengirimkan email kepada peserta sebagai pemberitahuan bahwa akun telah aktif sehingga pengguna dapat melakukan login.

### 1.3 Halaman Login
Halaman Login digunakan oleh peserta yang telah memiliki akun aktif. Pengguna cukup memasukkan alamat email beserta kata sandi yang telah didaftarkan sebelumnya.

* **Halaman Login Gagal:** Jika email atau password yang dimasukkan tidak sesuai, maka akan muncul pesan kesalahan sehingga pengguna dapat mencoba kembali menggunakan data yang benar.
* **Halaman Login Berhasil:** Sistem memverifikasi email dan password, lalu mengarahkan pengguna ke Dashboard User sebagai halaman utama untuk menggunakan seluruh fitur VernonEdu.

### 1.4 Halaman Program Kelas
Setelah berhasil login, peserta dapat melihat daftar seluruh program pembelajaran yang tersedia. Setiap program menampilkan informasi seperti nama kelas, kategori, harga, jadwal, dan status pendaftaran. Peserta dapat memilih salah satu program untuk melihat informasi secara lebih rinci.

* **Halaman Detail Program:** Menampilkan informasi lengkap mengenai kelas yang dipilih, meliputi deskripsi kelas, materi pembelajaran, biaya pendaftaran, serta tombol untuk melakukan pendaftaran sehingga peserta dapat mempertimbangkan program yang dipilih sebelum melakukan pembayaran.

### 1.5 Dashboard User
Dashboard User merupakan halaman utama setelah peserta berhasil masuk ke dalam sistem. Halaman ini menampilkan ringkasan informasi akun, jumlah kelas yang diikuti, serta menu navigasi menuju berbagai fitur seperti *My Course*, *Calendar*, *Certificate*, *Announcement*, *Notifications*, dan *Profile* sehingga peserta dapat mengakses seluruh layanan dengan lebih mudah.

### 1.6 Halaman Pembayaran
Setelah memilih program kelas, peserta akan diarahkan menuju halaman pembayaran. Sistem menampilkan rincian transaksi beserta tombol pembayaran yang telah terintegrasi dengan Midtrans Payment Gateway. Peserta dapat memilih metode pembayaran yang tersedia, seperti transfer bank maupun dompet digital.

* **Halaman Midtrans Simulator:** Selanjutnya sistem akan mengarahkan peserta menuju halaman Midtrans Simulator untuk menyelesaikan proses pembayaran selama tahap pengembangan aplikasi.
* **Status Pembayaran Berhasil:** Apabila transaksi berhasil dilakukan, status pembayaran akan diperbarui menjadi berhasil dan peserta akan memperoleh informasi bahwa pembayaran sedang menunggu proses verifikasi oleh admin.
* **Email Konfirmasi Pembayaran:** Setelah admin melakukan verifikasi pembayaran, sistem akan mengirimkan email konfirmasi kepada peserta sebagai tanda bahwa pembayaran telah diterima dan peserta resmi terdaftar pada kelas.
* **Notifikasi Jadwal Kelas:** Selain melalui email, peserta juga memperoleh notifikasi di dalam sistem mengenai jadwal pelaksanaan kelas.

### 1.7 Halaman Kelas Saya
Menu Kelas Saya menampilkan seluruh kelas yang telah berhasil diikuti peserta setelah pembayaran diverifikasi. Halaman ini berisi daftar kelas beserta status pembelajaran masing-masing.

* **Halaman Detail Kelas:** Ketika salah satu kelas dipilih, sistem akan menampilkan halaman Detail Kelas yang berisi informasi materi pembelajaran, tugas, progress penyelesaian kelas, dan informasi instruktur.

### 1.8 Halaman Materi dan Tugas
* **Halaman Materi:** Digunakan untuk mempelajari seluruh materi yang telah disediakan oleh instruktur sesuai program yang diikuti.
* **Halaman Pengumpulan Tugas:** Setelah mempelajari materi, peserta dapat mengunggah tugas. Jika proses unggah berhasil dilakukan, sistem akan memberikan pemberitahuan bahwa tugas telah berhasil dikirim dan sedang menunggu proses pemeriksaan.

### 1.9 Halaman Sertifikat
* **Sertifikat Belum Tersedia:** Apabila peserta belum menyelesaikan seluruh materi maupun tugas, sertifikat belum dapat diterbitkan sehingga sistem akan memberikan informasi bahwa persyaratan belum terpenuhi.
* **Sertifikat Tersedia:** Setelah seluruh materi selesai dipelajari dan tugas telah dikonfirmasi oleh admin, peserta berhak memperoleh sertifikat digital. Sertifikat tersebut dapat dilihat maupun diunduh melalui menu Certificate.
* **Email Sertifikat:** Sistem juga akan mengirimkan email sebagai pemberitahuan bahwa sertifikat telah tersedia.

### 1.10 Halaman Kalender
Halaman Kalender menampilkan jadwal seluruh kelas yang sedang diikuti peserta dalam bentuk kalender. Informasi yang ditampilkan meliputi tanggal pelaksanaan, waktu pembelajaran, dan nama kelas sehingga peserta dapat mengetahui jadwal belajar dengan lebih mudah.

### 1.11 Halaman Pengumuman
Halaman Pengumuman digunakan untuk menyampaikan berbagai informasi resmi dari admin kepada seluruh peserta. Informasi tersebut dapat berupa perubahan jadwal, kegiatan, maupun pemberitahuan penting lainnya yang berkaitan dengan proses pembelajaran.

### 1.12 Halaman Notifikasi
Menu Notifikasi berfungsi untuk menampilkan berbagai informasi penting yang berkaitan dengan aktivitas peserta, seperti verifikasi pembayaran, jadwal kelas, hasil pemeriksaan tugas, maupun penerbitan sertifikat. Seluruh riwayat notifikasi juga dapat dilihat kembali melalui halaman ini.

### 1.13 Halaman Profil
Halaman Profil digunakan untuk menampilkan informasi akun peserta. Pengguna dapat memperbarui data pribadi maupun mengganti kata sandi agar keamanan akun tetap terjaga.

### 1.14 Logout
Menu Logout digunakan untuk mengakhiri sesi penggunaan sistem. Setelah proses logout berhasil dilakukan, sistem akan mengarahkan pengguna kembali ke halaman Login.

---

## 2. Alur Admin

### 2.1 Halaman Login Admin
Admin melakukan login menggunakan alamat email dan kata sandi yang telah terdaftar.
* **Halaman Login Gagal:** Apabila data login tidak sesuai, sistem akan menampilkan pesan kesalahan sehingga admin dapat mencoba kembali.
* **Halaman Login Berhasil:** Jika proses autentikasi berhasil, sistem akan mengarahkan admin menuju Dashboard Admin.

### 2.2 Dashboard Admin
Dashboard Admin merupakan pusat pengelolaan seluruh aktivitas sistem. Halaman ini menyajikan informasi mengenai jumlah peserta, jumlah program, data pendaftaran, transaksi pembayaran, serta menu navigasi menuju seluruh fitur administrasi.

### 2.3 Kelola Materi
Melalui halaman Kelola Materi, admin dapat menambahkan, memperbarui, maupun menghapus materi pembelajaran yang digunakan pada setiap program kelas sehingga materi yang diterima peserta selalu sesuai dengan kebutuhan pembelajaran.

### 2.4 Kelola Program
Halaman Kelola Program digunakan untuk mengelola seluruh program pembelajaran yang tersedia pada VernonEdu. Admin dapat menambahkan program baru, mengubah informasi program, melihat detail program, melakukan pencarian data, maupun menghapus program apabila diperlukan.

### 2.5 Kelola Kelas
Halaman Kelola Kelas digunakan untuk mengelola data kelas pada setiap program pembelajaran. Admin dapat menentukan nama kelas, rentang usia peserta, harga, deskripsi, serta memperbarui informasi kelas sehingga data yang ditampilkan kepada peserta selalu sesuai.

### 2.6 Kelola Jadwal
Menu Kelola Jadwal digunakan untuk mengatur jadwal pelaksanaan pembelajaran. Admin dapat menentukan tanggal, waktu, serta informasi pelaksanaan kelas yang nantinya akan ditampilkan pada halaman kalender peserta.

### 2.7 Kelola Instruktur
Melalui halaman Kelola Instruktur, admin dapat menambahkan, memperbarui, melihat detail, melakukan pencarian, maupun menghapus data instruktur. Informasi tersebut akan digunakan sebagai identitas pengajar pada setiap program dan kelas yang tersedia.

### 2.8 Verifikasi Pembayaran
Halaman Verifikasi Pembayaran digunakan untuk memantau seluruh transaksi yang masuk melalui Midtrans Payment Gateway. Setelah pembayaran berhasil diverifikasi, status pendaftaran peserta akan berubah menjadi aktif sehingga peserta dapat mengikuti kelas yang telah dipilih.

### 2.9 Kelola Sertifikat
Halaman Kelola Sertifikat digunakan untuk mengelola sertifikat peserta yang telah menyelesaikan proses pembelajaran. Admin dapat menerbitkan, memperbarui, maupun menghapus sertifikat sesuai kebutuhan. Setelah sertifikat diterbitkan, sistem akan mengirimkan pemberitahuan kepada peserta.

### 2.10 Kelola Pengumuman
Halaman Kelola Pengumuman digunakan untuk membuat dan mempublikasikan informasi kepada seluruh peserta. Pengumuman dapat berupa perubahan jadwal, informasi kegiatan, maupun pemberitahuan penting lainnya yang berkaitan dengan proses pembelajaran.

### 2.11 Kelola Peserta
Menu Kelola Peserta digunakan untuk mengelola seluruh data peserta yang telah terdaftar pada sistem. Admin dapat melihat informasi peserta, melakukan pencarian data, memperbarui informasi, maupun menambahkan data peserta apabila diperlukan.

### 2.12 Validasi Peserta
Halaman Validasi Peserta digunakan untuk memverifikasi akun yang baru melakukan registrasi. Admin dapat menyetujui (*Approve*) atau menolak (*Reject*) permohonan registrasi sesuai hasil pemeriksaan data.
* **Konfirmasi Validasi Peserta:** Sebelum proses validasi dilakukan, sistem akan menampilkan kotak dialog konfirmasi. Jika admin memilih Approve, status akun akan berubah menjadi aktif sehingga peserta dapat login dan menggunakan seluruh fitur yang tersedia. Sebaliknya, apabila memilih Reject, akun tidak akan diaktifkan.

### 2.13 Logout Admin
Menu Logout digunakan untuk mengakhiri sesi penggunaan sistem oleh admin. Setelah logout berhasil dilakukan, sistem akan mengarahkan admin kembali ke halaman Login Admin sehingga proses autentikasi perlu dilakukan kembali.