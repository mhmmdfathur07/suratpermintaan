<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pengajuan Layanan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

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

/* ── FORM CARD ── */
.form-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,.06);
    overflow: hidden;
}
.form-card-header {
    padding: 18px 28px;
    border-bottom: 1px solid #f0f0f0;
    display: flex; align-items: center; gap: 10px;
}
.form-card-header .section-icon {
    width: 34px; height: 34px; border-radius: 9px;
    background: #e8f5f4; color: #005654;
    display: flex; align-items: center; justify-content: center;
    font-size: 16px;
}
.form-card-header .section-title { font-size: 14px; font-weight: 700; color: #1a2e2d; }
.form-card-header .section-desc  { font-size: 12px; color: #7a9e9c; margin-top: 1px; }
.form-card-body { padding: 28px; }

/* ── FIELDS ── */
.field-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 20px; }
.field-group:last-child { margin-bottom: 0; }
.field-group label {
    font-size: 12.5px; font-weight: 600; color: #4a6a68;
}
.field-group .form-control,
.field-group .form-select {
    border: 1.5px solid #dde6e5;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 14px;
    color: #1a2e2d;
    background: #fafcfc;
    transition: border-color .18s, box-shadow .18s;
}
.field-group .form-control:focus,
.field-group .form-select:focus {
    border-color: #005654;
    box-shadow: 0 0 0 3px rgba(0,86,84,.08);
    background: #fff;
    outline: none;
}
.field-group textarea.form-control { resize: vertical; min-height: 90px; }

.form-row-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.form-row-4 {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
}

/* ── SELECT2 ── */
.select2-container .select2-selection--single {
    height: 42px !important;
    border: 1.5px solid #dde6e5 !important;
    border-radius: 10px !important;
    background: #fafcfc !important;
    display: flex; align-items: center; padding: 0 14px;
}
.select2-container--default.select2-container--focus .select2-selection--single {
    border-color: #005654 !important;
    box-shadow: 0 0 0 3px rgba(0,86,84,.08) !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 40px !important; color: #1a2e2d; padding: 0;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 40px !important; right: 10px;
}
.select2-dropdown {
    border: 1.5px solid #dde6e5 !important;
    border-radius: 10px !important;
    box-shadow: 0 8px 24px rgba(0,0,0,.1) !important;
    overflow: hidden;
}
.select2-container--default .select2-results__option--highlighted {
    background: #005654 !important;
}

/* ── SUBMIT ── */
.form-footer {
    padding: 20px 28px;
    border-top: 1px solid #f0f0f0;
    display: flex; align-items: center; justify-content: flex-end; gap: 10px;
}
.btn-cancel {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 9px 20px; border-radius: 10px;
    font-size: 13.5px; font-weight: 600;
    border: 1.5px solid #d0d8d7; color: #5a7a78;
    background: #fff; cursor: pointer; transition: all .18s;
    text-decoration: none;
}
.btn-cancel:hover { border-color: #005654; color: #005654; background: #f0f9f8; }
.btn-submit {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 9px 28px; border-radius: 10px;
    font-size: 13.5px; font-weight: 700;
    background: #005654; color: #fff; border: none;
    cursor: pointer; transition: all .18s;
}
.btn-submit:hover { background: #007a77; box-shadow: 0 6px 16px rgba(0,86,84,.25); transform: translateY(-1px); }
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
<div class="container py-4" style="max-width: 1200px;">

    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2 mb-4" style="border-radius:10px;">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger mb-4" style="border-radius:10px;">
            <div class="fw-semibold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i>Terdapat kesalahan:</div>
            <ul class="mb-0 ps-3">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('layanan.store') }}" id="mainForm">
        @csrf

        <div class="d-flex gap-4 align-items-stretch">

            <!-- JENIS LAYANAN (kiri) -->
            <div class="form-card d-flex flex-column" style="flex: 1;">
                <div class="form-card-header">
                    <div class="section-icon"><i class="bi bi-grid-3x3-gap"></i></div>
                    <div>
                        <div class="section-title">Jenis Layanan</div>
                        <div class="section-desc">Pilih layanan yang sesuai kebutuhan</div>
                    </div>
                </div>
                <div class="form-card-body">
                    <div class="field-group">
                        <label for="layananSelect">Jenis Layanan <span class="text-danger">*</span></label>
                        <select name="layanan" id="layananSelect" class="select2" required>
                            <option value="">-- Pilih Layanan --</option>
                            @foreach($layanans as $layanan)
                                <option value="{{ $layanan->nama_layanan }}">{{ $layanan->nama_layanan }}</option>
                            @endforeach
                            <option value="lain-lain">Lain-lain</option>
                        </select>
                    </div>
                    <div class="field-group" id="layananLainWrapper" style="display:none;">
                        <label for="layananLain">Sebutkan Layanan <span class="text-danger">*</span></label>
                        <input type="text" name="layanan_lain" id="layananLain" class="form-control"
                            placeholder="Tuliskan jenis layanan yang dibutuhkan">
                    </div>
                </div>
            </div>

            <!-- DATA PASIEN (kanan) -->
            <div class="form-card d-flex flex-column" style="flex: 2;">
                <div class="form-card-header">
                    <div class="section-icon"><i class="bi bi-person-vcard"></i></div>
                    <div>
                        <div class="section-title">Data Pasien</div>
                        <div class="section-desc">Masukkan data diri pasien dengan benar</div>
                    </div>
                </div>
                <div class="form-card-body">
                    <div class="form-row-2">
                        <div class="field-group">
                            <label for="kode_rm">No. Rekam Medis <span class="text-danger">*</span></label>
                            <input type="text" name="kode_rm" id="kode_rm" class="form-control"
                                placeholder="RM-001234" required>
                        </div>
                        <div class="field-group">
                            <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama" id="nama" class="form-control"
                                placeholder="Nama lengkap" required>
                        </div>
                        <div class="field-group">
                            <label for="umur">Umur <span class="text-danger">*</span></label>
                            <input type="number" name="umur" id="umur" class="form-control"
                                placeholder="Tahun" min="0" required>
                        </div>
                        <div class="field-group">
                            <label for="no_telepon">No. Telepon</label>
                            <input type="tel" name="no_telepon" id="no_telepon" class="form-control"
                                placeholder="08123456789">
                        </div>
                    </div>
                    <div class="field-group">
                        <label for="alamat">Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea name="alamat" id="alamat" class="form-control"
                            placeholder="Jalan, kelurahan, kecamatan, kota..." required></textarea>
                    </div>
                    <div>
                        <button type="submit" class="btn-submit">
                            <i class="bi bi-send-fill"></i> Kirim Pengajuan
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function () {
    $('#layananSelect').select2({
        placeholder: 'Cari atau pilih layanan...',
        allowClear: true,
        width: '100%'
    });

    $('#layananSelect').on('change', function () {
        var val = $(this).val();
        if (val === 'lain-lain') {
            $('#layananLainWrapper').show();
            $('#layananLain').attr('required', true);
            $('#layananHidden').val('lain-lain');
        } else {
            $('#layananLainWrapper').hide();
            $('#layananLain').removeAttr('required').val('');
            $('#layananHidden').val(val);
        }
    });

    $('#mainForm').on('submit', function (e) {
        var val = $('#layananSelect').val();
        if (val === 'lain-lain') {
            var custom = $('#layananLain').val().trim();
            if (!custom) {
                e.preventDefault();
                alert('Harap isi nama layanan terlebih dahulu.');
                return false;
            }
            // kirim 'lain-lain' di layanan, teks kustom di layanan_lain (sudah ada di input)
            $('#layananHidden').val('lain-lain');
        } else {
            $('#layananHidden').val(val);
        }
    });
});
</script>
</body>
</html>
