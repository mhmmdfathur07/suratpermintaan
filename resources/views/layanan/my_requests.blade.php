<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Status Permintaan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
    *, *::before, *::after { box-sizing: border-box; }
    body {
        font-family: 'Inter', sans-serif;
        background: linear-gradient(135deg, #e6f7f6, #f4fbfa);
        min-height: 100vh;
    }

    /* ── TOP BAR ── */
    .top-bar { background: #005654; height: 36px; }

    /* ── HEADER ── */
    .main-header {
        background: #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,.06);
        padding: 16px 0;
    }
    .main-logo { height: 45px; width: auto; }
    .main-title { font-size: 20px; font-weight: 800; color: #005654; line-height: 1.1; }
    .sub-title { font-size: 12px; color: #6b8f8a; font-weight: 500; }
    .header-actions { display: flex; align-items: center; gap: 16px; }
    .user-info {
        display: flex; align-items: center; gap: 8px;
        padding: 8px 16px; background: #f0f9f8;
        border-radius: 10px; color: #005654;
        font-weight: 600; font-size: 14px;
    }
    .user-info i { font-size: 18px; }
    .btn-nav {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 5px 14px; border-radius: 12px;
        font-size: 13px; font-weight: 500;
        text-decoration: none; transition: all .2s;
        border: 1px solid #d0d0d0; color: #555; background: transparent;
    }
    .btn-nav:hover {
        border-color: #005654; color: #005654;
        background: #f0f9f8; transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,86,84,.1);
    }
    .btn-nav.active { background: #005654; color: #fff; border-color: #005654; font-weight: 600; }
    .btn-nav.active:hover { background: #007a77; border-color: #007a77; }
    .divider-v { width: 1px; height: 28px; background: #d8d8d8; margin: 0 4px; }
    .btn-logout { padding: 8px 14px; font-weight: 600; border-radius: 10px; transition: all .2s; }
    .btn-logout:hover { transform: translateY(-1px); box-shadow: 0 4px 8px rgba(220,53,69,.3); }

    /* ── FILTER BAR ── */
    .filter-bar {
        background: #fff;
        border-radius: 14px;
        padding: 16px 20px;
        box-shadow: 0 2px 12px rgba(0,0,0,.05);
        display: flex; align-items: center; gap: 10px; flex-wrap: wrap;
    }
    .search-wrap { position: relative; }
    .search-wrap .bi-search {
        position: absolute; left: 12px; top: 50%;
        transform: translateY(-50%); color: #aaa; font-size: 14px;
        pointer-events: none;
    }
    .search-wrap input {
        padding-left: 36px; border-radius: 10px;
        border: 1.5px solid #d0e8e7; height: 38px;
        font-size: 13.5px; width: 240px;
        transition: border-color .2s, box-shadow .2s;
    }
    .search-wrap input:focus {
        border-color: #005654;
        box-shadow: 0 0 0 3px rgba(0,86,84,.1);
        outline: none;
    }
    .date-wrap { position: relative; display: inline-flex; align-items: center; }
    .date-wrap .date-placeholder {
        position: absolute; left: 12px; color: #aaa;
        font-size: 13px; pointer-events: none; white-space: nowrap;
    }
    .date-wrap input[type="date"] {
        border-radius: 10px; border: 1.5px solid #d0e8e7;
        height: 38px; font-size: 13.5px; width: 170px;
        padding: 0 12px; transition: border-color .2s, box-shadow .2s;
    }
    .date-wrap input[type="date"]:focus {
        border-color: #005654;
        box-shadow: 0 0 0 3px rgba(0,86,84,.1);
        outline: none;
    }
    .btn-search {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 18px; background: #005654; color: #fff;
        font-size: 13.5px; font-weight: 600; border-radius: 10px;
        border: none; cursor: pointer; transition: background .2s, transform .15s;
    }
    .btn-search:hover { background: #007a77; transform: translateY(-1px); }
    .btn-reset {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 14px; border-radius: 10px;
        font-size: 13.5px; font-weight: 500;
        border: 1.5px solid #d0d0d0; color: #666;
        background: #fff; text-decoration: none;
        transition: all .2s;
    }
    .btn-reset:hover { border-color: #005654; color: #005654; background: #f0f9f8; }

    /* ── TABLE CARD ── */
    .table-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,.06);
        overflow: hidden;
    }
    .table { margin-bottom: 0; }
    .table thead th {
        background: #005654; color: #fff;
        font-size: 12px; font-weight: 600;
        letter-spacing: .4px; text-transform: uppercase;
        padding: 14px 18px; border: none;
        white-space: nowrap;
    }
    .table thead th:first-child { border-radius: 0; }
    .table tbody td {
        padding: 14px 18px;
        vertical-align: middle;
        border-bottom: 1px solid #f3f3f3;
        font-size: 13.5px; color: #2d2d2d;
    }
    .table tbody tr:last-child td { border-bottom: none; }
    .table tbody tr { transition: background .15s; }
    .table tbody tr:hover { background: #f7fdfc; }

    /* ── CELLS ── */
    .cell-no-req { font-weight: 700; color: #1a4a8a; font-size: 13px; }
    .cell-muted { color: #888; font-size: 13px; }

    /* ── BADGE LAYANAN ── */
    .badge-layanan {
        display: inline-block; padding: 4px 12px;
        border-radius: 999px; font-size: 12px; font-weight: 600;
        background: #e8f4ff; color: #1a6fb5; white-space: nowrap;
    }

    /* ── BADGE STATUS ── */
    .badge-status {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 5px 12px; border-radius: 999px;
        font-size: 12px; font-weight: 700; letter-spacing: .3px;
        white-space: nowrap;
    }
    .badge-status .dot {
        width: 6px; height: 6px; border-radius: 50%;
        display: inline-block; flex-shrink: 0;
    }
    .status-pending  { background: #fff8e1; color: #b8860b; }
    .status-pending .dot  { background: #f0ad00; }
    .status-proses   { background: #e8f0fe; color: #1a56db; }
    .status-proses .dot   { background: #3b82f6; }
    .status-selesai  { background: #e6f4ea; color: #1a7a3c; }
    .status-selesai .dot  { background: #22c55e; }
    .status-ditolak  { background: #fde8e8; color: #c0392b; }
    .status-ditolak .dot  { background: #ef4444; }

    /* ── ACTION BUTTONS ── */
    .btn-action {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 6px 14px; border-radius: 8px;
        font-size: 12.5px; font-weight: 600;
        text-decoration: none; border: none; cursor: pointer;
        transition: all .2s; white-space: nowrap;
    }
    .btn-detail {
        background: #e8f4ff; color: #1a6fb5;
    }
    .btn-detail:hover { background: #cce4ff; color: #0d4f8a; transform: translateY(-1px); }
    .btn-dl {
        background: #005654; color: #fff;
    }
    .btn-dl:hover { background: #007a77; color: #fff; transform: translateY(-1px); box-shadow: 0 4px 10px rgba(0,86,84,.2); }
    .btn-disabled {
        background: #f0f0f0; color: #aaa; cursor: not-allowed;
    }

    /* ── EMPTY STATE ── */
    .empty-state {
        padding: 60px 20px; text-align: center; color: #aaa;
    }
    .empty-state i { font-size: 48px; margin-bottom: 12px; display: block; color: #c8e6e5; }
    .empty-state p { font-size: 14px; margin: 0; }

    /* ── PAGINATION ── */
    .pagination .page-link {
        border-radius: 8px; margin: 0 2px;
        border: 1.5px solid #d0e8e7; color: #005654;
        font-size: 13px; font-weight: 500;
    }
    .pagination .page-item.active .page-link {
        background: #005654; border-color: #005654; color: #fff;
    }
    .pagination .page-link:hover { background: #f0f9f8; }
</style>
</head>
<body>

<div class="top-bar"></div>

<!-- HEADER -->
<div class="main-header">
    <div class="container-fluid px-5 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('assets/logo.png') }}" class="main-logo" alt="Logo">
            <div>
                <div class="main-title">Layanan Pasien</div>
                <div class="sub-title">Sistem Informasi Rekam Medis</div>
            </div>
        </div>
        <div class="header-actions">
            <div class="dropdown">
                <button class="btn-nav dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-grid-3x3-gap-fill"></i> Menu
                </button>
                <ul class="dropdown-menu dropdown-menu-end" style="border-radius:12px; box-shadow:0 8px 24px rgba(0,0,0,.1); border:1px solid #f0f0f0; min-width:180px;">
                    <li><a class="dropdown-item" href="{{ route('layanan.index') }}"><i class="bi bi-plus-circle me-2 text-muted"></i>Ajukan Layanan</a></li>
                    <li><a class="dropdown-item" href="{{ route('user.permintaan') }}"><i class="bi bi-list-check me-2 text-muted"></i>History Permintaan</a></li>
                </ul>
            </div>
            <div class="divider-v"></div>
            <div class="user-info">
                <i class="bi bi-person-circle"></i>
                <span>{{ auth()->user()->name }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-logout">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>
</div>

<!-- CONTENT -->
<div class="container-fluid px-4 px-md-5 py-4">

    <!-- Filter bar -->
    <div class="filter-bar mb-4">
        <form method="GET" action="{{ route('user.permintaan') }}"
              class="d-flex align-items-center gap-2 flex-wrap w-100">

            <div class="search-wrap">
                <i class="bi bi-search"></i>
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="Cari no, nama, layanan...">
            </div>

            <select name="layanan" class="form-select" style="width:200px; height:38px; border-radius:10px; border:1.5px solid #d0e8e7; font-size:13.5px; color: {{ request('layanan') ? '#212529' : '#aaa' }};"
                    onchange="this.style.color='#212529'">
                <option value="">-- Semua Layanan --</option>
                @foreach($layanans as $layanan)
                    <option value="{{ $layanan->nama_layanan }}"
                        {{ request('layanan') == $layanan->nama_layanan ? 'selected' : '' }}>
                        {{ $layanan->nama_layanan }}
                    </option>
                @endforeach
            </select>

            <div class="date-wrap">
                @if(!request('tgl_pengajuan'))
                    <span class="date-placeholder">Tgl. Pengajuan</span>
                @endif
                <input type="date" name="tgl_pengajuan" value="{{ request('tgl_pengajuan') }}"
                       style="{{ !request('tgl_pengajuan') ? 'color:transparent;' : '' }}"
                       onfocus="this.style.color=''; this.previousElementSibling && (this.previousElementSibling.style.display='none')"
                       onblur="if(!this.value){ this.style.color='transparent'; this.previousElementSibling && (this.previousElementSibling.style.display='') }">
            </div>

            <div class="date-wrap">
                @if(!request('tgl_dibuat'))
                    <span class="date-placeholder">Tgl. Dibuat</span>
                @endif
                <input type="date" name="tgl_dibuat" value="{{ request('tgl_dibuat') }}"
                       style="{{ !request('tgl_dibuat') ? 'color:transparent;' : '' }}"
                       onfocus="this.style.color=''; this.previousElementSibling && (this.previousElementSibling.style.display='none')"
                       onblur="if(!this.value){ this.style.color='transparent'; this.previousElementSibling && (this.previousElementSibling.style.display='') }">
            </div>

            <button type="submit" class="btn-search">
                <i class="bi bi-search"></i> Cari
            </button>

            @if(request('search') || request('layanan') || request('tgl_pengajuan') || request('tgl_dibuat'))
                <a href="{{ route('user.permintaan') }}" class="btn-reset">
                    <i class="bi bi-x-circle"></i> Reset
                </a>
            @endif

        </form>
    </div>

    <!-- Table -->
    <div class="table-card">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th class="text-center" style="width:48px;">No</th>
                        <th>No Permintaan</th>
                        <th>Nama Pasien</th>
                        <th>No Rekam Medis</th>
                        <th>Layanan</th>
                        <th>Tgl. Pengajuan</th>
                        <th class="text-center">Status</th>
                        <th>Tgl. Dibuat</th>
                        <th>Petugas RM</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($data as $row)
                    <tr>
                        <td class="text-center cell-muted">{{ $loop->iteration }}</td>
                        <td class="cell-no-req">{{ $row->no_permintaan }}</td>
                        <td>{{ $row->nama }}</td>
                        <td class="cell-muted">{{ $row->kode_rm }}</td>
                        <td>
                            <span class="badge-layanan">{{ $row->layanan }}</span>
                        </td>
                        <td class="cell-muted">
                            {{ \Carbon\Carbon::parse($row->tanggal)->format('d/m/Y') }}
                            <div style="font-size:11px; color:#bbb;">{{ \Carbon\Carbon::parse($row->tanggal)->format('H:i') }}</div>
                        </td>
                        <td class="text-center">
                            @php $s = $row->status ?? 'pending'; @endphp
                            <span class="badge-status status-{{ $s }}">
                                <span class="dot"></span>
                                {{ ['pending'=>'Pending','proses'=>'Diproses','selesai'=>'Selesai','ditolak'=>'Ditolak'][$s] ?? $s }}
                            </span>
                        </td>
                        <td class="cell-muted">
                            @if($row->tgl_dibuat)
                                {{ \Carbon\Carbon::parse($row->tgl_dibuat)->format('d/m/Y') }}
                                <div style="font-size:11px; color:#bbb;">{{ \Carbon\Carbon::parse($row->tgl_dibuat)->format('H:i') }}</div>
                            @else
                                <span style="color:#ccc;">—</span>
                            @endif
                        </td>
                        <td class="cell-muted">{{ $row->nm_petugas_rm ?? '—' }}</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <a href="{{ route('user.permintaan.show', $row->id) }}"
                                   class="btn-action btn-detail">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                                @if($row->status == 'selesai')
                                    <a href="{{ route('user.permintaan.download', $row->id) }}"
                                       target="_blank" rel="noopener noreferrer"
                                       class="btn-action btn-dl">
                                        <i class="bi bi-download"></i> Unduh
                                    </a>
                                @else
                                    <span class="btn-action btn-disabled">
                                        <i class="bi bi-clock"></i> Menunggu
                                    </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <p>Belum ada permintaan layanan yang diajukan.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if(method_exists($data, 'links'))
        <div class="d-flex justify-content-end mt-3">
            {{ $data->links() }}
        </div>
    @endif

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
