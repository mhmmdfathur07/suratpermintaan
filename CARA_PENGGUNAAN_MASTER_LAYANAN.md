# Cara Penggunaan Master Layanan

## 🎯 Fitur Utama
Sistem master layanan memungkinkan admin untuk mengelola jenis-jenis layanan yang tersedia untuk user tanpa perlu mengubah kode program.

---

## 📋 Untuk Admin

### 1. Mengakses Master Layanan
1. Login sebagai admin
2. Di halaman "Data Permintaan Layanan", klik tombol **"Master Layanan"** di header (sebelah nama user)
3. Anda akan diarahkan ke halaman daftar layanan

### 2. Menambah Layanan Baru
1. Di halaman Master Layanan, klik tombol **"Tambah Layanan"**
2. Isi form:
   - **Nama Layanan**: Nama layanan yang akan ditampilkan (contoh: "Surat Keterangan Sakit")
   - **Deskripsi**: Penjelasan singkat tentang layanan (opsional)
   - **Aktif**: Centang jika ingin layanan langsung aktif
3. Klik **"Simpan"**
4. Layanan baru akan muncul di dropdown form user (jika dicentang aktif)

### 3. Mengedit Layanan
1. Di halaman Master Layanan, klik tombol **pensil (kuning)** pada layanan yang ingin diedit
2. Ubah data yang diperlukan
3. Klik **"Update"**

### 4. Menonaktifkan Layanan
1. Klik tombol **pensil** pada layanan
2. Hilangkan centang pada **"Aktif"**
3. Klik **"Update"**
4. Layanan tidak akan muncul di form user, tapi data tetap tersimpan

### 5. Menghapus Layanan
1. Klik tombol **trash (merah)** pada layanan yang ingin dihapus
2. Konfirmasi penghapusan
3. ⚠️ **Perhatian**: Data layanan akan terhapus permanen

---

## 👤 Untuk User

### Mengajukan Permintaan Layanan
1. Login sebagai user
2. Di halaman "Form Pengajuan Layanan"
3. Pada dropdown **"Jenis Layanan"**, akan muncul semua layanan yang statusnya **aktif**
4. Pilih layanan yang diinginkan
5. Isi form lainnya dan klik **"Kirim Pengajuan"**

---

## 🔄 Alur Kerja

```
Admin menambah layanan baru
    ↓
Admin mengaktifkan layanan
    ↓
Layanan muncul di dropdown form user
    ↓
User memilih layanan dan mengajukan permintaan
    ↓
Admin memproses permintaan
```

---

## 📊 Data Layanan Awal

Sistem sudah dilengkapi dengan 3 layanan default:
1. ✅ Surat Keterangan Rawat Inap
2. ✅ Surat Keterangan Rawat Jalan
3. ✅ Surat Kehilangan Akte Lahir

---

## 🛠️ Troubleshooting

### Layanan tidak muncul di form user?
- Pastikan status layanan **"Aktif"** (centang hijau di daftar layanan)
- Refresh halaman form user

### Filter layanan di halaman admin tidak muncul?
- Pastikan sudah ada data layanan di database
- Cek apakah controller sudah mengirim data `$layanans` ke view

### Error saat menghapus layanan?
- Pastikan tidak ada permintaan yang masih menggunakan layanan tersebut
- Jika ada, sebaiknya nonaktifkan saja daripada menghapus

---

## 📝 Catatan Penting

1. **Jangan hapus layanan** yang masih digunakan oleh permintaan yang ada
2. Lebih baik **nonaktifkan** layanan daripada menghapus
3. Nama layanan harus **unik** dan **jelas**
4. Deskripsi membantu admin lain memahami fungsi layanan

---

## ✅ Checklist Implementasi

- [x] Migration tabel layanans
- [x] Model Layanan
- [x] Controller CRUD lengkap
- [x] Routes untuk master layanan
- [x] View index, create, edit
- [x] Integrasi dengan form user
- [x] Filter dinamis di halaman admin
- [x] Seeder data awal
- [x] Link di header admin
- [x] Validasi form
- [x] Status aktif/nonaktif

**Status: SELESAI & SIAP DIGUNAKAN** ✅
