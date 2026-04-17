<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Layanan;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
        {
            $query = Layanan::query();
            
            if ($request->has('search') && $request->search != '') {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('nama_layanan', 'like', '%' . $search . '%')
                      ->orWhere('deskripsi', 'like', '%' . $search . '%');
                });
            }
            
            $layanans = $query->orderBy('created_at', 'desc')->get();
            return view('master.layanan.index', compact('layanans'));
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
        {
            return view('master.layanan.create');
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
        {
            $request->validate([
                'nama_layanan' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'is_active' => 'boolean'
            ]);

            Layanan::create([
                'nama_layanan' => $request->nama_layanan,
                'deskripsi' => $request->deskripsi,
                'is_active' => $request->has('is_active') ? 1 : 0
            ]);

            return redirect()->route('master.layanan.index')->with('success', 'Layanan berhasil ditambahkan');
        }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
        {
            $layanan = Layanan::findOrFail($id);
            if (request()->expectsJson()) {
                return response()->json($layanan);
            }
            return view('master.layanan.edit', compact('layanan'));
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
        {
            $request->validate([
                'nama_layanan' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'is_active' => 'boolean'
            ]);

            $layanan = Layanan::findOrFail($id);
            $layanan->update([
                'nama_layanan' => $request->nama_layanan,
                'deskripsi' => $request->deskripsi,
                'is_active' => $request->has('is_active') ? 1 : 0
            ]);

            return redirect()->route('master.layanan.index')->with('success', 'Layanan berhasil diupdate');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
        {
            $layanan = Layanan::findOrFail($id);
            $layanan->delete();

            return redirect()->route('master.layanan.index')->with('success', 'Layanan berhasil dihapus');
        }
}
