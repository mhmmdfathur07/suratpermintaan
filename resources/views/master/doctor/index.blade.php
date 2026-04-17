<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Dokter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #e6f7f6, #f4fbfa); min-height: 100vh; display: flex; margin: 0; overflow-x: hidden; }

        .sidebar { width: 240px; min-height: 100vh; flex-shrink: 0; background: #005654; display: flex; flex-direction: column; position: fixed; top: 0; left: 0; bottom: 0; z-index: 100; }
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

        .sidebar-dropdown-toggle { background: none; border: none; text-align: left; width: 100%; }
        .sidebar-chevron { transition: transform .25s; font-size: 12px; }
        .sidebar-dropdown.open .sidebar-chevron { transform: rotate(180deg); }
        .sidebar-submenu { overflow: hidden; max-height: 0; transition: max-height .3s ease; }
        .sidebar-dropdown.open .sidebar-submenu { max-height: 300px; }
        .sidebar-sublink { display: flex; align-items: center; gap: 8px; padding: 8px 12px 8px 32px; border-radius: 8px; color: rgba(255,255,255,.65); font-size: 13px; font-weight: 500; text-decoration: none; transition: all .2s; margin-bottom: 1px; }
        .sidebar-sublink i { font-size: 14px; flex-shrink: 0; }
        .sidebar-sublink:hover { background: rgba(255,255,255,.1); color: #fff; }
        .sidebar-sublink.active { background: #6aaa30; color: #fff; font-weight: 600; }

        .main-wrapper { margin-left: 240px; flex: 1; min-height: 100vh; display: flex; flex-direction: column; overflow-x: hidden; min-width: 0; }
        .topbar { background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,.06); padding: 14px 28px; }
        .topbar-title { font-size: 18px; font-weight: 800; color: #005654; }
        .topbar-sub { font-size: 12px; color: #6b8f8a; }

        .table-card { background: #fff; border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,.06); }
        .table-card .table-responsive { overflow-x: auto; overflow-y: auto; max-height: 60vh; border-radius: 16px; }
        .table { margin-bottom: 0; }
        .table thead th { position: sticky; top: 0; z-index: 2; background: #005654; color: #fff; font-size: 11.5px; font-weight: 600; letter-spacing: .4px; text-transform: uppercase; padding: 13px 18px; border: none; white-space: nowrap; }
        .table tbody td { padding: 13px 18px; vertical-align: middle; border-bottom: 1px solid #f3f3f3; font-size: 13.5px; color: #2d2d2d; }
        .table tbody tr:last-child td { border-bottom: none; }
        .table tbody tr:hover { background: #f7fdfc; }

        .btn-primary-custom { display: inline-flex; align-items: center; gap: 6px; padding: 8px 18px; background: #005654; color: #fff; font-size: 13.5px; font-weight: 600; border-radius: 10px; border: none; text-decoration: none; transition: all .2s; cursor: pointer; }
        .btn-primary-custom:hover { background: #007a77; color: #fff; transform: translateY(-1px); }
        .btn-icon { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; border: none; background: transparent; transition: all .2s; font-size: 15px; text-decoration: none; cursor: pointer; }
        .btn-icon-edit { color: #b8860b; }
        .btn-icon-edit:hover { background: #fff3cd; color: #856404; transform: translateY(-1px); }
        .btn-icon-delete { color: #c0392b; }
        .btn-icon-delete:hover { background: #fde8e8; color: #922b21; transform: translateY(-1px); }

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

        .badge-status { display: inline-block; padding: 4px 12px; border-radius: 999px; font-size: 12px; font-weight: 600; }

        .modal-content { border-radius: 16px; border: none; }
        .modal-header { border-bottom: 1px solid #f0f0f0; padding: 20px 24px; }
        .modal-body { padding: 24px; }
        .modal-footer { border-top: 1px solid #f0f0f0; padding: 16px 24px; }
        .form-label { font-weight: 600; font-size: 13.5px; color: #333; }
        .form-control, .form-select { border-radius: 10px; border: 1.5px solid #d0e8e7; font-size: 13.5px; }
        .form-control:focus, .form-select:focus { border-color: #005654; box-shadow: 0 0 0 3px rgba(0,86,84,.1); }

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
        <a href="{{ route('master.layanan.index') }}" class="sidebar-link">
            <i class="bi bi-gear-fill"></i> Layanan
        </a>
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
        <a href="{{ route('master.doctor.index') }}" class="sidebar-link active-page">
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
        <div class="topbar-title">Daftar Dokter</div>
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


        <!-- Filter -->
        <div class="filter-bar mb-4">
            <form method="GET" action="{{ route('master.doctor.index') }}"
                  class="d-flex align-items-center gap-2 flex-wrap w-100">
                <div class="search-wrap">
                    <i class="bi bi-search"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama dokter...">
                </div>
                <select name="status" class="form-select" style="width:160px; height:38px; border-radius:10px; border:1.5px solid #d0e8e7; font-size:13.5px;">
                    <option value="">Semua Status</option>
                    <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                </select>
                <button type="submit" class="btn-search"><i class="bi bi-search"></i> Cari</button>
                @if(request('search') || request('status'))
                    <a href="{{ route('master.doctor.index') }}" class="btn-reset"><i class="bi bi-x-circle"></i> Reset</a>
                @endif
                <div class="ms-auto">
                    <button type="button" class="btn-tambah" data-bs-toggle="modal" data-bs-target="#modalTambahDokter">
                        <i class="bi bi-plus-lg"></i> Tambah Dokter
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
                            <th>Nama Dokter</th>
                            <th>Spesialisasi</th>
                            <th>No. SIP</th>
                            <th>No. Telepon</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($doctors as $i => $doctor)
                        <tr>
                            <td style="color:#888; font-size:13px;">{{ $i + 1 }}</td>
                            <td style="font-weight:600;">{{ $doctor->nama_dokter }}</td>
                            <td>{{ $doctor->spesialisasi ?? '—' }}</td>
                            <td><code style="background:#f4f4f4; padding:2px 8px; border-radius:6px; font-size:12.5px;">{{ $doctor->no_sip ?? '—' }}</code></td>
                            <td>{{ $doctor->no_telepon ?? '—' }}</td>
                            <td class="text-center">
                                @if($doctor->is_active)
                                    <span class="badge-status" style="background:#d4edda; color:#155724;">Aktif</span>
                                @else
                                    <span class="badge-status" style="background:#f8d7da; color:#721c24;">Non-Aktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <button class="btn-icon btn-icon-edit" title="Edit"
                                        onclick="openEditDokter({{ $doctor->id }}, '{{ addslashes($doctor->nama_dokter) }}', '{{ addslashes($doctor->spesialisasi ?? '') }}', '{{ addslashes($doctor->no_sip ?? '') }}', '{{ addslashes($doctor->no_telepon ?? '') }}', {{ $doctor->is_active ? 1 : 0 }})">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('master.doctor.destroy', $doctor->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin hapus dokter {{ $doctor->nama_dokter }}?')">
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
                                    <i class="bi bi-hospital"></i>
                                    <p>Belum ada data dokter.</p>
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

<!-- MODAL: TAMBAH DOKTER -->
<div class="modal fade" id="modalTambahDokter" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('master.doctor.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" style="color:#005654;">Tambah Dokter Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Dokter <span style="color:red;">*</span></label>
                        <input type="text" name="nama_dokter" class="form-control" placeholder="contoh: dr. Budi Santoso, Sp.PD" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Spesialisasi</label>
                        <input type="text" name="spesialisasi" class="form-control" placeholder="contoh: Penyakit Dalam">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No. SIP <span style="color:#aaa; font-weight:400;">(Surat Izin Praktik)</span></label>
                        <input type="text" name="no_sip" class="form-control" placeholder="contoh: 503/SIP/2024/001">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="no_telepon" class="form-control" placeholder="contoh: 08123456789">
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch mt-1">
                            <input type="hidden" name="is_active" value="0">
                            <input class="form-check-input" type="checkbox" name="is_active" id="isActiveAdd" value="1" checked>
                            <label class="form-check-label" for="isActiveAdd" style="font-size:13.5px;">Aktif</label>
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

<!-- MODAL: EDIT DOKTER -->
<div class="modal fade" id="modalEditDokter" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form id="formEditDokter" method="POST">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" style="color:#005654;">Edit Data Dokter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Dokter <span style="color:red;">*</span></label>
                        <input type="text" name="nama_dokter" id="editNamaDokter" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Spesialisasi</label>
                        <input type="text" name="spesialisasi" id="editSpesialisasi" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No. SIP</label>
                        <input type="text" name="no_sip" id="editNoSip" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="no_telepon" id="editNoTelepon" class="form-control">
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Status</label>
                        <div class="form-check form-switch mt-1">
                            <input type="hidden" name="is_active" value="0">
                            <input class="form-check-input" type="checkbox" name="is_active" id="editIsActive" value="1">
                            <label class="form-check-label" for="editIsActive" style="font-size:13.5px;">Aktif</label>
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
<script>
function toggleSidebarDropdown(btn) {
    const dropdown = btn.closest('.sidebar-dropdown');
    dropdown.classList.toggle('open');
}

function openEditDokter(id, nama, spesialisasi, noSip, noTelepon, isActive) {
    document.getElementById('formEditDokter').action = '/master/doctor/' + id;
    document.getElementById('editNamaDokter').value = nama;
    document.getElementById('editSpesialisasi').value = spesialisasi;
    document.getElementById('editNoSip').value = noSip;
    document.getElementById('editNoTelepon').value = noTelepon;
    document.getElementById('editIsActive').checked = isActive === 1;
    bootstrap.Modal.getOrCreateInstance(document.getElementById('modalEditDokter')).show();
}
</script>
</body>
</html>
