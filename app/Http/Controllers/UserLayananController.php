<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permintaan;

class UserLayananController extends Controller
{
    // =========================
    // Halaman form user
    // =========================
    public function index()
    {
        return view('layanan.create');
    }

    // =========================
    // Simpan permintaan user
    // =========================
    public function store(Request $request)
    {
        // VALIDASI SESUAI FORM BARU
        $request->validate([
            'layanan' => 'required',
            'nama'    => 'required|string',
            'umur'    => 'required|numeric',
            'kode_rm'   => 'required|string',
            'alamat'  => 'required|string',
        ]);

        // SIMPAN DATA
        Permintaan::create([
            'no_permintaan' => 'REQ-' . time(),
            'layanan'       => $request->layanan,
            'nama'          => $request->nama,
            'umur'          => $request->umur,
            'kode_rm'       => $request->kode_rm, // mapping dari form
            'alamat'        => $request->alamat,
            'tanggal'       => now(), // otomatis dari sistem
            'isi_surat'     => '-', // default kosong, nanti diisi admin
            'status'        => 'pending',
            'role'          => 'user',
            'user_id'       => auth()->id()
        ]);

        return redirect()->back()->with('success','Permintaan berhasil dikirim');
    }

    // =========================
    // USER: LIHAT PROGRES
    // =========================
    public function myRequests()
    {
        $data = Permintaan::where('user_id', auth()->id())
                ->orderBy('created_at','desc')
                ->get();

        return view('layanan.my_requests', compact('data'));
    }

    // =========================
    // USER: DETAIL PERMINTAAN
    // =========================
    public function show($id)
    {
        $data = Permintaan::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();

        return view('layanan.show', compact('data'));
    }

    // =========================
    // USER: DOWNLOAD SURAT
    // =========================
    public function download($id)
    {
        $data = Permintaan::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();

        // hanya bisa download jika status selesai
        if ($data->status !== 'selesai') {
            abort(403, 'Permintaan belum selesai diproses');
        }

        return view('permintaan.cetak', compact('data'));
    }
}