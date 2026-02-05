# PureeFine

PureeFine adalah aplikasi mobile yang berfokus pada **review, eksplorasi, dan pengajuan produk skincare/kosmetik**. Aplikasi ini dirancang dengan UI bernuansa feminin–modern dan alur penggunaan yang sederhana agar pengguna mudah mencari referensi produk sekaligus berkontribusi melalui review dan request produk.

---

## 🎯 Tujuan Aplikasi
- Membantu pengguna **mengklasifikasikan dan menilai kualitas produk** sebelum membeli
- Memberikan gambaran apakah suatu produk **layak digunakan atau tidak** melalui review pengguna lain
- Menjadi media bagi pengguna untuk **mengajukan request produk kepada admin** jika produk belum tersedia

---

## ✨ Fitur Utama

### 1. Autentikasi & Role Pengguna
Aplikasi PureeFine memiliki dua peran utama:
- **User**: dapat mengeksplorasi produk, memberi review, menambahkan favorit, dan melakukan request produk
- **Admin**: bertugas mengelola data produk dan menindaklanjuti request dari user

Fitur autentikasi meliputi:
- **Login** dengan email dan password
- **Registrasi akun (Create Account)**
- Validasi input (email, password, username)

### 2. Eksplorasi Produk (Explore)
- Menampilkan daftar produk skincare
- Informasi produk meliputi:
  - Nama produk
  - Brand
  - Kategori
  - Deskripsi singkat
  - Rating produk
- Navigasi produk berbasis grid

### 3. Detail Produk
- Tampilan detail satu produk secara lengkap
- Informasi meliputi:
  - Foto produk
  - Deskripsi detail
  - Kategori produk
  - Rating dan review pengguna

### 4. Review Produk
- User dapat melakukan **Add Review** pada produk
- Review berisi:
  - Rating (bintang)
  - Komentar/ulasan produk
- Review yang dikirim oleh user **langsung ditampilkan** pada halaman produk
- Review dapat dilihat oleh pengguna lain sebagai bahan pertimbangan sebelum membeli

### 5. Request Produk ke Admin
- Fitur **Request Product** untuk produk yang belum tersedia di sistem
- Pengguna dapat mengajukan permintaan produk langsung kepada **admin**
- Form request berisi:
  - Nama produk
  - Kategori produk
  - Detail/deskripsi produk
- Admin dapat meninjau dan menindaklanjuti request produk
- Tersedia halaman **Detail Product Request**

### 6. Notifikasi
- Notifikasi terkait:
  - Request produk berhasil dikirim
  - Aktivitas tertentu dalam aplikasi
- Tampilan notifikasi sederhana dan informatif

### 7. Favorit Produk
- Menyimpan produk ke halaman **Favorites**
- Memudahkan pengguna mengakses produk yang disukai

### 8. Profil Pengguna
- Halaman **Profile** menampilkan data akun
- Fitur **Edit Profile**:
  - Mengubah username
  - Mengubah email
  - Mengubah password

### 9. Navigasi Bawah (Bottom Navigation)
- Home / Explore
- Favorites
- Add / Request
- Notification
- Profile

---

## 🧩 Karakteristik UI/UX
- Desain mobile-first
- Dominasi warna pink–rose dengan aksen putih
- Ikon minimalis dan konsisten
- Alur user-friendly untuk pemula

---

## 🚀 Potensi Pengembangan Lanjutan
- Sistem klasifikasi produk berdasarkan rating dan review pengguna
- Filter & pencarian produk (brand, kategori, rating, jenis kulit)
- Dashboard admin untuk mengelola produk dan request
- Status request produk (pending, approved, rejected)
- Interaksi lanjutan pada review (like, reply)

---

## 📝 Catatan Revisi

Desain dan fitur PureeFine telah mengalami penyesuaian dari konsep awal. Berikut ringkasan revisinya:

- Pada versi awal:
  - Belum tersedia fitur **notifikasi**
  - User **belum dapat melakukan request produk** ke admin

- Pada versi revisi (versi saat ini):
  - User dapat **melakukan request produk**, namun request tersebut **memerlukan persetujuan (approve) dari admin**
  - User **mendapatkan notifikasi jika product yang di request sudah di approved** tanpa proses persetujuan admin

Dokumen README ini disusun berdasarkan **versi desain yang sudah direvisi (final)** sesuai UI/UX yang dikirim.

