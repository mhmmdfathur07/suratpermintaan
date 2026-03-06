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

    // field baru
    'status',
    'role',
    'user_id',
    'keterangan'
]; //
}
