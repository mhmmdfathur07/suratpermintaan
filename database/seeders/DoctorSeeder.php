<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = [
            ['nama_dokter' => 'dr. Budi Santoso, Sp.PD', 'spesialisasi' => 'Penyakit Dalam', 'no_sip' => '503/SIP/2024/001', 'no_telepon' => '08111234567', 'is_active' => true],
            ['nama_dokter' => 'dr. Siti Rahayu, Sp.A', 'spesialisasi' => 'Anak', 'no_sip' => '503/SIP/2024/002', 'no_telepon' => '08122345678', 'is_active' => true],
            ['nama_dokter' => 'dr. Ahmad Fauzi, Sp.B', 'spesialisasi' => 'Bedah Umum', 'no_sip' => '503/SIP/2024/003', 'no_telepon' => '08133456789', 'is_active' => true],
            ['nama_dokter' => 'dr. Dewi Kusuma, Sp.OG', 'spesialisasi' => 'Obstetri & Ginekologi', 'no_sip' => '503/SIP/2024/004', 'no_telepon' => '08144567890', 'is_active' => true],
            ['nama_dokter' => 'dr. Hendra Wijaya, Sp.JP', 'spesialisasi' => 'Jantung & Pembuluh Darah', 'no_sip' => '503/SIP/2024/005', 'no_telepon' => '08155678901', 'is_active' => true],
        ];

        foreach ($doctors as $doctor) {
            Doctor::firstOrCreate(['nama_dokter' => $doctor['nama_dokter']], $doctor);
        }
    }
}
