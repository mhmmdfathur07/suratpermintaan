<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Layanan;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layanans = [
            [
                'nama_layanan' => 'Surat Keterangan Rawat Inap',
                'deskripsi' => 'Surat keterangan untuk pasien yang menjalani rawat inap',
                'is_active' => 1
            ],
            [
                'nama_layanan' => 'Surat Keterangan Rawat Jalan',
                'deskripsi' => 'Surat keterangan untuk pasien yang menjalani rawat jalan',
                'is_active' => 1
            ],
            [
                'nama_layanan' => 'Surat Kehilangan Akte Lahir',
                'deskripsi' => 'Surat keterangan kehilangan akte kelahiran',
                'is_active' => 1
            ]
        ];

        foreach ($layanans as $layanan) {
            Layanan::create($layanan);
        }
    }
}
