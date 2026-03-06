<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Status Permintaan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(135deg, #e6f7f6, #f4fbfa);
    font-family:'Segoe UI',sans-serif;
    min-height:100vh;
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
    border-radius:18px;
    border:none;
    box-shadow:0 10px 25px rgba(0,0,0,.06);
}

/* ===== TABLE ===== */
.table thead{
    background:#006e6b;
    color:white;
}

/* ===== STATUS BADGE ===== */
.badge-status{
    padding:6px 14px;
    border-radius:20px;
    font-size:12px;
    font-weight:700;
    letter-spacing:.3px;
}
.status-pending{ background:#ffc107; color:#000; }
.status-proses{ background:#0dcaf0; color:#000; }
.status-selesai{ background:#198754; color:#fff; }

/* ===== BUTTON ===== */
.btn-download{
    background:#006e6b;
    color:white;
    border:none;
}
.btn-download:hover{
    background:#005a57;
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
                <div class="main-title">Layanan Pasien</div>
                <div class="sub-title">Sistem Informasi Rekam Medis</div>
            </div>
        </div>

        <!-- ===== USER NAV ===== -->
        <div class="d-flex align-items-center gap-3">

            <!-- AJUKAN -->
            <a href="{{ route('layanan.index') }}" 
               class="btn btn-outline-success btn-sm d-flex align-items-center gap-1">
                <i class="bi bi-plus-circle"></i> Ajukan
            </a>

            <!-- USER -->
            <div class="fw-semibold text-success">
                <i class="bi bi-person-circle"></i> {{ auth()->user()->name }}
            </div>

            <!-- LOGOUT -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm d-flex align-items-center gap-1">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>

        </div>

    </div>
</div>

<!-- ===== TABLE SECTION ===== -->
<div class="container my-5">
    <div class="card card-table p-4">

        <h4 class="fw-bold text-center mb-4" style="color:#006e6b;">
            Status Permintaan Layanan Saya
        </h4>

        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>No Permintaan</th>
                        <th>Layanan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($data as $row)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="fw-semibold">{{ $row->no_permintaan }}</td>
                        <td>
                            <span class="badge bg-info text-dark">
                                {{ $row->layanan }}
                            </span>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d M Y') }}</td>

                        <!-- STATUS -->
                        <td class="text-center">
                            @if($row->status=='pending')
                                <span class="badge-status status-pending">PENDING</span>
                            @elseif($row->status=='proses')
                                <span class="badge-status status-proses">DIPROSES</span>
                            @elseif($row->status=='selesai')
                                <span class="badge-status status-selesai">SELESAI</span>
                            @endif
                        </td>

                        <!-- AKSI -->
                        <td class="text-center d-flex justify-content-center gap-2">

                            <!-- DETAIL -->
                            <a href="{{ route('user.permintaan.show',$row->id) }}" 
                               class="btn btn-sm btn-info text-white d-flex align-items-center gap-1">
                                <i class="bi bi-eye"></i> Detail
                            </a>

                            <!-- DOWNLOAD -->
                            @if($row->status=='selesai')
                                <a href="{{ route('user.permintaan.download',$row->id) }}" 
                                   class="btn btn-sm btn-download d-flex align-items-center gap-1">
                                    <i class="bi bi-download"></i> Download
                                </a>
                            @else
                                <button class="btn btn-sm btn-secondary" disabled>
                                    Belum selesai
                                </button>
                            @endif

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Belum ada permintaan layanan
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