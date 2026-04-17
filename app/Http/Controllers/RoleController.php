<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private function authorizeAdmin()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Akses ditolak.');
        }
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'name'        => 'required|string|max:50|unique:roles,name|regex:/^[a-z0-9_]+$/',
            'label'       => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'color'       => 'required|string|max:7',
        ], [
            'name.regex' => 'Nama role hanya boleh huruf kecil, angka, dan underscore.',
        ]);

        Role::create($request->only('name', 'label', 'description', 'color'));

        return redirect()->route('master.user.index', ['tab' => 'role'])
            ->with('success', 'Role berhasil ditambahkan.');
    }

    public function update(Request $request, Role $role)
    {
        $this->authorizeAdmin();

        $request->validate([
            'label'       => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'color'       => 'required|string|max:7',
        ]);

        $role->update($request->only('label', 'description', 'color'));

        return redirect()->route('master.user.index', ['tab' => 'role'])
            ->with('success', 'Role berhasil diperbarui.');
    }

    public function destroy(Role $role)
    {
        $this->authorizeAdmin();

        if ($role->users()->count() > 0) {
            return redirect()->route('master.user.index', ['tab' => 'role'])
                ->with('error', "Role '{$role->label}' tidak dapat dihapus karena masih digunakan oleh {$role->users()->count()} akun.");
        }

        $role->delete();

        return redirect()->route('master.user.index', ['tab' => 'role'])
            ->with('success', 'Role berhasil dihapus.');
    }
}
