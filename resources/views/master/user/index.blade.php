<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Akun & Role</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #e6f7f6, #f4fbfa); min-height: 100vh; display: flex; margin: 0; overflow-x: hidden; }

        /* ── SIDEBAR ── */
        .sidebar {
            width: 240px; min-height: 100vh; flex-shrink: 0;
            background: #005654; display: flex; flex-direction: column;
            position: fixed; top: 0; left: 0; bottom: 0; z-index: 100;
        }
        .sidebar-brand { padding: 20px 20px 16px; border-bottom: 1px solid rgba(255,255,255,.1); display: flex; align-items: center; gap: 10px; }
        .sidebar-brand img { height: 38px; width: auto; filter: brightness(0) invert(1); }
        .sidebar-brand-text .title { font-size: 13px; font-weight: 800; color: #fff; line-height: 1.2; }
        .sidebar-brand-text .sub { font-size: 10px; color: rgba(255,255,255,.6); }
        .sidebar-nav { padding: 16px 12px; flex: 1; }
        .sidebar-label { font-size: 10px; font-weight: 700; color: rgba(255,255,255,.4); text-transform: uppercase; letter-spacing: .8px; padding: 0 8px; margin-bottom: 6px; margin-top: 12px; }
        .sidebar-link { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; color: rgba(255,255,255,.75); font-size: 13.5px; font-weight: 500; text-decoration: none; transition: all .2s; margin-bottom: 2px; }
        .sidebar-link i { font-size: 16px; flex-shrink: 0; }
        .sidebar-link:hover { background: rgba(255,255,255,.12); color: #fff; }
        .sidebar-link.active { background: rgba(255,255,255,.18); color: #fff; font-weight: 700; }
        .sidebar-link.active-page { background: #81BD41; color: #fff; font-weight: 700; }
        .sidebar-footer { padding: 16px 12px; border-top: 1px solid rgba(255,255,255,.1); }
        .sidebar-user { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; background: rgba(255,255,255,.08); margin-bottom: 8px; }
        .sidebar-user i { font-size: 20px; color: rgba(255,255,255,.8); }
        .sidebar-user .name { font-size: 13px; font-weight: 600; color: #fff; }
        .sidebar-user .role { font-size: 11px; color: rgba(255,255,255,.5); }
        .btn-logout-sidebar { display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; padding: 9px; border-radius: 10px; background: #7a2020; color: #ffffff; border: 1px solid #a03030; font-size: 13px; font-weight: 600; cursor: pointer; transition: all .2s; }
        .btn-logout-sidebar:hover { background: #9b2828; color: #ffffff; }

        /* ── SIDEBAR DROPDOWN ── */
        .sidebar-dropdown-toggle { background: none; border: none; text-align: left; width: 100%; }
        .sidebar-chevron { transition: transform .25s; font-size: 12px; }
        .sidebar-dropdown.open .sidebar-chevron { transform: rotate(180deg); }
        .sidebar-submenu { overflow: hidden; max-height: 0; transition: max-height .3s ease; }
        .sidebar-dropdown.open .sidebar-submenu { max-height: 200px; }
        .sidebar-sublink {
            display: flex; align-items: center; gap: 8px;
            padding: 8px 12px 8px 32px; border-radius: 8px;
            color: rgba(255,255,255,.65); font-size: 13px; font-weight: 500;
            text-decoration: none; transition: all .2s; margin-bottom: 1px;
        }
        .sidebar-sublink i { font-size: 14px; flex-shrink: 0; }
        .sidebar-sublink:hover { background: rgba(255,255,255,.1); color: #fff; }
        .sidebar-sublink.active { background: #6aaa30; color: #fff; font-weight: 600; }

        /* ── MAIN ── */
        .main-wrapper { margin-left: 240px; flex: 1; min-height: 100vh; display: flex; flex-direction: column; overflow-x: hidden; min-width: 0; }
        .topbar { background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,.06); padding: 14px 28px; }
        .topbar-title { font-size: 18px; font-weight: 800; color: #005654; }
        .topbar-sub { font-size: 12px; color: #6b8f8a; }

        /* ── TABS ── */
        .tab-nav { display: flex; gap: 4px; background: #fff; border-radius: 14px; padding: 6px; box-shadow: 0 2px 12px rgba(0,0,0,.05); width: fit-content; }
        .tab-btn { display: flex; align-items: center; gap: 8px; padding: 9px 20px; border-radius: 10px; font-size: 13.5px; font-weight: 600; border: none; background: transparent; color: #6b8f8a; cursor: pointer; transition: all .2s; }
        .tab-btn:hover { background: #f0f9f8; color: #005654; }
        .tab-btn.active { background: #005654; color: #fff; }
        .tab-btn .count { display: inline-flex; align-items: center; justify-content: center; min-width: 20px; height: 20px; border-radius: 999px; font-size: 11px; font-weight: 700; padding: 0 5px; }
        .tab-btn.active .count { background: rgba(255,255,255,.25); color: #fff; }
        .tab-btn:not(.active) .count { background: #e0f0ef; color: #005654; }

        /* ── TABLE CARD ── */
        .table-card { background: #fff; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,.06); }
        .table-card .table-responsive { overflow-x: auto; overflow-y: auto; max-height: 60vh; border-radius: 16px; }
        #tab-karyawan .table-card .table-responsive { max-height: 75vh; }
        .table thead th { position: sticky; top: 0; z-index: 2; }
        .table { margin-bottom: 0; }
        .table thead th { background: #005654; color: #fff; font-size: 11.5px; font-weight: 600; letter-spacing: .4px; text-transform: uppercase; padding: 13px 18px; border: none; white-space: nowrap; }
        .table tbody td { padding: 13px 18px; vertical-align: middle; border-bottom: 1px solid #f3f3f3; font-size: 13.5px; color: #2d2d2d; }
        .table tbody tr:last-child td { border-bottom: none; }
        .table tbody tr:hover { background: #f7fdfc; }

        /* ── BADGE ROLE ── */
        .badge-role { display: inline-block; padding: 4px 12px; border-radius: 999px; font-size: 12px; font-weight: 600; }

        /* ── BUTTONS ── */
        .btn-primary-custom { display: inline-flex; align-items: center; gap: 6px; padding: 8px 18px; background: #005654; color: #fff; font-size: 13.5px; font-weight: 600; border-radius: 10px; border: none; text-decoration: none; transition: all .2s; cursor: pointer; }
        .btn-primary-custom:hover { background: #007a77; color: #fff; transform: translateY(-1px); }
        .btn-icon { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; border: none; background: transparent; transition: all .2s; font-size: 15px; text-decoration: none; cursor: pointer; }
        .btn-icon-edit { color: #b8860b; }
        .btn-icon-edit:hover { background: #fff3cd; color: #856404; transform: translateY(-1px); }
        .btn-icon-delete { color: #c0392b; }
        .btn-icon-delete:hover { background: #fde8e8; color: #922b21; transform: translateY(-1px); }

        /* ── SEARCH ── */
        .filter-bar { background: #fff; border-radius: 14px; padding: 16px 20px; box-shadow: 0 2px 12px rgba(0,0,0,.05); }
        .search-wrap { position: relative; }
        .search-wrap .bi-search { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #aaa; font-size: 14px; pointer-events: none; }
        .search-wrap input { padding-left: 36px; border-radius: 10px; border: 1.5px solid #d0e8e7; height: 38px; font-size: 13.5px; width: 240px; transition: border-color .2s; }
        .search-wrap input:focus { border-color: #005654; box-shadow: 0 0 0 3px rgba(0,86,84,.1); outline: none; }
        .btn-search { display: inline-flex; align-items: center; gap: 6px; padding: 8px 18px; background: #005654; color: #fff; font-size: 13.5px; font-weight: 600; border-radius: 10px; border: none; cursor: pointer; transition: background .2s, transform .15s; }
        .btn-search:hover { background: #007a77; transform: translateY(-1px); }
        .btn-reset { display: inline-flex; align-items: center; gap: 6px; padding: 8px 14px; border-radius: 10px; font-size: 13.5px; font-weight: 500; border: 1.5px solid #d0d0d0; color: #666; background: #fff; text-decoration: none; transition: all .2s; }
        .btn-reset:hover { border-color: #005654; color: #005654; background: #f0f9f8; }
        .btn-tambah { display: inline-flex; align-items: center; gap: 6px; padding: 8px 18px; background: #005654; color: #fff; font-size: 13.5px; font-weight: 600; border-radius: 10px; border: none; text-decoration: none; transition: background .2s, transform .15s; cursor: pointer; }
        .btn-tambah:hover { background: #007a77; color: #fff; transform: translateY(-1px); }

        /* ── COLOR SWATCH ── */
        .color-swatch { width: 14px; height: 14px; border-radius: 50%; display: inline-block; flex-shrink: 0; border: 1px solid rgba(0,0,0,.1); }

        /* ── MODAL ── */
        .modal-content { border-radius: 16px; border: none; }
        .modal-header { border-bottom: 1px solid #f0f0f0; padding: 20px 24px; }
        .modal-body { padding: 24px; }
        .modal-footer { border-top: 1px solid #f0f0f0; padding: 16px 24px; }
        .form-label { font-weight: 600; font-size: 13.5px; color: #333; }
        .form-control, .form-select { border-radius: 10px; border: 1.5px solid #d0e8e7; font-size: 13.5px; }
        .form-control:focus, .form-select:focus { border-color: #005654; box-shadow: 0 0 0 3px rgba(0,86,84,.1); }

        /* ── EMPTY STATE ── */
        .empty-state { padding: 60px 20px; text-align: center; color: #aaa; }
        .empty-state i { font-size: 48px; margin-bottom: 12px; display: block; color: #c8e6e5; }
        .empty-state p { font-size: 14px; margin: 0; }

        /* ── FORM PANEL (tambah user inline) ── */
        .form-panel { background: #fff; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,.06); padding: 28px 32px; width: 460px; flex-shrink: 0; align-self: flex-start; position: sticky; top: 20px; }
        .form-panel-title { font-size: 16px; font-weight: 800; color: #005654; margin-bottom: 20px; display: flex; align-items: center; gap: 8px; }
        .form-panel .form-label { font-weight: 600; font-size: 13.5px; color: #444; margin-bottom: 4px; }
        .form-panel .form-control, .form-panel .form-select { border-radius: 8px; border: 1.5px solid #d0e8e7; font-size: 13.5px; }
        .form-panel .form-control:focus, .form-panel .form-select:focus { border-color: #005654; box-shadow: 0 0 0 3px rgba(0,86,84,.1); }
        .form-panel .info-badge { background: #e6f7f6; color: #005654; border-radius: 8px; padding: 8px 12px; font-size: 12.5px; margin-bottom: 14px; }
        .form-panel .section-divider { border-top: 1.5px dashed #d0e8e7; margin: 16px 0; }
        .btn-simpan-user { display: flex; align-items: center; justify-content: center; gap: 6px; width: 100%; padding: 10px; background: #005654; color: #fff; font-size: 13.5px; font-weight: 700; border-radius: 10px; border: none; cursor: pointer; transition: background .2s, transform .15s; }
        .btn-simpan-user:hover { background: #007a77; transform: translateY(-1px); }

        /* Select2 inside form-panel */
        .form-panel .select2-container--default .select2-selection--single { border-radius: 8px; border: 1.5px solid #d0e8e7; height: calc(1.5em + 0.75rem + 2px); padding: 0.375rem 0.75rem; font-size: 13.5px; }
        .form-panel .select2-container--default .select2-selection--single .select2-selection__rendered { line-height: 1.5; color: #333; padding-left: 0; }
        .form-panel .select2-container--default .select2-selection--single .select2-selection__arrow { height: 100%; }
        .form-panel .select2-container--default.select2-container--focus .select2-selection--single,
        .form-panel .select2-container--default.select2-container--open .select2-selection--single { border-color: #005654; box-shadow: 0 0 0 3px rgba(0,86,84,0.1); outline: none; }
        .form-panel .select2-container { width: 100% !important; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<aside class="sidebar">
    <div class="sidebar-brand">
        <img src="{{ asset('assets/logo.png') }}" alt="Logo">
        <div class="sidebar-brand-text">
            <div class="title">Rekam Medis</div>
            <div class="sub">Sistem Informasi</div>
        </div>
    </div>
    <nav class="sidebar-nav">
        <div class="sidebar-label">Menu</div>
        <a href="{{ route('permintaan.index') }}" class="sidebar-link">
            <i class="bi bi-list-ul"></i> Permintaan
        </a>
        <a href="{{ route('master.layanan.index') }}" class="sidebar-link">
            <i class="bi bi-gear-fill"></i> Layanan
        </a>
        <div class="sidebar-dropdown open">
            <button class="sidebar-link sidebar-dropdown-toggle active w-100" onclick="toggleSidebarDropdown(this)">
                <i class="bi bi-people-fill"></i>
                <span>Akun</span>
                <i class="bi bi-chevron-down sidebar-chevron ms-auto"></i>
            </button>
            <div class="sidebar-submenu">
                <a href="{{ route('master.user.index') }}?tab=user" class="sidebar-sublink {{ $tab === 'user' ? 'active' : '' }}">
                    <i class="bi bi-person-fill"></i> Manajemen User
                </a>
                <a href="{{ route('master.user.index') }}?tab=role" class="sidebar-sublink {{ $tab === 'role' ? 'active' : '' }}">
                    <i class="bi bi-shield-fill"></i> Manajemen Role
                </a>
                <a href="{{ route('master.user.index') }}?tab=karyawan" class="sidebar-sublink {{ $tab === 'karyawan' ? 'active' : '' }}">
                    <i class="bi bi-person-badge-fill"></i> Data Karyawan
                </a>
            </div>
        </div>
        <a href="{{ route('master.doctor.index') }}" class="sidebar-link">
            <i class="bi bi-hospital-fill"></i> Data Dokter
        </a>
    </nav>
    <div class="sidebar-footer">
        <div class="sidebar-user">
            <i class="bi bi-person-circle"></i>
            <div>
                <div class="name">{{ auth()->user()->name }}</div>
                <div class="role">{{ ucfirst(auth()->user()->role) }}</div>
            </div>
        </div>
        <form method="POST" action="{{ url('/logout') }}" class="m-0">
            @csrf
            <button type="submit" class="btn-logout-sidebar">
                <i class="bi bi-box-arrow-right"></i> Keluar
            </button>
        </form>
    </div>
</aside>

<!-- MAIN WRAPPER -->
<div class="main-wrapper">
    <div class="topbar">
        <div class="topbar-title">Master Akun & Role</div>
        <div class="topbar-sub">Sistem Informasi Rekam Medis</div>
    </div>

    <div class="container-fluid px-4 px-md-5 py-4">

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" style="border-radius:12px;" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" style="border-radius:12px;" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- ══════════════════════════════════════ -->
        <!-- TAB: MANAJEMEN USER                    -->
        <!-- ══════════════════════════════════════ -->
        <div id="tab-user" class="{{ $tab !== 'user' ? 'd-none' : '' }}">
            <div class="d-flex gap-4 align-items-flex-start">

                <!-- ── TABEL USER ── -->
                <div class="flex-grow-1 min-width-0">
                    <!-- Filter -->
                    <div class="filter-bar mb-3">
                        <form method="GET" action="{{ route('master.user.index') }}"
                              class="d-flex align-items-center gap-2 flex-wrap w-100">
                            <input type="hidden" name="tab" value="user">
                            <div class="search-wrap">
                                <i class="bi bi-search"></i>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama...">
                            </div>
                            <select name="role" class="form-select" style="width:160px; height:38px; border-radius:10px; border:1.5px solid #d0e8e7; font-size:13.5px;">
                                <option value="">Semua Role</option>
                                @foreach($roles as $r)
                                    <option value="{{ $r->name }}" {{ request('role') === $r->name ? 'selected' : '' }}>{{ $r->label }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn-search"><i class="bi bi-search"></i> Cari</button>
                            @if(request('search') || request('role'))
                                <a href="{{ route('master.user.index') }}" class="btn-reset"><i class="bi bi-x-circle"></i> Reset</a>
                            @endif
                        </form>
                    </div>

                    <div class="table-card">
                        <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th style="width:40px;">#</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $i => $user)
                                @php
                                    $roleObj = $roles->firstWhere('name', $user->role);
                                    $bgColor = $roleObj ? $roleObj->color . '22' : '#6c757d22';
                                    $txtColor = $roleObj ? $roleObj->color : '#6c757d';
                                @endphp
                                <tr>
                                    <td style="color:#888; font-size:13px;">{{ $i + 1 }}</td>
                                    <td style="font-weight:600;">{{ $user->name }}</td>
                                    <td style="color:#888;">{{ $user->username }}</td>
                                    <td>
                                        <span class="badge-role" style="background:{{ $bgColor }}; color:{{ $txtColor }};">
                                            {{ $roleObj ? $roleObj->label : $user->role }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                                    <button type="button" class="btn-icon btn-icon-edit" title="Edit"
                                                onclick="openEditUser({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ addslashes($user->username) }}', '{{ addslashes($user->role) }}')">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form action="{{ route('master.user.destroy', $user->id) }}" method="POST" class="d-inline"
                                                  onsubmit="return confirm('Yakin hapus akun {{ $user->name }}?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-icon btn-icon-delete" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="empty-state">
                                            <i class="bi bi-people"></i>
                                            <p>Belum ada akun pengguna.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>

                <!-- ── FORM TAMBAH USER ── -->
                <div class="form-panel">
                    <div class="form-panel-title">
                        <i class="bi bi-person-plus-fill" style="color:#81BD41;"></i> Tambah User
                    </div>

                    @if($errors->any() && $tab === 'user')
                        <div class="alert alert-danger p-2 mb-3" style="border-radius:8px; font-size:12px;">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('master.user.store') }}" method="POST" id="formTambahUser">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Pilih Karyawan <span class="text-danger">*</span></label>
                            <select id="employee_select" name="employee_id" class="form-select" required>
                                <option value="">-- Pilih Karyawan --</option>
                                @foreach($employees as $emp)
                                    <option value="{{ $emp->id }}"
                                        data-nama="{{ $emp->nama_karyawan }}"
                                        {{ old('employee_id') == $emp->id ? 'selected' : '' }}>
                                        {{ $emp->nama_karyawan }} — {{ $emp->posisi_pekerjaan ?? $emp->jabatan ?? '-' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="section-divider"></div>

                        <div id="user-account-fields">
                            <div class="info-badge">
                                <i class="bi bi-info-circle me-1"></i>
                                Username dibuat otomatis dari nama depan dan nama belakang.
                            </div>

                            <div class="row g-2 mb-2">
                                <div id="col_nama_depan" class="col-6">
                                    <label class="form-label">Nama Depan</label>
                                    <input type="text" id="u_nama_depan" name="nama_depan" class="form-control"
                                           value="{{ old('nama_depan') }}" required placeholder="Nama depan">
                                </div>
                                <div id="col_nama_belakang" class="col-6">
                                    <label class="form-label">Nama Belakang</label>
                                    <input type="text" id="u_nama_belakang" name="nama_belakang" class="form-control"
                                           value="{{ old('nama_belakang') }}" placeholder="Nama belakang">
                                </div>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Username</label>
                                <input type="text" id="u_username" name="username" class="form-control"
                                       value="{{ old('username') }}" readonly
                                       style="background:#f4fbfa; color:#005654; font-weight:600;">
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" id="u_name" name="name" class="form-control"
                                       value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Role</label>
                                <select name="role" class="form-select" required>
                                    <option value="">-- Pilih Role --</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                            {{ $role->label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control" required>
                            </div>

                            <button type="submit" class="btn-simpan-user">
                                <i class="bi bi-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <!-- ══════════════════════════════════════ -->
        <!-- TAB: MANAJEMEN ROLE                    -->
        <!-- ══════════════════════════════════════ -->
        <div id="tab-role" class="{{ $tab !== 'role' ? 'd-none' : '' }}">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <div style="font-size:28px; font-weight:800; color:#005654;">Daftar Role</div>
                    <div style="font-size:15px; color:#6b8f8a; margin-top:4px;">Kelola hak akses pengguna</div>
                </div>
                <button type="button" class="btn-primary-custom" data-bs-toggle="modal" data-bs-target="#modalTambahRole">
                    <i class="bi bi-plus-lg"></i> Tambah Role
                </button>
            </div>

            <div class="table-card">
                <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width:48px;">#</th>
                            <th>Nama Role</th>
                            <th>Label</th>
                            <th>Deskripsi</th>
                            <th class="text-center">Warna</th>
                            <th class="text-center">Jumlah User</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($roles as $i => $role)
                        <tr>
                            <td style="color:#888; font-size:13px;">{{ $i + 1 }}</td>
                            <td><code style="background:#f4f4f4; padding:2px 8px; border-radius:6px; font-size:12.5px;">{{ $role->name }}</code></td>
                            <td>
                                <span class="badge-role" style="background:{{ $role->color }}22; color:{{ $role->color }};">
                                    {{ $role->label }}
                                </span>
                            </td>
                            <td style="color:#888; font-size:13px;">{{ $role->description ?? '—' }}</td>
                            <td class="text-center">
                                <div class="d-flex align-items-center justify-content-center gap-2">
                                    <span class="color-swatch" style="background:{{ $role->color }};"></span>
                                    <code style="font-size:12px; color:#888;">{{ $role->color }}</code>
                                </div>
                            </td>
                            <td class="text-center">
                                <span style="font-weight:700; color:#005654;">{{ $role->users()->count() }}</span>
                                <span style="color:#aaa; font-size:12px;"> user</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <button class="btn-icon btn-icon-edit" title="Edit"
                                            onclick="openEditRole({{ $role->id }}, '{{ $role->name }}', '{{ addslashes($role->label) }}', '{{ addslashes($role->description ?? '') }}', '{{ $role->color }}')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('master.role.destroy', $role->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin hapus role \'{{ $role->label }}\'? Pastikan tidak ada user yang menggunakan role ini.')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-icon btn-icon-delete" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">
                                <div class="empty-state">
                                    <i class="bi bi-shield"></i>
                                    <p>Belum ada role.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </div>
        </div>

        <!-- ══════════════════════════════════════ -->
        <!-- TAB: DATA KARYAWAN                     -->
        <!-- ══════════════════════════════════════ -->
        <div id="tab-karyawan" class="{{ $tab !== 'karyawan' ? 'd-none' : '' }}">
            <div class="mb-3">
                <div style="font-size:28px; font-weight:800; color:#005654;">Data Karyawan</div>
                <div style="font-size:15px; color:#6b8f8a; margin-top:4px;">Kelola data karyawan rumah sakit</div>
            </div>

            <div class="filter-bar mb-4">
                <form method="GET" action="{{ route('master.user.index') }}"
                      class="d-flex align-items-center gap-2 flex-wrap w-100">
                    <input type="hidden" name="tab" value="karyawan">
                    <div class="search-wrap">
                        <i class="bi bi-search"></i>
                        <input type="text" name="search_karyawan" value="{{ request('search_karyawan') }}" placeholder="Cari nama karyawan...">
                    </div>
                    <button type="submit" class="btn-search"><i class="bi bi-search"></i> Cari</button>
                    @if(request('search_karyawan'))
                        <a href="{{ route('master.user.index') }}?tab=karyawan" class="btn-reset"><i class="bi bi-x-circle"></i> Reset</a>
                    @endif
                    <div class="ms-auto">
                        <button type="button" class="btn-tambah" data-bs-toggle="modal" data-bs-target="#modalTambahKaryawan">
                            <i class="bi bi-plus-lg"></i> Tambah Karyawan
                        </button>
                    </div>
                </form>
            </div>

            <div class="table-card">
                <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th style="width:48px;">#</th>
                            <th>NIP</th>
                            <th>Nama Karyawan</th>
                            <th>Unit</th>
                            <th>Posisi Pekerjaan</th>
                            <th>Profesi</th>
                            <th>Jabatan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $i => $emp)
                        <tr>
                            <td style="color:#888; font-size:13px;">{{ $i + 1 }}</td>
                            <td><code style="background:#f4f4f4; padding:2px 8px; border-radius:6px; font-size:12.5px;">{{ $emp->nip }}</code></td>
                            <td style="font-weight:600;">{{ $emp->nama_karyawan }}</td>
                            <td>{{ $emp->unit }}</td>
                            <td>{{ $emp->posisi_pekerjaan }}</td>
                            <td>{{ $emp->profesi }}</td>
                            <td>{{ $emp->jabatan }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <button class="btn-icon btn-icon-edit" title="Edit"
                                        onclick="openEditKaryawan({{ $emp->id }}, '{{ addslashes($emp->nip) }}', '{{ addslashes($emp->nama_karyawan) }}', '{{ addslashes($emp->unit) }}', '{{ addslashes($emp->posisi_pekerjaan) }}', '{{ addslashes($emp->profesi) }}', '{{ addslashes($emp->jabatan) }}')">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('master.employee.destroy', $emp->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin hapus karyawan {{ $emp->nama_karyawan }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-icon btn-icon-delete" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <i class="bi bi-person-badge"></i>
                                    <p>Belum ada data karyawan.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- ══════════════════════════════════════ -->
<!-- MODAL: TAMBAH ROLE                     -->
<!-- ══════════════════════════════════════ -->
<div class="modal fade" id="modalTambahRole" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('master.role.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" style="color:#005654;">Tambah Role Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Role <span style="color:#aaa; font-weight:400;">(slug, huruf kecil & underscore)</span></label>
                        <input type="text" name="name" class="form-control" placeholder="contoh: kepala_unit" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Label Tampilan</label>
                        <input type="text" name="label" class="form-control" placeholder="contoh: Kepala Unit" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi <span style="color:#aaa; font-weight:400;">(opsional)</span></label>
                        <input type="text" name="description" class="form-control" placeholder="Deskripsi singkat role ini">
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Warna Badge</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="color" name="color" id="colorPickerAdd" value="#005654"
                                   class="form-control form-control-color" style="width:50px; height:38px; border-radius:10px; padding:2px;">
                            <span style="font-size:13px; color:#888;">Pilih warna untuk badge role</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" style="border-radius:10px;" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-primary-custom">Simpan Role</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════ -->
<!-- MODAL: EDIT ROLE                       -->
<!-- ══════════════════════════════════════ -->
<div class="modal fade" id="modalEditRole" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="formEditRole" method="POST">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" style="color:#005654;">Edit Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Role</label>
                        <input type="text" id="editRoleName" class="form-control" disabled style="background:#f8f8f8; color:#888;">
                        <div style="font-size:12px; color:#aaa; margin-top:4px;">Nama role tidak dapat diubah karena digunakan sebagai referensi.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Label Tampilan</label>
                        <input type="text" name="label" id="editRoleLabel" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi <span style="color:#aaa; font-weight:400;">(opsional)</span></label>
                        <input type="text" name="description" id="editRoleDesc" class="form-control">
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Warna Badge</label>
                        <div class="d-flex align-items-center gap-3">
                            <input type="color" name="color" id="colorPickerEdit"
                                   class="form-control form-control-color" style="width:50px; height:38px; border-radius:10px; padding:2px;">
                            <span style="font-size:13px; color:#888;">Pilih warna untuk badge role</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" style="border-radius:10px;" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-primary-custom">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<script>
    function toggleSidebarDropdown(btn) {
        btn.closest('.sidebar-dropdown').classList.toggle('open');
    }
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.sidebar-sublink.active').forEach(el => {
            el.closest('.sidebar-dropdown')?.classList.add('open');
        });

        // Select2 for employee picker
        if (typeof $.fn.select2 !== 'undefined') {
            $('#employee_select').select2({
                dropdownParent: $('#formTambahUser'),
                placeholder: '-- Pilih Karyawan --',
                allowClear: true,
                language: {
                    noResults: () => 'Karyawan tidak ditemukan',
                    searching: () => 'Mencari...'
                }
            });

            $('#employee_select').on('change', function () {
                const selected = this.options[this.selectedIndex];
                if (this.value) {
                    const namaLengkap = selected.getAttribute('data-nama') || '';
                    const { depan, belakang } = pisahkanNama(namaLengkap);
                    document.getElementById('u_nama_depan').value = depan;
                    document.getElementById('u_nama_belakang').value = belakang;
                    document.getElementById('u_name').value = namaLengkap;

                    // Sembunyikan nama belakang jika nama hanya satu kata
                    const colDepan    = document.getElementById('col_nama_depan');
                    const colBelakang = document.getElementById('col_nama_belakang');
                    if (belakang) {
                        colDepan.className    = 'col-6';
                        colBelakang.classList.remove('d-none');
                    } else {
                        colDepan.className    = 'col-12';
                        colBelakang.classList.add('d-none');
                    }

                    generateUsername();
                }
            });
        }

        // Auto-open form if there were validation errors on user tab
        @if($errors->any() && $tab === 'user')
            document.getElementById('user-account-fields').style.display = '';
        @endif
    });

    function pisahkanNama(namaLengkap) {
        const GELAR_DEPAN  = ['dr', 'drg', 'drs', 'dra', 'prof', 'ir', 'ns', 'apt', 'ners', 'kh', 'hj', 'h'];
        const GELAR_BELAKANG = [
            's.kep','s.farm','s.gz','s.ked','s.si','s.km','s.kl','s.pd','s.t','s.e','s.h','s.sos','s.kom','s.ip','s.psi',
            'm.kes','m.kep','m.farm','m.si','m.pd','m.m','m.t','m.h','m.sc','m.kom','ph.d',
            'sp.a','sp.b','sp.og','sp.pd','sp.rad','sp.an','sp.jp','sp.s','sp.m','sp.kk','sp.p','sp.u','sp.tht',
            'sp.gk','sp.mk','sp.kj','sp.f','sp.n','sp.pa','sp.pk','sp.paru','sp.em','sp.ba','sp.bs','sp.bo','sp.btkv',
            'ns','apt','ners','amd','amk','amg','amf','skm','skep','sst','ssi','bsn','mars','mkm','mm','se','dr',
        ];
        // Semua setelah koma pertama adalah gelar
        const idxKoma = namaLengkap.indexOf(',');
        const bagian  = idxKoma !== -1 ? namaLengkap.substring(0, idxKoma).trim() : namaLengkap.trim();
        const kata    = bagian.split(/\s+/);
        // Buang gelar depan
        let i = 0;
        while (i < kata.length && GELAR_DEPAN.includes(kata[i].toLowerCase().replace(/\.$/, ''))) i++;
        // Buang gelar belakang dari akhir
        const kataNama = kata.slice(i);
        while (kataNama.length > 1 && GELAR_BELAKANG.includes(kataNama[kataNama.length - 1].toLowerCase().replace(/\.$/, ''))) {
            kataNama.pop();
        }
        // Bersihkan titik trailing dari setiap kata nama
        const bersih = kataNama.map(k => k.replace(/\.+$/, ''));
        return { depan: bersih[0] || '', belakang: bersih.slice(1).join(' ') };
    }

    function generateUsername() {
        const depan = document.getElementById('u_nama_depan').value.trim().toLowerCase().replace(/\s+/g, '');
        const belakang = document.getElementById('u_nama_belakang').value.trim().toLowerCase().replace(/\s+/g, '');
        document.getElementById('u_username').value = belakang ? depan + '.' + belakang : depan;
    }

    function updateFullName() {
        const depan = document.getElementById('u_nama_depan').value.trim();
        const belakang = document.getElementById('u_nama_belakang').value.trim();
        document.getElementById('u_name').value = belakang ? depan + ' ' + belakang : depan;
    }

    document.getElementById('u_nama_depan')?.addEventListener('input', () => { generateUsername(); updateFullName(); });
    document.getElementById('u_nama_belakang')?.addEventListener('input', () => { generateUsername(); updateFullName(); });

    // Auto-generate username di modal edit user
    function generateEditUserUsername() {
        const depan = document.getElementById('editUserNamaDepan').value.trim().toLowerCase().replace(/\s+/g, '');
        const belakang = document.getElementById('editUserNamaBelakang').value.trim().toLowerCase().replace(/\s+/g, '');
        document.getElementById('editUserUsername').value = belakang ? depan + '.' + belakang : depan;
    }
    function updateEditUserFullName() {
        const depan = document.getElementById('editUserNamaDepan').value.trim();
        const belakang = document.getElementById('editUserNamaBelakang').value.trim();
        document.getElementById('editUserName').value = belakang ? depan + ' ' + belakang : depan;
    }
    document.getElementById('editUserNamaDepan')?.addEventListener('input', () => { generateEditUserUsername(); updateEditUserFullName(); });
    document.getElementById('editUserNamaBelakang')?.addEventListener('input', () => { generateEditUserUsername(); updateEditUserFullName(); });

    function switchTab(tab) {
        ['user','role','karyawan'].forEach(t => {
            document.getElementById('tab-' + t).classList.toggle('d-none', t !== tab);
        });
        document.querySelectorAll('.tab-btn').forEach((btn, i) => {
            const tabs = ['user','role','karyawan'];
            btn.classList.toggle('active', tabs[i] === tab);
        });
    }

    function openEditUser(id, name, username, role) {
        document.getElementById('formEditUser').action = `/master/user/${id}`;
        // Pisahkan nama lengkap jadi depan & belakang
        const parts = name.trim().split(/\s+/);
        const depan = parts[0] || '';
        const belakang = parts.slice(1).join(' ');
        document.getElementById('editUserNamaDepan').value = depan;
        document.getElementById('editUserNamaBelakang').value = belakang;
        document.getElementById('editUserUsername').value = username;
        document.getElementById('editUserName').value = name;
        // Set role
        const roleSelect = document.querySelector('#modalEditUser select[name="role"]');
        if (roleSelect) roleSelect.value = role;
        // Reset password fields
        document.querySelector('#modalEditUser input[name="password"]').value = '';
        document.querySelector('#modalEditUser input[name="password_confirmation"]').value = '';
        bootstrap.Modal.getOrCreateInstance(document.getElementById('modalEditUser')).show();
    }

    function openEditRole(id, name, label, description, color) {
        document.getElementById('formEditRole').action = `/master/role/${id}`;
        document.getElementById('editRoleName').value  = name;
        document.getElementById('editRoleLabel').value = label;
        document.getElementById('editRoleDesc').value  = description;
        document.getElementById('colorPickerEdit').value = color;
        bootstrap.Modal.getOrCreateInstance(document.getElementById('modalEditRole')).show();
    }

    function openEditKaryawan(id, nip, nama, unit, posisi, profesi, jabatan) {
        document.getElementById('formEditKaryawan').action = `/master/employee/${id}`;
        document.getElementById('editNip').value    = nip;
        document.getElementById('editNama').value   = nama;
        document.getElementById('editUnit').value   = unit;
        document.getElementById('editPosisi').value = posisi;
        document.getElementById('editProfesi').value = profesi;
        document.getElementById('editJabatan').value = jabatan;
        bootstrap.Modal.getOrCreateInstance(document.getElementById('modalEditKaryawan')).show();
    }

    // Buka modal tambah role jika ada error validasi
    @if($errors->any() && $tab === 'role')
        document.addEventListener('DOMContentLoaded', () => {
            new bootstrap.Modal(document.getElementById('modalTambahRole')).show();
        });
    @endif

    // Buka tab karyawan jika redirect dengan tab=karyawan
    @if($tab === 'karyawan')
        document.addEventListener('DOMContentLoaded', () => switchTab('karyawan'));
    @endif
</script>
<!-- ══════════════════════════════════════ -->
<!-- MODAL: EDIT USER                        -->
<!-- ══════════════════════════════════════ -->
<div class="modal fade" id="modalEditUser" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="formEditUser" method="POST">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" style="color:#005654;">Edit Akun</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="alert" style="background:#e6f7f6; color:#005654; border-radius:8px; padding:8px 12px; font-size:13px; margin-bottom:16px;">
                        <i class="bi bi-info-circle me-1"></i>
                        Username dibuat otomatis dari nama depan dan nama belakang.
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-6">
                            <label class="form-label">Nama Depan</label>
                            <input type="text" id="editUserNamaDepan" name="nama_depan" class="form-control" required placeholder="Nama depan">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Nama Belakang</label>
                            <input type="text" id="editUserNamaBelakang" name="nama_belakang" class="form-control" placeholder="Nama belakang">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" id="editUserUsername" name="username" class="form-control"
                               style="background:#f4fbfa; color:#005654; font-weight:600;">
                        <div style="font-size:12px; color:#888; margin-top:4px;">Format: namadepan.namabelakang — bisa diedit manual jika perlu.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" id="editUserName" name="name" class="form-control" required>
                    </div>
                    <div style="border-top:1.5px dashed #d0e8e7; margin:16px 0;"></div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password" class="form-control">
                        <div style="font-size:12px; color:#888; margin-top:4px;">Kosongkan jika tidak ingin mengubah password.</div>
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Konfirmasi Password Baru</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" style="border-radius:10px;" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-primary-custom">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════ -->
<!-- MODAL: TAMBAH KARYAWAN                 -->
<!-- ══════════════════════════════════════ -->
<div class="modal fade" id="modalTambahKaryawan" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="{{ route('master.employee.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" style="color:#005654;">Tambah Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">NIP</label>
                            <input type="text" name="nip" class="form-control" placeholder="Nomor Induk Pegawai" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" name="nama_karyawan" class="form-control" placeholder="Nama lengkap" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Unit</label>
                            <input type="text" name="unit" class="form-control" placeholder="Unit kerja" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Posisi Pekerjaan</label>
                            <input type="text" name="posisi_pekerjaan" class="form-control" placeholder="Posisi pekerjaan" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Profesi</label>
                            <input type="text" name="profesi" class="form-control" placeholder="Profesi" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" placeholder="Jabatan" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" style="border-radius:10px;" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-primary-custom">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ══════════════════════════════════════ -->
<!-- MODAL: EDIT KARYAWAN                   -->
<!-- ══════════════════════════════════════ -->
<div class="modal fade" id="modalEditKaryawan" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form id="formEditKaryawan" method="POST">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" style="color:#005654;">Edit Karyawan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">NIP</label>
                            <input type="text" name="nip" id="editNip" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Karyawan</label>
                            <input type="text" name="nama_karyawan" id="editNama" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Unit</label>
                            <input type="text" name="unit" id="editUnit" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Posisi Pekerjaan</label>
                            <input type="text" name="posisi_pekerjaan" id="editPosisi" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Profesi</label>
                            <input type="text" name="profesi" id="editProfesi" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" id="editJabatan" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" style="border-radius:10px;" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-primary-custom">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
