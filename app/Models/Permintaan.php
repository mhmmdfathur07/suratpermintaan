<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
   protected $fillable = [
    'no_permintaan',
    'layanan',
    'nama',
    'umur',
    'alamat',
    'no_telepon',
    'kode_rm',
    'isi_surat',
    'tanggal',
    'nm_penerima',
    'nm_petugas_rm',

    'diagnosis',
    'poliklinik',
    'tgl_periksa',
    'tgl_masuk',
    'tgl_keluar',
    'nama_dokter',
    'nama_persetujuan',

    // field layak terbang
    'tgl_berobat',
    'status_kehamilan',
    'usia_kehamilan_hpht',
    'usia_kehamilan_minggu',
    'usia_kehamilan_hari',
    'kondisi_ibu',

    // field kehilangan akte
    'no_surat_kelahiran',
    'jenis_kelamin_bayi',
    'tgl_lahir_bayi',
    'jam_lahir_bayi',

    // field baru
    'status',
    'role',
    'user_id',
    'keterangan',
    'tgl_dibuat',
    'file_surat',
];

    /**
     * Relasi ke User (pengaju)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
