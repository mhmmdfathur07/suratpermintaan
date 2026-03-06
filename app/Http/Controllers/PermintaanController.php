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
        $search  = $request->input('search');
        $layanan = $request->input('layanan');
        $tanggal = $request->input('tanggal');

        $query = Permintaan::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('no_permintaan', 'LIKE', "%$search%")
                  ->orWhere('tanggal', 'LIKE', "%$search%")
                  ->orWhere('kode_rm', 'LIKE', "%$search%")
                  ->orWhere('nama', 'LIKE', "%$search%")
                  ->orWhere('nm_penerima', 'LIKE', "%$search%")
                  ->orWhere('nm_petugas_rm', 'LIKE', "%$search%")
                  ->orWhere('layanan', 'LIKE', "%$search%");
            });
        }

        if (!empty($layanan)) {
            $query->where('layanan', $layanan);
        }

        if (!empty($tanggal)) {
            $query->whereDate('tanggal', $tanggal);
        }

        $data = $query->orderBy('created_at','desc')->get();

        return view('permintaan.index', compact('data'));
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
            'Surat Keterangan Rawat Inap'  => 'surat.rawat_inap',
            'Surat Keterangan Rawat Jalan' => 'surat.rawat_jalan',
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
        $data = Permintaan::findOrFail($id);
        return view('permintaan.edit', compact('data'));
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
            'status'        => 'required',
            'diagnosis'     => 'nullable|string',
            'nama_dokter'   => 'nullable|string',
            'nama_persetujuan' => 'nullable|string',
            'tgl_masuk'     => 'nullable|date',
            'tgl_keluar'    => 'nullable|date',
            'tgl_periksa'   => 'nullable|date',
            'poliklinik'    => 'nullable|string',
        ]);

        $data->update([
            'nm_penerima'     => $request->nm_penerima,
            'nm_petugas_rm'   => $request->nm_petugas_rm,
            'status'          => $request->status,

            // RAWAT INAP
            'tgl_masuk'       => $request->tgl_masuk,
            'tgl_keluar'      => $request->tgl_keluar,

            // RAWAT JALAN
            'tgl_periksa'     => $request->tgl_periksa,
            'poliklinik'      => $request->poliklinik,

            // UMUM
            'diagnosis'       => $request->diagnosis,
            'nama_dokter'     => $request->nama_dokter,
            'nama_persetujuan'=> $request->nama_persetujuan,
        ]);

        return redirect()->route('permintaan.index')
            ->with('success','Data berhasil diupdate');
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