<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
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
        $query = User::orderBy('name');

        if ($request->filled('search')) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($request->search) . '%']);
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users     = $query->get();
        $roles     = Role::orderBy('label')->get();

        $empQuery = Employee::orderBy('nama_karyawan');
        if ($request->filled('search_karyawan')) {
            $empQuery->whereRaw('LOWER(nama_karyawan) LIKE ?', ['%' . strtolower($request->search_karyawan) . '%']);
        }
        $employees = $empQuery->get();
        $tab       = $request->get('tab', 'user');

        return view('master.user.index', compact('users', 'roles', 'employees', 'tab'));
    }

    public function create()
    {
        $this->authorizeAdmin();
        $roles     = Role::orderBy('label')->get();
        $employees = Employee::orderBy('nama_karyawan')->get();
        return view('master.user.create', compact('roles', 'employees'));
    }

    public function store(Request $request)
    {
        $this->authorizeAdmin();
        $validRoles = Role::pluck('name')->toArray();

        $validated = $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'nama_depan'  => 'required|string|max:255',
            'nama_belakang' => 'nullable|string|max:255',
            'name'        => 'required|string|max:255',
            'username'    => 'required|string|max:255|unique:users,username',
            'password'    => 'required|min:6|confirmed',
            'role'        => ['required', Rule::in($validRoles)],
        ]);

        User::create([
            'name'     => $validated['name'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
        ]);

        return redirect()->route('master.user.index', ['tab' => 'user'])->with('success', 'Akun berhasil dibuat.');
    }

    public function edit($id)
    {
        $this->authorizeAdmin();
        $user  = User::findOrFail($id);
        $roles = Role::orderBy('label')->get();
        return view('master.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $this->authorizeAdmin();
        $user       = User::findOrFail($id);
        $validRoles = Role::pluck('name')->toArray();

        $request->validate([
            'nama_depan'   => 'required|string|max:255',
            'nama_belakang' => 'nullable|string|max:255',
            'name'         => 'required|string|max:255',
            'username'     => ['required', 'string', 'max:255', Rule::unique('users', 'username')->ignore($id)],
            'role'         => ['required', Rule::in($validRoles)],
            'password'     => 'nullable|min:6|confirmed',
        ]);

        $user->name     = $request->name;
        $user->username = $request->username;
        $user->role     = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('master.user.index', ['tab' => 'user'])->with('success', 'Akun berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->authorizeAdmin();
        $user = User::findOrFail($id);

        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();
        return back()->with('success', 'Akun berhasil dihapus.');
    }
}
