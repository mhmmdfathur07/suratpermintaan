<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Layanan</title>
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

    /* ── MAIN ── */
    .main-wrapper { margin-left: 240px; flex: 1; min-height: 100vh; display: flex; flex-direction: column; overflow-x: hidden; min-width: 0; }
    .topbar { background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,.06); padding: 14px 28px; }
    .topbar-title { font-size: 18px; font-weight: 800; color: #005654; }
    .topbar-sub { font-size: 12px; color: #6b8f8a; }

    .form-card {
        max-width: 580px;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 8px 28px rgba(0,0,0,.07);
        padding: 36px 40px;
    }
    .form-card-title {
        font-size: 18px; font-weight: 800; color: #005654;
        margin-bottom: 24px; text-align: center;
    }
    .form-label { font-weight: 600; font-size: 13.5px; color: #333; margin-bottom: 6px; }
    .form-control, .form-select {
        border-radius: 10px;
        border: 1.5px solid #d0e8e7;
        font-size: 13.5px;
        transition: border-color .2s, box-shadow .2s;
    }
    .form-control:focus, .form-select:focus {
        border-color: #005654;
        box-shadow: 0 0 0 3px rgba(0,86,84,.1);
        outline: none;
    }
    .btn-simpan {
        display: flex; align-items: center; justify-content: center; gap: 6px;
        width: 100%; padding: 11px;
        background: #005654; color: #fff;
        font-size: 14px; font-weight: 700;
        border-radius: 10px; border: none;
        cursor: pointer; transition: background .2s, transform .15s;
    }
    .btn-simpan:hover { background: #007a77; transform: translateY(-1px); }
    .btn-back {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 7px 16px; border-radius: 10px; font-size: 13px; font-weight: 500;
        border: 1.5px solid #d0d0d0; color: #555; background: #fff;
        text-decoration: none; transition: all .2s;
    }
    .btn-back:hover { border-color: #005654; color: #005654; background: #f0f9f8; }
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
        <div class="topbar-title">Tambah Layanan</div>
        <div class="topbar-sub">Sistem Informasi Rekam Medis</div>
    </div>

    <div class="container-fluid px-4 px-md-5 py-4">

        <div class="mb-3">
            <a href="{{ route('master.layanan.index') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="form-card">
            <div class="form-card-title">Form Tambah Layanan</div>

            @if ($errors->any())
                <div class="alert alert-danger" style="border-radius:10px; font-size:13px;">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('master.layanan.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Layanan</label>
                    <input type="text" name="nama_layanan" class="form-control"
                           placeholder="Contoh: Surat Keterangan Rawat Inap"
                           value="{{ old('nama_layanan') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" rows="3"
                              placeholder="Deskripsi layanan (opsional)">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="mb-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_active"
                               id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active" style="font-size:13.5px; font-weight:500;">
                            Aktif
                        </label>
                    </div>
                </div>

                <button type="submit" class="btn-simpan">
                    <i class="bi bi-save"></i> Simpan
                </button>
            </form>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebarDropdown(btn) {
        btn.closest('.sidebar-dropdown').classList.toggle('open');
    }
</script>
</body>
</html>
