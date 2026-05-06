<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Entri Transaksi Korespondensi Pasien</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<style>
*, *::before, *::after { box-sizing: border-box; }
body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #e6f7f6, #f4fbfa); min-height: 100vh; }

/* TOP BAR */
.top-bar { background: #005654; height: 36px; }
.main-header { background: #fff; box-shadow: 0 4px 12px rgba(0,0,0,.06); padding: 12px 0; }
.main-logo { height: 40px; }
.main-title { font-size: 18px; font-weight: 800; color: #005654; }
.sub-title { font-size: 11px; color: #6b8f8a; }
.btn-nav {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 5px 13px; border-radius: 12px; font-size: 12.5px; font-weight: 500;
    text-decoration: none; border: 1px solid #d0d0d0; color: #555; background: transparent; transition: all .2s;
}
.btn-nav:hover { border-color: #005654; color: #005654; background: #f0f9f8; transform: translateY(-1px); box-shadow: 0 4px 8px rgba(0,86,84,.1); }
.btn-nav.active { background: #005654; color: #fff; border-color: #005654; font-weight: 600; }
.btn-nav.active:hover { background: #007a77; border-color: #007a77; }
.user-info {
    display: flex; align-items: center; gap: 7px; padding: 6px 14px;
    background: #f0f9f8; border-radius: 9px; color: #005654; font-weight: 600; font-size: 13px;
}
.btn-logout { padding: 7px 13px; font-weight: 600; border-radius: 9px; }

/* WINDOW CHROME */
.win-wrapper { max-width: 900px; margin: 24px auto; }
.win-titlebar {
    background: linear-gradient(to right, #005654, #007a77);
    color: #fff; padding: 7px 14px;
    border-radius: 12px 12px 0 0;
    display: flex; align-items: center; justify-content: space-between;
    font-size: 13px; font-weight: 600;
}
.win-titlebar .win-btns { display: flex; gap: 5px; }
.win-btn { width: 13px; height: 13px; border-radius: 50%; border: 1px solid rgba(0,0,0,.15); cursor: pointer; }
.win-btn.close { background: #e05c5c; }
.win-btn.min   { background: #f0c040; }
.win-btn.max   { background: #5cb85c; }

.win-body {
    background: #f4fbfa;
    border: 1px solid #b8dbd9;
    border-top: none;
    border-radius: 0 0 12px 12px;
    padding: 0;
    box-shadow: 0 4px 20px rgba(0,86,84,.08);
}

/* TOP INFO BAR */
.info-bar {
    background: #e8f5f4;
    border-bottom: 1px solid #c8e6e4;
    padding: 7px 16px;
    display: flex; align-items: center; gap: 20px; flex-wrap: wrap;
}
.info-bar-item { display: flex; align-items: center; gap: 6px; font-size: 12.5px; }
.info-bar-item label { font-weight: 600; color: #005654; white-space: nowrap; margin: 0; }
.info-bar-item .val-box {
    background: #fff; border: 1px solid #a8d0ce;
    border-radius: 6px; padding: 2px 10px;
    font-size: 12.5px; font-weight: 600; color: #1a2e2d;
    min-width: 140px;
}
.info-bar-item .val-box.new-badge {
    background: #fffbe6; color: #8a6000; border-color: #d4b000; font-style: italic;
}
.info-bar-item input[type="date"] {
    background: #fff; border: 1px solid #a8d0ce; border-radius: 6px;
    padding: 2px 8px; font-size: 12.5px; color: #1a2e2d;
}

/* FORM SECTIONS */
.form-section {
    background: #fff;
    border: 1px solid #c8e0de;
    border-radius: 8px;
    margin: 10px 14px;
}
.form-section-header {
    background: linear-gradient(to right, #e8f5f4, #f0f9f8);
    border-bottom: 1px solid #c8e0de;
    padding: 6px 14px;
    font-size: 12px; font-weight: 700; color: #005654;
    border-radius: 8px 8px 0 0;
}

/* FIELD ROWS */
.field-row {
    display: flex; align-items: center;
    padding: 5px 14px; gap: 8px;
    border-bottom: 1px solid #f0f7f6;
}
.field-row:last-child { border-bottom: none; }
.field-row label {
    font-size: 12px; font-weight: 600; color: #4a6a68;
    min-width: 130px; margin: 0; white-space: nowrap;
}
.field-row .field-input {
    flex: 1;
    background: #fafcfc; border: 1.5px solid #c8e0de;
    border-radius: 7px; padding: 4px 10px;
    font-size: 12.5px; color: #1a2e2d;
    transition: border-color .15s, box-shadow .15s;
}
.field-row .field-input:focus {
    border-color: #005654; outline: none;
    box-shadow: 0 0 0 3px rgba(0,86,84,.08);
    background: #fff;
}
.field-row .field-input::placeholder { color: #b0cece; }
.field-row .field-input.short { max-width: 90px; }
.field-row .field-input.medium { max-width: 180px; }
.field-row .field-input.wide { max-width: 320px; }

/* INLINE PAIR */
.field-pair { display: flex; align-items: center; gap: 16px; flex: 1; }
.field-pair .sub-label { font-size: 12px; font-weight: 600; color: #4a6a68; white-space: nowrap; }

/* TABS */
.tab-bar {
    display: flex; gap: 0;
    padding: 10px 14px 0;
    border-bottom: 2px solid #c8e0de;
}
.tab-btn {
    padding: 5px 20px; font-size: 12.5px; font-weight: 600;
    border: 1.5px solid #c8e0de; border-bottom: none;
    background: #e8f5f4; color: #4a6a68;
    cursor: pointer; border-radius: 8px 8px 0 0;
    margin-right: 3px; transition: background .15s;
}
.tab-btn.active { background: #fff; color: #005654; border-color: #c8e0de; border-bottom: 2px solid #fff; margin-bottom: -2px; }
.tab-content { display: none; }
.tab-content.active { display: block; }

/* SELECT2 override */
.select2-container .select2-selection--single {
    height: 30px !important; border: 1.5px solid #c8e0de !important;
    border-radius: 7px !important; background: #fafcfc !important;
    display: flex; align-items: center; padding: 0 10px;
}
.select2-container--default.select2-container--focus .select2-selection--single {
    border-color: #005654 !important; box-shadow: 0 0 0 3px rgba(0,86,84,.08) !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 28px !important; font-size: 12.5px; color: #1a2e2d; padding: 0;
}
.select2-container--default .select2-selection--single .select2-selection__arrow { height: 28px !important; }
.select2-dropdown { border: 1.5px solid #c8e0de !important; border-radius: 8px !important; font-size: 12.5px; box-shadow: 0 8px 24px rgba(0,0,0,.1) !important; }
.select2-container--default .select2-results__option--highlighted { background: #005654 !important; }

/* BOTTOM ACTIONS */
.win-footer {
    background: #e8f5f4;
    border-top: 1px solid #c8e0de;
    padding: 10px 16px;
    display: flex; gap: 8px; align-items: center;
    border-radius: 0 0 12px 12px;
}
.btn-action {
    padding: 6px 20px; font-size: 12.5px; font-weight: 600;
    border-radius: 8px; border: 1.5px solid #c8e0de;
    background: #fff; color: #4a6a68; cursor: pointer; transition: all .15s;
    text-decoration: none; display: inline-flex; align-items: center; gap: 5px;
}
.btn-action:hover { border-color: #005654; color: #005654; background: #f0f9f8; }
.btn-action.primary { background: #005654; color: #fff; border-color: #005654; }
.btn-action.primary:hover { background: #007a77; box-shadow: 0 4px 12px rgba(0,86,84,.25); }

/* SEARCH ICON BUTTON */
.btn-search {
    background: #e8f5f4; border: 1.5px solid #c8e0de;
    border-radius: 7px; padding: 3px 9px; cursor: pointer;
    font-size: 11px; color: #005654; transition: background .15s;
}
.btn-search:hover { background: #d0eeec; }
</style>
</head>
<body>
<div class="top-bar"></div>

<!-- HEADER -->
<div class="main-header">
    <div class="container-fluid px-4 d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center gap-3">
            <img src="{{ asset('assets/logo.png') }}" class="main-logo" alt="Logo">
            <div>
                <div class="main-title">Layanan Pasien</div>
                <div class="sub-title">Sistem Informasi Rekam Medis</div>
            </div>
        </div>
        <div class="d-flex align-items-center gap-3">
            <a href="{{ route('layanan.index') }}" class="btn-nav active"><i class="bi bi-plus-circle"></i> Ajukan Layanan</a>
            <a href="{{ route('user.permintaan') }}" class="btn-nav"><i class="bi bi-list-check"></i> History Permintaan</a>
            <div class="user-info"><i class="bi bi-person-circle"></i> {{ auth()->user()->name }}</div>
            <form method="POST" action="{{ route('logout') }}" class="m-0">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-logout"><i class="bi bi-box-arrow-right"></i></button>
            </form>
        </div>
    </div>
</div>

<!-- ALERTS -->
<div class="win-wrapper">
    @if(session('success'))
        <div class="alert alert-success d-flex align-items-center gap-2 mb-3" style="border-radius:6px; font-size:13px;">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger mb-3" style="border-radius:6px; font-size:13px;">
            <i class="bi bi-exclamation-triangle-fill me-1"></i>
            @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('layanan.store') }}" id="mainForm">
    @csrf

    <!-- WINDOW -->
    <div class="win-titlebar">
        <span><i class="bi bi-file-earmark-text me-2"></i>Entri Transaksi Korespondensi Pasien</span>
        <div class="win-btns">
            <div class="win-btn close"></div>
            <div class="win-btn min"></div>
            <div class="win-btn max"></div>
        </div>
    </div>

    <div class="win-body">

        <!-- TOP INFO BAR -->
        <div class="info-bar">
            <div class="info-bar-item">
                <label>No. Bukti</label>
                <div class="val-box" id="noBuktiDisplay">KOR{{ date('ymd') }}{{ str_pad(rand(1,999), 3, '0', STR_PAD_LEFT) }}</div>
            </div>
            <div class="info-bar-item">
                <div class="val-box new-badge">*** Data Baru</div>
            </div>
            <div class="info-bar-item ms-auto">
                <label>Tanggal Permintaan</label>
                <input type="date" name="tanggal_permintaan" value="{{ date('Y-m-d') }}" readonly style="background:#fff;">
            </div>
        </div>

        <!-- DATA PASIEN -->
        <div class="form-section mx-3 mt-3">
            <div class="form-section-header"><i class="bi bi-person-vcard me-1"></i>Data Pasien</div>

            <div class="field-row">
                <label>No. RM</label>
                <input type="text" name="kode_rm" id="kodeRm" class="field-input medium" placeholder="Cari No. RM..." value="{{ old('kode_rm') }}">
                <button type="button" class="btn-search" onclick="cariRM()"><i class="bi bi-search"></i></button>
                <div class="field-pair ms-3">
                    <span class="sub-label">Umur</span>
                    <input type="number" name="umur" id="umurInput" class="field-input short" placeholder="Thn" min="0" value="{{ old('umur') }}">
                </div>
            </div>

            <div class="field-row">
                <label>Nama Pasien</label>
                <input type="text" name="nama" id="namaInput" class="field-input wide" placeholder="Nama lengkap pasien" value="{{ old('nama') }}">
                <div class="field-pair ms-3">
                    <span class="sub-label">Jenis Kelamin</span>
                    <select name="jenis_kelamin" id="jenisKelaminInput" class="field-input medium">
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin')=='Laki-laki'?'selected':'' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin')=='Perempuan'?'selected':'' }}>Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="field-row">
                <label>Tempat/Tgl Lahir</label>
                <input type="text" name="tempat_lahir" class="field-input medium" placeholder="Kota lahir" value="{{ old('tempat_lahir') }}">
                <input type="date" name="tgl_lahir" class="field-input medium ms-2" value="{{ old('tgl_lahir') }}">
            </div>

            <div class="field-row">
                <label>Alamat</label>
                <input type="text" name="alamat" class="field-input" placeholder="Alamat lengkap pasien" value="{{ old('alamat') }}">
            </div>

            <div class="field-row">
                <label>No. Telp</label>
                <input type="tel" name="no_telepon" class="field-input medium" placeholder="No. Telepon" value="{{ old('no_telepon') }}">
                <div class="field-pair ms-3">
                    <span class="sub-label">HP</span>
                    <input type="tel" name="no_hp" class="field-input medium" placeholder="No. HP / WhatsApp" value="{{ old('no_hp') }}">
                </div>
            </div>
        </div>

        <!-- TABS -->
        <div class="px-3 mt-3">
            <div class="tab-bar">
                <button type="button" class="tab-btn active" onclick="switchTab('koresponden', this)">Koresponden</button>
            </div>

            <!-- TAB: KORESPONDEN -->
            <div id="tab-koresponden" class="tab-content active">
                <div class="form-section" style="border-top:none; border-radius:0 4px 4px 4px;">

                    <div class="field-row">
                        <label>Nama Penerima</label>
                        <input type="text" name="nm_penerima" class="field-input wide" placeholder="Nama penerima surat" value="{{ old('nm_penerima') }}">
                        <button type="button" class="btn-search ms-1"><i class="bi bi-search"></i></button>
                    </div>

                    <div class="field-row">
                        <label>Nama Petugas RM</label>
                        <input type="text" name="nm_petugas_rm" class="field-input wide" placeholder="Nama petugas rekam medis" value="{{ old('nm_petugas_rm') }}">
                        <button type="button" class="btn-search ms-1"><i class="bi bi-search"></i></button>
                    </div>

                    <div class="field-row">
                        <label>Layanan</label>
                        <select name="layanan" id="layananSelect" class="field-input" style="max-width:280px;" required>
                            <option value="">-- Pilih Layanan --</option>
                            @foreach($layanans as $layanan)
                                <option value="{{ $layanan->nama_layanan }}" {{ old('layanan')==$layanan->nama_layanan?'selected':'' }}>
                                    {{ $layanan->nama_layanan }}
                                </option>
                            @endforeach
                            <option value="lain-lain" {{ old('layanan')=='lain-lain'?'selected':'' }}>Lain-lain</option>
                        </select>
                    </div>

                    <div class="field-row" id="layananLainRow" style="display:none;">
                        <label>Sebutkan Layanan</label>
                        <input type="text" name="layanan_lain" id="layananLain" class="field-input wide" placeholder="Tuliskan jenis layanan">
                    </div>

                    <div class="field-row">
                        <label>Keterangan</label>
                        <input type="text" name="keterangan" class="field-input" placeholder="Keterangan tambahan" value="{{ old('keterangan') }}">
                        <button type="button" class="btn-search ms-1"><i class="bi bi-search"></i></button>
                    </div>

                    <div style="border-top: 2px solid #d0e0ec; margin: 6px 0;"></div>

                    <div class="field-row">
                        <label>Dokter</label>
                        <input type="text" name="nama_dokter" class="field-input wide" placeholder="Nama dokter" value="{{ old('nama_dokter') }}">
                        <button type="button" class="btn-search ms-1"><i class="bi bi-search"></i></button>
                    </div>

                    <div class="field-row">
                        <label>Nama Peminta</label>
                        <input type="text" name="nama_peminta" class="field-input wide" placeholder="Nama peminta surat" value="{{ old('nama_peminta') }}">
                    </div>

                    <div class="field-row">
                        <label>Email</label>
                        <input type="email" name="email_peminta" class="field-input wide" placeholder="email@contoh.com" value="{{ old('email_peminta') }}">
                    </div>

                    <div class="field-row">
                        <label>No. Whatsapp</label>
                        <input type="tel" name="no_whatsapp" class="field-input medium" placeholder="08xxxxxxxxxx" value="{{ old('no_whatsapp') }}">
                    </div>

                    <div class="field-row">
                        <label>UP</label>
                        <input type="text" name="up" class="field-input wide" placeholder="Untuk perhatian / ditujukan kepada" value="{{ old('up') }}">
                    </div>

                    <div class="field-row">
                        <label>Jumlah Form Asuransi</label>
                        <input type="number" name="jumlah_form_asuransi" class="field-input short" placeholder="0" min="0" value="{{ old('jumlah_form_asuransi', 0) }}">
                    </div>

                    <div class="field-row">
                        <label>Tgl Rencana Kirim</label>
                        <input type="date" name="tgl_rencana_kirim" class="field-input medium" value="{{ old('tgl_rencana_kirim') }}">
                    </div>

                </div>
            </div>


        </div>

        <!-- FOOTER ACTIONS -->
        <div class="win-footer">
            <button type="submit" class="btn-action primary"><i class="bi bi-save me-1"></i>Baru / Simpan</button>
            <a href="{{ route('user.permintaan') }}" class="btn-action">Hapus</a>
            <a href="{{ route('user.permintaan') }}" class="btn-action">Browse</a>
            <a href="{{ route('user.permintaan') }}" class="btn-action">Lihat</a>
        </div>

    </div><!-- /win-body -->
    </form>
</div><!-- /win-wrapper -->

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
function switchTab(name, btn) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-' + name).classList.add('active');
    btn.classList.add('active');
}

function cariRM() {
    var rm = document.getElementById('kodeRm').value.trim();
    if (!rm) { alert('Masukkan No. RM terlebih dahulu.'); return; }
    // Placeholder: bisa dihubungkan ke API pencarian pasien
    alert('Fitur pencarian RM: ' + rm);
}

$(document).ready(function () {
    $('#layananSelect').on('change', function () {
        var val = $(this).val();
        if (val === 'lain-lain') {
            $('#layananLainRow').show();
            $('#layananLain').attr('required', true);
        } else {
            $('#layananLainRow').hide();
            $('#layananLain').removeAttr('required').val('');
        }
    });

    $('#mainForm').on('submit', function (e) {
        if ($('#layananSelect').val() === 'lain-lain' && !$('#layananLain').val().trim()) {
            e.preventDefault();
            alert('Harap isi nama layanan terlebih dahulu.');
        }
    });
});
</script>
</body>
</html>
