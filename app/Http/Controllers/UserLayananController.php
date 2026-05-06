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
        $layanans = \App\Models\Layanan::where('is_active', true)
            ->with('biodataFields')
            ->get();

        // Map layanan_id => array of field configs untuk JS
        $biodataMap = $layanans->mapWithKeys(function ($l) {
            return [$l->nama_layanan => $l->biodataFields->map(fn($f) => [
                'label'     => $f->label,
                'field_key' => $f->field_key,
                'suffix'    => $f->suffix,
            ])->values()];
        });

        return view('layanan.create', compact('layanans', 'biodataMap'));
    }

    // =========================
    // Simpan permintaan user
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'layanan'      => 'required',
            'layanan_lain' => 'required_if:layanan,lain-lain|nullable|string',
        ]);

        $namaLayanan = $request->layanan;
        if ($namaLayanan === 'lain-lain' && !empty($request->layanan_lain)) {
            $namaLayanan = trim($request->layanan_lain);
        }

        // Simpan ke tabel layanans jika belum ada
        Layanan::firstOrCreate(
            ['nama_layanan' => $namaLayanan],
            ['deskripsi' => null, 'is_active' => true]
        );

        // Kolom yang boleh diisi user dari biodata fields
        $allowedFields = [
            'nama', 'nama_suami', 'umur', 'kode_rm', 'alamat', 'no_telepon', 'bangsa', 'nm_penerima',
            'tempat_lahir', 'tgl_lahir', 'jenis_kelamin',
            'no_hp', 'nm_petugas_rm', 'nama_peminta', 'email_peminta',
            'no_whatsapp', 'up', 'jumlah_form_asuransi', 'tgl_rencana_kirim',
            'diagnosis', 'poliklinik',
            'tgl_masuk', 'tgl_keluar', 'tgl_periksa', 'tgl_berobat',
            'usia_kehamilan_minggu', 'usia_kehamilan_hari',
            'no_surat_kelahiran', 'jenis_kelamin_bayi', 'tgl_lahir_bayi', 'jam_lahir_bayi',
        ];

        $fillData = [
            'no_permintaan' => 'REQ-' . time(),
            'layanan'       => $namaLayanan,
            'tanggal'       => now(),
            'isi_surat'     => null,
            'nm_petugas_rm' => null,
            'status'        => 'pending',
            'role'          => 'user',
            'user_id'       => auth()->id(),
        ];

        foreach ($allowedFields as $field) {
            if ($request->has($field)) {
                $val = $request->input($field);
                // Simpan nilai apa adanya, termasuk string kosong → null
                $fillData[$field] = ($val !== '' && $val !== null) ? $val : null;
            }
        }

        // nm_penerima khusus — ambil langsung dari request
        $fillData['nm_penerima'] = $request->input('nm_penerima') ?: null;

        Permintaan::create($fillData);

        return redirect()->back()->with('success', 'Permintaan berhasil dikirim');
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

        // Jika ada file upload (PDF), redirect ke file tersebut
        if ($data->file_surat) {
            return redirect(\Storage::disk('public')->url($data->file_surat));
        }

        // Gunakan template dinamis dari konfigurasi layanan
        $layanan = Layanan::with(['biodataFields', 'isiTemplate'])
            ->where('nama_layanan', $data->layanan)
            ->first();

        if (!$layanan || empty($layanan->template_path)) {
            abort(404, 'Template surat tidak ditemukan');
        }

        return view($layanan->template_path, compact('data', 'layanan'));
    }
}