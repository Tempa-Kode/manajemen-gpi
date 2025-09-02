# Fitur Pengelolaan Status Kematian Anggota Jemaat

## Deskripsi

Fitur ini memungkinkan pengelolaan status kematian untuk anggota jemaat, termasuk orang tua (ayah dan ibu), anak sekolah minggu, dan remaja. Status kematian digunakan untuk menentukan keaktifan anggota dalam jemaat.

## Fitur Yang Tersedia

### 1. Status Kematian Orang Tua
- **Tandai Ayah Meninggal**: Menambahkan tanggal meninggal ayah
- **Tandai Ibu Meninggal**: Menambahkan tanggal meninggal ibu
- **Reset Status**: Mengubah status kembali ke "Hidup"
- **Display Status**: Menampilkan status dengan badge berwarna (hijau = hidup, merah = meninggal)

### 2. Status Kematian Anak Sekolah Minggu
- **Tandai Meninggal**: Menambahkan tanggal meninggal anak
- **Reset Status**: Mengubah status kembali ke "Hidup"
- **Auto Status Update**: Status aktif otomatis berubah jika ada tanggal kematian

### 3. Status Kematian Remaja
- **Tandai Meninggal**: Menambahkan tanggal meninggal remaja
- **Reset Status**: Mengubah status kembali ke "Hidup"
- **Auto Status Update**: Status aktif otomatis berubah jika ada tanggal kematian

## Model Changes

### Jemaat Model
```php
// Casting untuk tanggal
protected $casts = [
    'tgl_meninggal_ayah' => 'date',
    'tgl_meninggal_ibu' => 'date',
];

// Accessor untuk status
public function getStatusAyahAttribute()
public function getStatusIbuAttribute()
public function getStatusKeluargaAttribute()

// Scope untuk filtering
public function scopeAyahMeninggal($query)
public function scopeIbuMeninggal($query)
```

### SekolahMinggu Model
```php
// Casting untuk tanggal
protected $casts = [
    'tgl_meninggal' => 'date',
];

// Accessor untuk status
public function getStatusKeaktifanAttribute()

// Scope untuk filtering
public function scopeMeninggal($query)
public function scopeHidup($query)
```

### Remaja Model
```php
// Casting untuk tanggal
protected $casts = [
    'tgl_meninggal' => 'date',
];

// Accessor untuk status
public function getStatusKeaktifanAttribute()

// Scope untuk filtering
public function scopeMeninggal($query)
public function scopeHidup($query)
```

## Controller Methods

### DataJemaatController
- `updateMeninggalAyah()` - Update tanggal meninggal ayah
- `updateMeninggalIbu()` - Update tanggal meninggal ibu
- `resetMeninggalAyah()` - Reset status ayah ke hidup
- `resetMeninggalIbu()` - Reset status ibu ke hidup

### SekolahMingguController
- `updateMeninggal()` - Update tanggal meninggal anak
- `resetMeninggal()` - Reset status ke hidup

### RemajaController
- `updateMeninggal()` - Update tanggal meninggal remaja
- `resetMeninggal()` - Reset status ke hidup

## Routes

```php
// Routes untuk Data Jemaat
Route::put('data-jemaat/meninggal-ayah/{id}', 'updateMeninggalAyah')->name('data-jemaat.meninggal-ayah');
Route::put('data-jemaat/meninggal-ibu/{id}', 'updateMeninggalIbu')->name('data-jemaat.meninggal-ibu');
Route::put('data-jemaat/reset-ayah/{id}', 'resetMeninggalAyah')->name('data-jemaat.reset-ayah');
Route::put('data-jemaat/reset-ibu/{id}', 'resetMeninggalIbu')->name('data-jemaat.reset-ibu');

// Routes untuk Sekolah Minggu
Route::put('sekolah-minggu/meninggal/{id}', 'updateMeninggal')->name('sekolah-minggu.meninggal');
Route::put('sekolah-minggu/reset/{id}', 'resetMeninggal')->name('sekolah-minggu.reset');

// Routes untuk Remaja
Route::put('remaja/meninggal/{id}', 'updateMeninggal')->name('remaja.meninggal');
Route::put('remaja/reset/{id}', 'resetMeninggal')->name('remaja.reset');
```

## UI Components

### Card Status Orang Tua
- Menampilkan status ayah dan ibu dengan badge
- Tombol "Tandai Meninggal" dengan modal input tanggal
- Tombol "Ubah ke Hidup" untuk reset status
- Tampilan tanggal kematian jika sudah meninggal

### Modal Input Tanggal
- Input date dengan validasi (tidak boleh masa depan)
- Form validation untuk memastikan tanggal diisi
- Design yang konsisten dengan theme aplikasi

## Database Schema

### Tabel jemaat
```sql
ALTER TABLE jemaat ADD COLUMN tgl_meninggal_ayah DATE NULL;
ALTER TABLE jemaat ADD COLUMN tgl_meninggal_ibu DATE NULL;
```

### Tabel sekolah_minggu
```sql
ALTER TABLE sekolah_minggu ADD COLUMN tgl_meninggal DATE NULL;
```

### Tabel remaja
```sql
ALTER TABLE remaja ADD COLUMN tgl_meninggal DATE NULL;
```

## Validasi

### Input Validation
- Tanggal meninggal wajib diisi saat submit
- Tanggal tidak boleh di masa depan (max: hari ini)
- Format tanggal harus valid (YYYY-MM-DD)

### Business Logic
- Status otomatis berubah berdasarkan keberadaan tanggal kematian
- Filtering anggota aktif mengecualikan yang sudah meninggal
- Total anggota keluarga tetap menghitung semua anggota

## Contoh Penggunaan

### Menandai Ayah Meninggal
1. Klik tombol "Tandai Meninggal" pada section ayah
2. Isi tanggal kematian di modal
3. Klik "Simpan"
4. Status berubah menjadi "Meninggal" dengan badge merah

### Reset Status ke Hidup
1. Klik tombol "Ubah ke Hidup"
2. Konfirmasi action
3. Status berubah menjadi "Hidup" dengan badge hijau

## Keamanan

- Semua routes dilindungi middleware auth dan admin
- CSRF protection pada semua form
- Validasi input untuk mencegah data invalid
- Method spoofing untuk PUT requests

## Future Enhancements

1. **Laporan Kematian**: Fitur laporan anggota yang meninggal per periode
2. **Notifikasi**: Alert otomatis untuk tanggal kematian yang akan datang (memorial)
3. **Backup Data**: Fitur backup data anggota yang meninggal
4. **Statistik**: Dashboard statistik kematian per tahun/bulan
5. **Sertifikat**: Generate sertifikat kematian otomatis
