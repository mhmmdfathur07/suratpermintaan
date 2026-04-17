<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use Illuminate\Http\Request;

class PermintaanController extends Controller
{
    // =========================
    // INDEX
    // =========================
    public function index(Request $request)
    {
        $search    = $request->input('search');
        $layanan   = $request->input('layanan');
        $tanggal   = $request->input('tanggal');
        $tglDibuat = $request->input('tgl_dibuat');

        $query = Permintaan::query()->leftJoin('users', 'users.id', '=', 'permintaans.user_id')
                    ->select('permintaans.*');

        if (!empty($search)) {
            $searchLower = strtolower($search);
            $query->where(function ($q) use ($searchLower) {
                $q->whereRaw('LOWER(permintaans.no_permintaan) LIKE ?', ["%$searchLower%"])
                  ->orWhereRaw('LOWER(permintaans.kode_rm) LIKE ?', ["%$searchLower%"])
                  ->orWhereRaw('LOWER(permintaans.nama) LIKE ?', ["%$searchLower%"])
                  ->orWhereRaw('LOWER(COALESCE(permintaans.nm_penerima, \'\')) LIKE ?', ["%$searchLower%"])
                  ->orWhereRaw('LOWER(COALESCE(permintaans.nm_petugas_rm, \'\')) LIKE ?', ["%$searchLower%"])
                  ->orWhereRaw('LOWER(permintaans.layanan) LIKE ?', ["%$searchLower%"])
                  ->orWhereRaw('LOWER(COALESCE(users.name, \'\')) LIKE ?', ["%$searchLower%"])
                  ->orWhereRaw('LOWER(COALESCE(permintaans.no_telepon, \'\')) LIKE ?', ["%$searchLower%"]);
            });
        }

        if (!empty($layanan)) {
            $query->where('layanan', $layanan);
        }

        if (!empty($tanggal)) {
            $query->whereDate('tanggal', $tanggal);
        }

        if (!empty($tglDibuat)) {
            $query->whereDate('tgl_dibuat', $tglDibuat);
        }

        $data = $query->with('user')->orderBy('created_at','desc')->get();
        
        // Ambil semua layanan untuk filter
        $layanans = \App\Models\Layanan::all();

        // Map nama_layanan => template_path untuk cek di view
        $layananTemplateMap = $layanans->pluck('template_path', 'nama_layanan')->toArray();

        return view('permintaan.index', compact('data', 'layanans', 'layananTemplateMap'));
    }

    // =========================
    // VIEW DETAIL
    // =========================
    public function viewSurat($id)
    {
        $data = Permintaan::findOrFail($id);
        return view('permintaan.view', compact('data'));
    }

    // =========================
    // CETAK DINAMIS
    // =========================
    public function cetakSurat($id)
    {
        $data = Permintaan::findOrFail($id);

        $template = [
            'Surat Keterangan Rawat Inap'     => 'surat.rawat_inap',
            'Surat Keterangan Rawat Jalan'    => 'surat.rawat_jalan',
            'Surat Keterangan Layak Terbang'  => 'surat.layak_terbang',
            'Surat Kehilangan Akte Lahir'      => 'surat.kehilangan_akte',
        ];

        if (!isset($template[$data->layanan])) {
            abort(404, 'Template tidak ditemukan');
        }

        return view($template[$data->layanan], compact('data'));
    }

    // =========================
    // EDIT
    // =========================
    public function edit($id)
    {
        $data    = Permintaan::findOrFail($id);
        $doctors = \App\Models\Doctor::where('is_active', true)->orderBy('nama_dokter')->get();
        return view('permintaan.edit', compact('data', 'doctors'));
    }

