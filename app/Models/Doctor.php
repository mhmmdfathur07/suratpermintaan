<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'nama_dokter',
        'spesialisasi',
        'no_sip',
        'no_telepon',
        'is_active',
    ];
}
