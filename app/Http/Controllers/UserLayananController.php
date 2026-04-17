<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permintaan;
use App\Models\Layanan;

class UserLayananController extends Controller
{
    // =========================
    // Halaman form user
    // =========================
    public function index()
    {
        $layanans = \App\Models\Layanan::where('is_active', true)->get();
        return view('layanan.create', compact('layanans'));
    }

    // =========================
    // Simpan permintaan user
    // =========================
    public function store(Request $request)
    {
        // VALIDASI SESUAI FORM BARU
        $request->validate([
            'layanan'     => 'required',
            'layanan_lain'=> 'required_if:layanan,lain-lain|nullable|string',
            'nama'        => 'required|string',
            'umur'        => 'required|numeric',
            'kode_rm'     => 'required|string',
            'alamat'      => 'required|string',
            'no_telepon'  => 'nullable|string|max:20',
        ]);

        // Tentukan nama layanan final
        $namaLayanan = $request->layanan;
        if ($namaLayanan === 'lain-lain' && !empty($request->layanan_lain)) {
            $namaLayanan = trim($request->layanan_lain);
        }

        // Simpan ke tabel layanans jika belum ada (berlaku untuk lain-lain maupun layanan baru apapun)
        Layanan::firstOrCreate(
            ['nama_layanan' => $namaLayanan],
            ['deskripsi' => null, 'is_active' => true]
        );

        // SIMPAN DATA
        Permintaan::create([
            'no_permintaan' => 'REQ-' . time(),
            'layanan'       => $namaLayanan,
            'nama'          => $request->nama,
            'umur'          => $request->umur,
            'kode_rm'       => $request->kode_rm,
            'alamat'        => $request->alamat,
            'no_telepon'    => $request->no_telepon,
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
    public function myRequests(Request $request)
    {
        $search       = $request->input('search');
        $layanan      = $request->input('layanan');
        $tglPengajuan = $request->input('tgl_pengajuan');
        $tglDibuat    = $request->input('tgl_dibuat');

        $query = Permintaan::where('user_id', auth()->id());

        if (!empty($search)) {
            $searchLower = strtolower($search);
            $query->where(function ($q) use ($searchLower) {
                $q->whereRaw('LOWER(no_permintaan) LIKE ?', ["%$searchLower%"])
                  ->orWhereRaw('LOWER(kode_rm) LIKE ?', ["%$searchLower%"])
                  ->orWhereRaw('LOWER(nama) LIKE ?', ["%$searchLower%"])
                  ->orWhereRaw('LOWER(layanan) LIKE ?', ["%$searchLower%"])
                  ->orWhereRaw('LOWER(COALESCE(nm_petugas_rm, \'\')) LIKE ?', ["%$searchLower%"]);
            });
        }

        if (!empty($layanan)) {
            $query->where('layanan', $layanan);
        }

        if (!empty($tglPengajuan)) {
            $query->whereDate('tanggal', $tglPengajuan);
        }

        if (!empty($tglDibuat)) {
            $query->whereDate('tgl_dibuat', $tglDibuat);
        }

        $data     = $query->orderBy('created_at', 'desc')->get();
        $layanans = \App\Models\Layanan::where('is_active', true)->orderBy('nama_layanan')->get();

        return view('layanan.my_requests', compact('data', 'layanans'));
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