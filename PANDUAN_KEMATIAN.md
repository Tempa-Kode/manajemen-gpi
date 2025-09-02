# Panduan Penggunaan Fitur Status Kematian

## Cara Menggunakan Fitu### 6##### 7. Tips Penggunaan
- Pastikan data orang tua sudah diisi sebelum mengelola status
- Double-check tanggal sebelum menyimpan
- Gunakan fitur reset jika ada kesalahan input
- **Lokasi Aksi:**
  - **Orang Tua**: Sidebar kanan di halaman detail jemaat
  - **Sekolah Minggu**: Halaman detail anak sekolah minggu (klik Detail dari halaman jemaat)
  - **Remaja**: Halaman detail remaja (klik Detail dari halaman jemaat)Tips Penggunaan Fitur Keamanan

### 1. Akses Halaman Detail Jemaat
- Login sebagai admin
- Navigasi ke menu "Data Jemaat"
- Klik "Detail" pada keluarga yang ingin dikelola

### 2. Mengelola Status Orang Tua

#### Menandai Ayah/Ibu Meninggal:
1. Scroll ke section "Status Orang Tua" di sidebar kanan
2. Klik tombol "Tandai Meninggal" pada ayah atau ibu
3. Akan muncul modal input tanggal
4. Pilih tanggal kematian (tidak boleh masa depan)
5. Klik "Simpan"
6. Status akan berubah menjadi "Meninggal" dengan badge merah

#### Mengubah Status ke Hidup:
1. Jika status sudah "Meninggal", akan muncul tombol "Ubah ke Hidup"
2. Klik tombol tersebut
3. Status akan kembali ke "Hidup" dengan badge hijau

### 3. Mengelola Status Anak Sekolah Minggu

#### Akses Halaman Detail Sekolah Minggu:
1. Dari halaman detail jemaat, klik "Detail" pada anak sekolah minggu
2. Atau navigasi ke menu "Sekolah Minggu" dan pilih anak

#### Menandai Meninggal:
1. Di halaman detail anak sekolah minggu
2. Klik tombol "Tandai Meninggal" (warna kuning)
3. Input tanggal meninggal di modal
4. Klik "Ya, Tandai Meninggal"
5. Status berubah menjadi "Meninggal" dengan badge merah

#### Mengubah Status ke Hidup:
1. Klik tombol "Ubah Jadi Hidup" (warna hijau)
2. Konfirmasi di modal
3. Status kembali normal

### 5. Visual Indikator

#### Akses Halaman Detail Remaja:
1. Dari halaman detail jemaat, klik "Detail" pada remaja
2. Atau navigasi ke menu "Remaja" dan pilih remaja

#### Menandai Meninggal:
1. Di halaman detail remaja
2. Klik tombol "Tandai Meninggal" (warna kuning)
3. Input tanggal meninggal di modal
4. Klik "Ya, Tandai Meninggal"
5. Status berubah menjadi "Meninggal" dengan badge merah

#### Mengubah Status ke Hidup:
1. Klik tombol "Ubah Jadi Hidup" (warna hijau)
2. Konfirmasi di modal
3. Status kembali normal

#### Badge Status:
- 🟢 **Hijau (Success)**: Status "Hidup"
- 🔴 **Merah (Danger)**: Status "Meninggal"

#### Informasi Tambahan:
- Tanggal kematian ditampilkan di bawah badge untuk yang sudah meninggal
- Format tanggal: DD Month YYYY (contoh: 15 Januari 2024)
- Di halaman detail jemaat, anak yang meninggal ditandai badge merah
- Tombol detail berubah warna (merah untuk yang meninggal)

### 4. Fitur Keamanan
- Semua aksi memerlukan login sebagai admin
- Validasi CSRF untuk keamanan form
- Validasi tanggal untuk mencegah input invalid

### 5. Tips Penggunaan
- Pastikan data orang tua sudah diisi sebelum mengelola status
- Double-check tanggal sebelum menyimpan
- Gunakan fitur reset jika ada kesalahan input
- Fitur ini juga tersedia untuk anak sekolah minggu dan remaja

## Contoh Skenario

### Skenario 1: Ayah Meninggal
```
Status Awal: Ayah (Budi Santoso) - Status: Hidup
Aksi: Klik "Tandai Meninggal" → Input tanggal: 2024-01-15
Hasil: Ayah (Budi Santoso) - Status: Meninggal
       Meninggal: 15 Januari 2024
```

### Skenario 2: Koreksi Data
```
Status: Ibu (Siti Aminah) - Status: Meninggal
Aksi: Klik "Ubah ke Hidup" (jika input salah)
Hasil: Ibu (Siti Aminah) - Status: Hidup
```

## Troubleshooting

### Tombol Tidak Muncul
- Pastikan data ayah/ibu sudah diisi di form edit jemaat
- Refresh halaman jika diperlukan

### Error Saat Menyimpan
- Pastikan tanggal yang diinput valid
- Pastikan tidak memilih tanggal masa depan
- Cek koneksi internet

### Status Tidak Berubah
- Pastikan form ter-submit dengan benar
- Cek apakah ada pesan error di halaman
- Refresh halaman untuk melihat perubahan

## FAQ

**Q: Apakah data yang sudah dihapus bisa dikembalikan?**
A: Ya, gunakan tombol "Ubah ke Hidup" untuk mengembalikan status.

**Q: Bisakah mengubah tanggal kematian yang sudah disimpan?**
A: Saat ini perlu reset dulu ke "Hidup", lalu tandai lagi dengan tanggal yang benar.

**Q: Apakah fitur ini mempengaruhi laporan?**
A: Ya, status kematian akan mempengaruhi perhitungan anggota aktif di laporan.

**Q: Bisakah non-admin menggunakan fitur ini?**
A: Tidak, fitur ini hanya tersedia untuk admin untuk menjaga keamanan data.
