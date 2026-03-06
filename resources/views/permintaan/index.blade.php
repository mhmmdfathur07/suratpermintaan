<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Permintaan Layanan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body{
            font-family: 'Segoe UI', sans-serif;
            background:#f7faf9;
        }

        /* ===== TOP BAR ===== */
        .top-bar{
            background:#005654;
            height:36px;
        }

        /* ===== MAIN HEADER ===== */
        .main-header{
            background:white;
            box-shadow:0 4px 12px rgba(0,0,0,0.06);
            padding:14px 0;
        }
        .main-logo{
            height:45px;
            width:auto;
        }
        .main-title{
            font-size:20px;
            font-weight:800;
            color:#005654;
            line-height:1.1;
        }
        .sub-title{
            font-size:12px;
            color:#6b8f8a;
            font-weight:500;
        }

        /* ===== CARD TABLE ===== */
        .card-table{
            border-radius:16px;
            border:none;
            box-shadow:0 8px 20px rgba(0,0,0,0.05);
        }
        .table thead{
            background:#0fb9a7;
            color:white;
        }
        .search-box{
            max-width:260px;
        }
    </style>
</head>

<body>

<!-- ===== TOP BAR ===== -->
<div class="top-bar"></div>

<!-- ===== MAIN HEADER ===== -->
<div class="main-header">
    <div class="container d-flex justify-content-between align-items-center">

        <!-- Logo + Title -->
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('assets/logo.png') }}" class="main-logo" alt="Logo">
            <div>
                <div class="main-title">Data Permintaan Layanan</div>
                <div class="sub-title">Sistem Informasi Rekam Medis</div>
            </div>
        </div>

        <!-- USER + LOGOUT -->
        <div class="d-flex align-items-center gap-3">
            <div class="fw-semibold text-success">
                <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
            </div>

            <form method="POST" action="{{ url('/logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>

    </div>
</div>

<!-- ===== DATA TABLE SECTION ===== -->
<div class="container my-5">
    <div class="card card-table p-4">

        <!-- SEARCH + FILTER -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <form method="GET" action="{{ url('/permintaan') }}" 
                  class="d-flex gap-2 align-items-center">

                <!-- Search -->
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}" 
                       class="form-control search-box" 
                       placeholder="Cari data...">

                <!-- Filter Layanan -->
                <select name="layanan" class="form-select" style="max-width:220px;">
                    <option value="">Semua Layanan</option>
                    <option value="Surat Keterangan Rawat Inap" {{ request('layanan')=='Surat Keterangan Rawat Inap'?'selected':'' }}>
                        Surat Keterangan Rawat Inap
                    </option>
                    <option value="Surat Keterangan Rawat Jalan" {{ request('layanan')=='Surat Keterangan Rawat Jalan'?'selected':'' }}>
                        Surat Keterangan Rawat Jalan
                    </option>
                    <option value="Surat Kehilangan Akte Lahir" {{ request('layanan')=='Surat Kehilangan Akte Lahir'?'selected':'' }}>
                        Surat Kehilangan Akte Lahir
                    </option>
                </select>

                <!-- Filter Tanggal -->
                <input type="date" 
                       name="tanggal" 
                       value="{{ request('tanggal') }}" 
                       class="form-control"
                       style="max-width:180px;">

                <!-- Button -->
                <button class="btn btn-success d-flex align-items-center gap-1">
                    <i class="bi bi-search"></i> Cari
                </button>
            </form>
        </div>

        <!-- TABLE -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="text-center">
                    <tr>
                        <th>No Permintaan</th>
                        <th>Tanggal</th>
                        <th>Kode RM</th>
                        <th>Nama</th>
                        <th>Layanan</th>
                        <th>Nm. Penerima</th>
                        <th>Nm. Petugas RM</th>
                        <th>Cetak</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($data as $row)
                    <tr>
                        <td class="fw-semibold">{{ $row->no_permintaan }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d M Y') }}</td>
                        <td>{{ $row->kode_rm }}</td>
                        <td>{{ $row->nama }}</td>
                        <td><span class="badge bg-info text-dark">{{ $row->layanan }}</span></td>
                        <td>{{ $row->nm_penerima }}</td>
                        <td>{{ $row->nm_petugas_rm }}</td>

                        <!-- CETAK -->
                        <td class="text-center">
                            <a href="{{ route('permintaan.cetak',$row->id) }}" 
                               class="btn btn-sm btn-primary text-white" target="_blank">
                                <i class="bi bi-printer"></i>
                            </a>

                        <!-- UPDATE -->
                        <td class="text-center">
                            <a href="{{ route('permintaan.edit',$row->id) }}" 
                               class="btn btn-sm btn-warning text-white">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </td>

                        <!-- DELETE -->
                        <td class="text-center">
                            <form action="{{ route('permintaan.destroy',$row->id) }}" 
                                  method="POST"
                                  onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="11" class="text-center text-muted">
                            Data tidak tersedia
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

</body>
</html>