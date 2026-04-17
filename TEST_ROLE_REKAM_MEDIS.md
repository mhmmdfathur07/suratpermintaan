# Testing Role Rekam Medis

## Langkah-langkah Testing

### 1. Buat User Rekam Medis
```bash
php artisan db:seed --class=RekamMedisUserSeeder
```

### 2. Login dengan Kredensial
- Email: `rekam_medis`
- Password: `rekam_medis123`

### 3. Verifikasi Akses
Setelah login, user harus:
- Diarahkan ke halaman `/layanan` (form pengajuan layanan)
- Dapat mengisi dan submit form pengajuan
- Dapat melihat daftar permintaan di `/user/permintaan`
- Dapat melihat detail permintaan
- Dapat download surat yang sudah selesai

### 4. Testing Manual via Tinker (Opsional)
```bash
php artisan tinker
```

Buat user baru:
```php
$user = User::create([
    'name' => 'Test Rekam Medis',
    'email' => 'test.rekammedis@example.com',
    'password' => Hash::make('test123'),
    'role' => 'rekam_medis',
]);

echo "User created: " . $user->email;
```

Cek user yang ada:
```php
User::where('role', 'rekam_medis')->get();
```

### 5. Verifikasi Redirect
Login dengan user role "rekam_medis" dan pastikan:
- ✅ Redirect ke `/layanan` (bukan `/permintaan`)
- ✅ Tidak ada akses ke dashboard admin
- ✅ Dapat mengakses semua fitur user layanan

## Troubleshooting

### Jika redirect tidak bekerja:
1. Clear cache aplikasi:
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

2. Pastikan session sudah di-regenerate setelah login

### Jika user tidak bisa dibuat:
1. Pastikan migration sudah dijalankan:
```bash
php artisan migrate:status
```

2. Cek apakah kolom `role` ada di tabel `users`:
```bash
php artisan tinker
Schema::hasColumn('users', 'role');
```
