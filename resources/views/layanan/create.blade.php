<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pengajuan Layanan</title>

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

/* ===== FORM CARD ===== */
.card-form{
    max-width:600px;
    margin:auto;
    margin-top:60px;
    border-radius:18px;
    box-shadow:0 10px 25px rgba(0,0,0,.06);
    border:none;
}
.form-title{
    font-weight:800;
    color:#006e6b;
}
.btn-submit{
    background:#006e6b;
    border:none;
    padding:12px;
    font-weight:600;
}
.btn-submit:hover{
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

            <!-- PROGRES -->
            <a href="{{ route('user.permintaan') }}" 
               class="btn btn-success btn-sm d-flex align-items-center gap-1">
                <i class="bi bi-list-check"></i> Progres
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

<!-- ===== FORM SECTION ===== -->
<div class="container">
    <div class="card card-form p-4">

        <h4 class="form-title mb-4 text-center">Form Pengajuan Layanan</h4>

        {{-- Alert Success --}}
        @if(session('success'))
            <div class="alert alert-success text-center">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Alert Error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('layanan.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Jenis Layanan</label>
                <select name="layanan" class="form-select" required>
                    <option value="">-- Pilih Layanan --</option>
                    <option value="Surat Keterangan Rawat Inap">Surat Keterangan Rawat Inap</option>
                    <option value="Surat Keterangan Rawat Jalan">Surat Keterangan Rawat Jalan</option>
                    <option value="Surat Kehilangan Akte Lahir">Surat Kehilangan Akte Lahir</option>
                </select>
            </div>

                <!-- NAMA -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" 
                        placeholder="Masukkan nama lengkap" required>
                </div>

                <!-- UMUR -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Umur</label>
                    <input type="number" name="umur" class="form-control" 
                        placeholder="Masukkan umur" min="0" required>
                </div>

                <!-- NO RM -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">No Rekam Medis</label>
                    <input type="text" name="kode_rm" class="form-control" 
                        placeholder="Masukkan nomor rekam medis" required>
                </div>

                <!-- ALAMAT -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="3"
                            placeholder="Masukkan alamat lengkap" required></textarea>
                </div>

                <!-- BUTTON -->
                <button type="submit" class="btn btn-submit w-100 text-white">
                    <i class="bi bi-send"></i> Kirim Pengajuan
                </button>


                    </form>
                </div>
            </div>

</body>
</html>