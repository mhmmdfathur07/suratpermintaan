<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Master Layanan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    *, *::before, *::after { box-sizing: border-box; }
    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #e6f7f6, #f4fbfa);
        min-height: 100vh; display: flex; margin: 0;
        overflow-x: hidden;
    }

    /* ── SIDEBAR ── */
    .sidebar {
        width: 240px; min-height: 100vh; flex-shrink: 0;
        background: #005654; display: flex; flex-direction: column;
        position: fixed; top: 0; left: 0; bottom: 0; z-index: 100;
    }
    .sidebar-brand {
        padding: 20px 20px 16px; border-bottom: 1px solid rgba(255,255,255,.1);
        display: flex; align-items: center; gap: 10px;
    }
    .sidebar-brand img { height: 38px; width: auto; filter: brightness(0) invert(1); }
    .sidebar-brand-text .title { font-size: 13px; font-weight: 800; color: #fff; line-height: 1.2; }
    .sidebar-brand-text .sub { font-size: 10px; color: rgba(255,255,255,.6); }
    .sidebar-nav { padding: 16px 12px; flex: 1; }
    .sidebar-label {
        font-size: 10px; font-weight: 700; color: rgba(255,255,255,.4);
        text-transform: uppercase; letter-spacing: .8px;
        padding: 0 8px; margin-bottom: 6px; margin-top: 12px;
    }
    .sidebar-link {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 12px; border-radius: 10px;
        color: rgba(255,255,255,.75); font-size: 13.5px; font-weight: 500;
        text-decoration: none; transition: all .2s; margin-bottom: 2px;
    }
    .sidebar-link i { font-size: 16px; flex-shrink: 0; }
    .sidebar-link:hover { background: rgba(255,255,255,.12); color: #fff; }
    .sidebar-link.active { background: rgba(255,255,255,.18); color: #fff; font-weight: 700; }
    .sidebar-link.active-page { background: #81BD41; color: #fff; font-weight: 700; }
    .sidebar-footer { padding: 16px 12px; border-top: 1px solid rgba(255,255,255,.1); }
    .sidebar-user {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 12px; border-radius: 10px;
        background: rgba(255,255,255,.08); margin-bottom: 8px;
    }
    .sidebar-user i { font-size: 20px; color: rgba(255,255,255,.8); }
    .sidebar-user .name { font-size: 13px; font-weight: 600; color: #fff; }
    .sidebar-user .role { font-size: 11px; color: rgba(255,255,255,.5); }
    .btn-logout-sidebar {
        display: flex; align-items: center; justify-content: center; gap: 8px;
        width: 100%; padding: 9px; border-radius: 10px;
        background: #7a2020; color: #ffffff;
        border: 1px solid #a03030; font-size: 13px; font-weight: 600;
        cursor: pointer; transition: all .2s;
    }
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
    .main-wrapper { margin-left: 240px; flex: 1; min-height: 100vh; display: flex; flex-direction: column; overflow-x: hidden; min-width: 0; }
    .topbar { background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,.06); padding: 14px 28px; }
    .topbar-title { font-size: 18px; font-weight: 800; color: #005654; }
    .topbar-sub { font-size: 12px; color: #6b8f8a; }

    .filter-bar {
        background: #fff; border-radius: 14px; padding: 16px 20px;
        box-shadow: 0 2px 12px rgba(0,0,0,.05);
        display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
    }
    .search-wrap { position: relative; }
    .search-wrap .bi-search {
        position: absolute; left: 12px; top: 50%;
        transform: translateY(-50%); color: #aaa; font-size: 14px; pointer-events: none;
    }
    .search-wrap input {
        padding-left: 36px; border-radius: 10px; border: 1.5px solid #d0e8e7;
        height: 38px; font-size: 13.5px; width: 260px;
        transition: border-color .2s, box-shadow .2s;
    }
    .search-wrap input:focus { border-color: #005654; box-shadow: 0 0 0 3px rgba(0,86,84,.1); outline: none; }
    .btn-search {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 18px; background: #005654; color: #fff;
        font-size: 13.5px; font-weight: 600; border-radius: 10px;
        border: none; cursor: pointer; transition: background .2s, transform .15s;
    }
    .btn-search:hover { background: #007a77; transform: translateY(-1px); }
    .btn-reset {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 14px; border-radius: 10px; font-size: 13.5px; font-weight: 500;
        border: 1.5px solid #d0d0d0; color: #666; background: #fff; text-decoration: none; transition: all .2s;
    }
    .btn-reset:hover { border-color: #005654; color: #005654; background: #f0f9f8; }
    .btn-tambah {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 18px; background: #005654; color: #fff;
        font-size: 13.5px; font-weight: 600; border-radius: 10px;
        text-decoration: none; transition: background .2s, transform .15s;
    }
    .btn-tambah:hover { background: #007a77; color: #fff; transform: translateY(-1px); }

    .table-card { background: #fff; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,.06); }
    .table-card .table-responsive { overflow-x: auto; overflow-y: auto; max-height: 60vh; border-radius: 16px; }
    .table thead th { position: sticky; top: 0; z-index: 2; }
    .table { margin-bottom: 0; }
    .table thead th {
        background: #005654; color: #fff; font-size: 11.5px; font-weight: 600;
        letter-spacing: .4px; text-transform: uppercase; padding: 13px 14px; border: none; white-space: nowrap;
    }
    .table tbody td {
        padding: 12px 14px; vertical-align: middle;
        border-bottom: 1px solid #f3f3f3; font-size: 13px; color: #2d2d2d;
    }
    .table tbody tr:last-child td { border-bottom: none; }
    .table tbody tr { transition: background .15s; }
    .table tbody tr:hover { background: #f7fdfc; }

    .td-nama { font-weight: 600; color: #1a1a2e; }
    .td-muted { color: #888; font-size: 12.5px; }

    .badge-aktif { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: 11.5px; font-weight: 600; background: #d1f5ee; color: #0a6b52; }
    .badge-nonaktif { display: inline-block; padding: 3px 10px; border-radius: 999px; font-size: 11.5px; font-weight: 600; background: #ebebeb; color: #6c757d; }

    .btn-icon {
        display: inline-flex; align-items: center; justify-content: center;
        width: 32px; height: 32px; border-radius: 8px; border: none; background: transparent;
        transition: background .2s, color .2s, transform .15s; font-size: 15px; text-decoration: none; cursor: pointer;
    }
    .btn-icon-edit { color: #b8860b; }
    .btn-icon-edit:hover { background: #fff3cd; color: #856404; transform: translateY(-1px); }
    .btn-icon-delete { color: #c0392b; }
    .btn-icon-delete:hover { background: #fde8e8; color: #922b21; transform: translateY(-1px); }

    .empty-state { padding: 60px 20px; text-align: center; color: #aaa; }
    .empty-state i { font-size: 48px; margin-bottom: 12px; display: block; color: #c8e6e5; }
    .empty-state p { font-size: 14px; margin: 0; }
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
        <a href="{{ route('master.layanan.index') }}" class="sidebar-link active-page">
            <i class="bi bi-gear-fill"></i> Layanan
        </a>
        @if(auth()->user()->role === 'admin')
        <div class="sidebar-dropdown">
            <button class="sidebar-link sidebar-dropdown-toggle w-100" onclick="toggleSidebarDropdown(this)">
                <i class="bi bi-people-fill"></i>
                <span>Akun</span>
                <i class="bi bi-chevron-down sidebar-chevron ms-auto"></i>
            </button>
            <div class="sidebar-submenu">
                <a href="{{ route('master.user.index') }}?tab=user" class="sidebar-sublink">
                    <i class="bi bi-person-fill"></i> Manajemen User
                </a>
                <a href="{{ route('master.user.index') }}?tab=role" class="sidebar-sublink">
                    <i class="bi bi-shield-fill"></i> Manajemen Role
                </a>
                <a href="{{ route('master.user.index') }}?tab=karyawan" class="sidebar-sublink">
                    <i class="bi bi-person-badge-fill"></i> Data Karyawan
                </a>
            </div>
        </div>
        <a href="{{ route('master.doctor.index') }}" class="sidebar-link">
            <i class="bi bi-hospital-fill"></i> Data Dokter
        </a>
        @endif
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
        <div class="topbar-title">Master Layanan</div>
        <div class="topbar-sub">Sistem Informasi Rekam Medis</div>
    </div>

    <div class="container-fluid px-4 px-md-5 py-4">

        @if(session('success'))
            <div class="alert alert-success d-flex align-items-center gap-2 mb-4" style="border-radius:12px;">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        <div class="filter-bar mb-4">
            <form method="GET" action="{{ route('master.layanan.index') }}"
                  class="d-flex align-items-center gap-2 flex-wrap w-100">
                <div class="search-wrap">
                    <i class="bi bi-search"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari layanan...">
                </div>
                <button type="submit" class="btn-search"><i class="bi bi-search"></i> Cari</button>
                @if(request('search'))
                    <a href="{{ route('master.layanan.index') }}" class="btn-reset"><i class="bi bi-x-circle"></i> Reset</a>
                @endif
                <div class="ms-auto">
                    <button type="button" class="btn-tambah" data-bs-toggle="modal" data-bs-target="#modalTambahLayanan">
                        <i class="bi bi-plus-lg"></i> Tambah Layanan
                    </button>
                </div>
            </form>
        </div>

        <div class="table-card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th style="width:50px;">No</th>
                            <th>Nama Layanan</th>
                            <th>Deskripsi</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($layanans as $index => $layanan)
                        <tr>
                            <td class="td-muted">{{ $index + 1 }}</td>
                            <td class="td-nama">{{ $layanan->nama_layanan }}</td>
                            <td class="td-muted">{{ $layanan->deskripsi ?? '-' }}</td>
                            <td class="text-center">
                                @if($layanan->is_active)
                                    <span class="badge-aktif">Aktif</span>
                                @else
                                    <span class="badge-nonaktif">Nonaktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <button type="button"
                                       class="btn-icon btn-icon-edit" title="Edit"
                                       onclick="openEditModal({{ $layanan->id }}, '{{ addslashes($layanan->nama_layanan) }}', '{{ addslashes($layanan->deskripsi ?? '') }}', {{ $layanan->is_active ? 'true' : 'false' }})">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('master.layanan.destroy', $layanan->id) }}"
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus layanan ini?')">
                                        @csrf
                                        @method('DELETE')
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
                                    <i class="bi bi-inbox"></i>
                                    <p>Belum ada data layanan.</p>
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

<!-- Modal Tambah Layanan -->
<div class="modal fade" id="modalTambahLayanan" tabindex="-1" aria-labelledby="modalTambahLayananLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:18px; border:none; box-shadow:0 12px 40px rgba(0,0,0,.12);">
            <div class="modal-header" style="border-bottom:1px solid #f0f0f0; padding:20px 28px;">
                <h5 class="modal-title" id="modalTambahLayananLabel" style="font-size:17px; font-weight:800; color:#005654;">
                    <i class="bi bi-plus-circle-fill me-2"></i>Tambah Layanan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('master.layanan.store') }}">
                @csrf
                <div class="modal-body" style="padding:24px 28px;">
                    @if ($errors->any())
                        <div class="alert alert-danger" style="border-radius:10px; font-size:13px;">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="mb-3">
                        <label class="form-label" style="font-weight:600; font-size:13.5px; color:#333;">Nama Layanan</label>
                        <input type="text" name="nama_layanan" class="form-control"
                               placeholder="Contoh: Surat Keterangan Rawat Inap"
                               value="{{ old('nama_layanan') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight:600; font-size:13.5px; color:#333;">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"
                                  placeholder="Deskripsi layanan (opsional)">{{ old('deskripsi') }}</textarea>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active"
                               id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active" style="font-size:13.5px; font-weight:500;">Aktif</label>
                    </div>
                </div>
                <div class="modal-footer" style="border-top:1px solid #f0f0f0; padding:16px 28px; gap:8px;">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            style="border-radius:10px; font-size:13.5px; font-weight:500;">Batal</button>
                    <button type="submit" class="btn-tambah" style="padding:9px 22px;">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Layanan -->
<div class="modal fade" id="modalEditLayanan" tabindex="-1" aria-labelledby="modalEditLayananLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:18px; border:none; box-shadow:0 12px 40px rgba(0,0,0,.12);">
            <div class="modal-header" style="border-bottom:1px solid #f0f0f0; padding:20px 28px;">
                <h5 class="modal-title" id="modalEditLayananLabel" style="font-size:17px; font-weight:800; color:#005654;">
                    <i class="bi bi-pencil-fill me-2"></i>Edit Layanan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" id="formEditLayanan">
                @csrf
                @method('PUT')
                <div class="modal-body" style="padding:24px 28px;">
                    <div class="mb-3">
                        <label class="form-label" style="font-weight:600; font-size:13.5px; color:#333;">Nama Layanan</label>
                        <input type="text" name="nama_layanan" id="edit_nama_layanan" class="form-control"
                               placeholder="Nama layanan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" style="font-weight:600; font-size:13.5px; color:#333;">Deskripsi</label>
                        <textarea name="deskripsi" id="edit_deskripsi" class="form-control" rows="3"
                                  placeholder="Deskripsi layanan (opsional)"></textarea>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active"
                               id="edit_is_active" value="1">
                        <label class="form-check-label" for="edit_is_active" style="font-size:13.5px; font-weight:500;">Aktif</label>
                    </div>
                </div>
                <div class="modal-footer" style="border-top:1px solid #f0f0f0; padding:16px 28px; gap:8px;">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                            style="border-radius:10px; font-size:13.5px; font-weight:500;">Batal</button>
                    <button type="submit" class="btn-tambah" style="padding:9px 22px;">
                        <i class="bi bi-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebarDropdown(btn) {
        btn.closest('.sidebar-dropdown').classList.toggle('open');
    }
    document.querySelectorAll('.sidebar-sublink.active').forEach(el => {
        el.closest('.sidebar-dropdown')?.classList.add('open');
    });
    @if ($errors->any())
        var modal = new bootstrap.Modal(document.getElementById('modalTambahLayanan'));
        modal.show();
    @endif

    function openEditModal(id, nama, deskripsi, isActive) {
        const baseUrl = '{{ url("master/layanan") }}';
        document.getElementById('formEditLayanan').action = baseUrl + '/' + id;
        document.getElementById('edit_nama_layanan').value = nama;
        document.getElementById('edit_deskripsi').value = deskripsi;
        document.getElementById('edit_is_active').checked = isActive;
        new bootstrap.Modal(document.getElementById('modalEditLayanan')).show();
    }
</script>
</body>
</html>
