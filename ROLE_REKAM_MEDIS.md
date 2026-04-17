# Role Rekam Medis

## Deskripsi
Role "rekam_medis" ditambahkan untuk memberikan akses ke form pengajuan layanan, sama seperti role "user".

## Akses yang Diberikan
- Form pengajuan layanan (`/layanan`)
- Melihat daftar permintaan sendiri (`/user/permintaan`)
- Melihat detail permintaan (`/user/permintaan/{id}`)
- Download surat yang sudah selesai (`/user/permintaan/{id}/download`)

## Cara Membuat User dengan Role Rekam Medis

### Opsi 1: Menggunakan Seeder
```bash
php artisan db:seed --class=RekamMedisUserSeeder
```

Ini akan membuat user dengan kredensial:
- Email: `rekam_medis`
- Password: `rekam_medis123`
- Role: `rekam_medis`

### Opsi 2: Manual via Tinker
```bash
php artisan tinker
```

Kemudian jalankan:
```php
User::create([
    'name' => 'Nama Rekam Medis',
    'email' => 'email@example.com',
    'password' => Hash::make('password_anda'),
    'role' => 'rekam_medis',
]);
```

### Opsi 3: Manual via Database
Insert langsung ke tabel `users`:
```sql
INSERT INTO users (name, email, password, role, created_at, updated_at) 
VALUES (
    'Nama Rekam Medis', 
    'email@example.com', 
    '$2y$12$...', -- hash password menggunakan bcrypt
    'rekam_medis',
    NOW(),
    NOW()
);
```

## Role yang Tersedia di Sistem
1. `admin` - Akses ke dashboard admin untuk mengelola permintaan
2. `user` - Akses ke form pengajuan layanan
3. `rekam_medis` - Akses ke form pengajuan layanan (sama seperti user)

## Catatan
- Role "rekam_medis" dan "user" memiliki akses yang sama ke form pengajuan layanan
- Setelah login, user dengan role "rekam_medis" akan diarahkan ke `/layanan`
