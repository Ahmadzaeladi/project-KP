# Panduan Lengkap Struktur & Alur Kode Proyek PT Pra Kerja Nusantara

Dokumen ini disusun untuk membantu Anda memahami secara menyeluruh bagaimana kode pada website ini bekerja, teknologi apa saja yang digunakan, dan bagaimana antar-file saling berhubungan.

---

## 1. Teknologi & Library yang Digunakan

Website ini dibangun menggunakan perpaduan teknologi **Backend** (Server-side) dan **Frontend** (Client-side).

### Backend (Server)
*   **Framework Utama**: [CodeIgniter 4](https://codeigniter.com/) (CI4) - Framework PHP modern berbasis arsitektur MVC (Model-View-Controller). Memerlukan PHP 8.2+.
*   **Database**: MySQL / MariaDB (Menggunakan Arsitektur 2-Tabel Dinamis).
*   **Library Eksternal (via Composer)**: 
    *   `cloudinary/cloudinary_php` (^2.0): Digunakan untuk mengunggah dan menyimpan gambar (Logo Klien, Foto Tim, Galeri, Hero Image) secara langsung ke cloud server Cloudinary. Mendukung upload dari file browser maupun tangkapan layar langsung dari **Kamera / Webcam (HTML5 API)**.

### Frontend (User Interface)
*   **Framework CSS**: [Bootstrap 5.3](https://getbootstrap.com/) - Digunakan untuk membuat tampilan yang responsif.
*   **Animasi & Ikon**: AOS (Animate On Scroll) & Font Awesome 6.
*   **Font**: Google Fonts (`Poppins`, `Inter`, `Space Mono`).
*   **Javascript Interaksi (CMS)**: JavaScript murni (Vanilla JS) dengan `Fetch API` digunakan di panel admin untuk SPA. Terdapat fitur baru berupa *Live Search Gallery* dan integrasi *HTML5 WebRTC Camera* untuk memotret langsung dari browser.

---

## 2. Struktur Folder Penting

*   📂 **`app/`** (Folder utama logika aplikasi)
    *   📂 **`Controllers/`**: Berisi `Admin.php` dan `Home.php`. Controller ini bertugas mengatur logika penyimpanan dan pemanggilan data dari database.
    *   📂 **`Models/`**: Terdapat 2 Model utama: `ContentModel.php` dan `ImageModel.php`.
    *   📂 **`Views/`**: Berisi `admin/spa_dashboard.php` (CMS Admin) dan `home.php` (Frontend Publik).
*   📂 **`public/`** (Satu-satunya folder yang bisa diakses publik/browser)

---

## 3. Penjelasan Arsitektur Database Baru (2-Tabel)

Untuk mempermudah pemeliharaan (maintenance) dan skalabilitas aplikasi, arsitektur database telah disederhanakan dari yang awalnya menggunakan 6-7 tabel, kini hanya menjadi **2 tabel utama yang dinamis**:

1. **`tbl_content`** (Diakses via `ContentModel`):
   Tabel ini menyimpan seluruh teks pada website. Ia dibedakan menggunakan kolom `section`.
   - `section = 'hero'`: Menyimpan judul utama dan CTA (Call to Action).
   - `section = 'settings'`: Menyimpan pengaturan teks (Tentang Kami, Visi Utama, dll).
   - `section = 'gallery'`: Menyimpan foto-foto kegiatan.
   - `section = 'mission'`: Menyimpan daftar misi strategis.
   - `section = 'team'`: Menyimpan data tim.
   - `section = 'clients'`: Menyimpan logo-logo mitra/klien.

2. **`tbl_images`** (Diakses via `ImageModel`):
   Tabel ini menyimpan *URL gambar* yang dihasilkan dari Cloudinary dan menghubungkannya dengan `tbl_content` melalui Foreign Key `content_id`. Hal ini memungkinkan satu konten memiliki gambar yang terpisah rapi.

---

## 4. Alur Kerja Kode (Flow Aplikasi)

### A. Alur Halaman Depan (Landing Page Publik)
1.  **Pengunjung membuka URL**.
2.  **Controller `Home.php`** mengambil alih, memanggil `ContentModel` dan `ImageModel`.
3.  Controller menggunakan sebuah "Helper Function" untuk menarik konten berdasarkan `section`-nya (misalnya "hero" atau "gallery") lalu melakukan *join* secara logik ke `tbl_images` untuk mendapatkan URL fotonya.
4.  Data (`$data`) yang rapi dikirimkan ke `app/Views/home.php` untuk di-render menjadi HTML.

### B. Alur Halaman Admin (CMS - Single Page Application)
1.  **Akses CMS**: Anda login dan dialihkan ke `/admin`. Semua data ditarik di awal oleh `Admin::index` dan disuntikkan ke dalam file Javascript di `spa_dashboard.php` sebagai variabel `serverData`.
2.  **Upload Kamera & File**:
    - Saat mengklik "Tambah Foto" di Galeri, Anda disajikan opsi mengunggah via File Browser atau **Web Kamera**.
    - Jika memilih Web Kamera, Javascript akan meminta izin menggunakan kamera device, menampilkan stream di `<video>`, dan saat difoto, Javascript akan meng-encode gambar menjadi `Base64`.
    - Gambar (File atau Base64) dikirim ke Controller `Admin.php -> addGallery()`.
3.  **Proses di Backend**:
    - `Admin.php` menerima gambar, membedakan apakah itu objek File standar atau string Base64.
    - Cloudinary mengupload file/string tersebut dan mengembalikan URL.
    - URL gambar disimpan di `tbl_images` dan teksnya di `tbl_content`.
4.  **Pencarian (Live Search)**:
    Di tab Gallery, terdapat kolom pencarian. Saat Anda mengetik, fungsi `filterGallery()` pada Javascript akan langsung menyembunyikan baris tabel yang judulnya tidak sesuai dengan kata kunci secara seketika (tanpa loading).

---

## 5. Ringkasan Fitur Unggulan

1.  **Arsitektur 2-Tabel Terpusat**: Sangat mudah menambahkan *section* baru kedepannya tanpa perlu membuat tabel baru di database.
2.  **Single Page Application (SPA)**: CMS tanpa reload.
3.  **Integrasi Kamera HTML5 (Media Devices API)**: Memungkinkan admin website saat acara berlangsung (misal dari HP atau Laptop) memotret kejadian secara langsung dan langsung ter-upload ke Cloudinary tanpa harus menyimpannya dulu di memori perangkat.
4.  **Live Search Gallery**: Pencarian data super cepat berbasis Client-Side (Vanilla JS).
5.  **Manajemen Urutan (Display Order)**: Kontrol urutan drag-and-drop/input angka untuk tim, galeri, dan klien.

*Jika ada error log, Anda cukup melihat peringatan merah yang tercatat di folder `writable/logs/`.*
