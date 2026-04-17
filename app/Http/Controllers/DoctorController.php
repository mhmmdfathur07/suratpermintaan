<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    private function authorizeAdmin()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
    }

    public function index(Request $request)
    {
        $this->authorizeAdmin();

        $query = Doctor::orderBy('nama_dokter');

        if ($request->filled('search')) {
            $query->whereRaw('LOWER(nama_dokter) LIKE ?', ['%' . strtolower($request->search) . '%']);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'aktif');
        }

        $doctors = $query->get();

        return view('master.doctor.index', compact('doctors'));
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'nama_dokter'  => 'required|string|max:255',
            'spesialisasi' => 'nullable|string|max:255',
            'no_sip'       => 'nullable|string|max:100',
            'no_telepon'   => 'nullable|string|max:20',
        ]);

        Doctor::create([
            'nama_dokter'  => $request->nama_dokter,
            'spesialisasi' => $request->spesialisasi,
            'no_sip'       => $request->no_sip,
            'no_telepon'   => $request->no_telepon,
            'is_active'    => $request->input('is_active') === '1',
        ]);

        return redirect()->route('master.doctor.index')->with('success', 'Dokter berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $this->authorizeAdmin();

        $doctor = Doctor::findOrFail($id);

        $request->validate([
            'nama_dokter'  => 'required|string|max:255',
            'spesialisasi' => 'nullable|string|max:255',
            'no_sip'       => 'nullable|string|max:100',
            'no_telepon'   => 'nullable|string|max:20',
        ]);

        $doctor->update([
            'nama_dokter'  => $request->nama_dokter,
            'spesialisasi' => $request->spesialisasi,
            'no_sip'       => $request->no_sip,
            'no_telepon'   => $request->no_telepon,
            'is_active'    => $request->input('is_active') === '1',
        ]);

        return redirect()->route('master.doctor.index')->with('success', 'Data dokter berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->authorizeAdmin();

        Doctor::findOrFail($id)->delete();

        return back()->with('success', 'Dokter berhasil dihapus.');
    }
}