    // =========================
    // UPDATE
    // =========================
    public function update(Request $request, $id)
    {
        $data = Permintaan::findOrFail($id);

        $request->validate([
            'nm_penerima'   => 'required|string',
            'nm_petugas_rm' => 'required|string',
            'diagnosis'     => 'nullable|string',
            'nama_dokter'   => 'nullable|string',
            'nama_persetujuan' => 'nullable|string',
            'tgl_masuk'     => 'nullable|date',
            'tgl_keluar'    => 'nullable|date',
            'tgl_periksa'   => 'nullable|date',
            'poliklinik'    => 'nullable|string',
            'tgl_berobat'   => 'nullable|date',
            'status_kehamilan' => 'nullable|string',
            'usia_kehamilan_hpht' => 'nullable|string',
            'usia_kehamilan_minggu' => 'nullable|integer',
            'usia_kehamilan_hari' => 'nullable|integer',
            'kondisi_ibu'   => 'nullable|string',

            // KEHILANGAN AKTE
            'no_surat_kelahiran'  => 'nullable|string',
            'jenis_kelamin_bayi'  => 'nullable|string',
            'tgl_lahir_bayi'      => 'nullable|date',
            'jam_lahir_bayi'      => 'nullable|string',
        ]);

        $data->update([
            'nm_penerima'     => $request->nm_penerima,
            'nm_petugas_rm'   => auth()->user()->name,

            // RAWAT INAP
            'tgl_masuk'       => $request->tgl_masuk,
            'tgl_keluar'      => $request->tgl_keluar,

            // RAWAT JALAN
            'tgl_periksa'     => $request->tgl_periksa,
            'poliklinik'      => $request->poliklinik,

            // LAYAK TERBANG
            'tgl_berobat'     => $request->tgl_berobat,
            'status_kehamilan' => $request->status_kehamilan,
            'usia_kehamilan_hpht' => $request->usia_kehamilan_hpht,
            'usia_kehamilan_minggu' => $request->usia_kehamilan_minggu,
            'usia_kehamilan_hari' => $request->usia_kehamilan_hari,
            'kondisi_ibu'     => $request->kondisi_ibu,

            // KEHILANGAN AKTE
            'no_surat_kelahiran' => $request->no_surat_kelahiran,
            'jenis_kelamin_bayi' => $request->jenis_kelamin_bayi,
            'tgl_lahir_bayi'     => $request->tgl_lahir_bayi,
            'jam_lahir_bayi'     => $request->jam_lahir_bayi,

            // UMUM
            'diagnosis'       => $request->diagnosis,
            'nama_dokter'     => $request->nama_dokter,
            'nama_persetujuan'=> $request->nama_persetujuan,
        ]);

        return redirect()->route('permintaan.index')
            ->with('success','Data berhasil diupdate');
    }

    // =========================
    // UPDATE STATUS
    // =========================
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,ditolak',
        ]);

        $data = Permintaan::findOrFail($id);

        $updateData = ['status' => $request->status];

        // Isi tgl_dibuat saat status pertama kali diubah ke selesai
        if ($request->status === 'selesai' && empty($data->tgl_dibuat)) {
            $updateData['tgl_dibuat'] = now();
        }

        $data->update($updateData);

        return response()->json([
            'success'    => true,
            'status'     => $data->status,
            'tgl_dibuat' => $data->tgl_dibuat
                ? \Carbon\Carbon::parse($data->tgl_dibuat)->format('d/m/Y H:i')
                : null,
        ]);
    }

    // =========================
    // UPLOAD SURAT (untuk layanan tanpa template)
    // =========================
    public function uploadSurat(Request $request, $id)
    {
        $request->validate([
            'file_surat' => 'required|file|mimes:pdf|max:5120',
        ]);

        $data = Permintaan::findOrFail($id);

        // Hapus file lama jika ada
        if ($data->file_surat && \Storage::disk('public')->exists($data->file_surat)) {
            \Storage::disk('public')->delete($data->file_surat);
        }

        $path = $request->file('file_surat')->store('surat', 'public');
        $data->update([
            'file_surat'    => $path,
            'nm_petugas_rm' => auth()->user()->name,
        ]);

        return redirect()->route('permintaan.index')
            ->with('success', 'File surat berhasil diupload');
    }

    // =========================
    // DELETE
    // =========================
    public function destroy($id)
    {
        $data = Permintaan::findOrFail($id);
        $data->delete();

        return redirect()->route('permintaan.index')
            ->with('success','Data berhasil dihapus');
    }
}