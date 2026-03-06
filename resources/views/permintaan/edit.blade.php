<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Edit Permintaan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background:#f4fbfa">

<div class="container">
    <div class="card shadow p-4 mt-5" style="max-width:900px;margin:auto;border-radius:16px;">
        <h4 class="mb-4 fw-bold text-success">Edit Permintaan</h4>

        {{-- Notifikasi Error --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('permintaan.update',$data->id) }}">
            @csrf
            @method('PUT')

            <div class="row">

                {{-- ===================== --}}
                {{-- DATA PASIEN (READONLY) --}}
                {{-- ===================== --}}

                <div class="col-md-6 mb-3">
                    <label class="form-label">Layanan</label>
                    <input type="text" value="{{ $data->layanan }}" class="form-control" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Permintaan</label>
                    <input type="date" value="{{ $data->tanggal }}" class="form-control" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Pasien</label>
                    <input type="text" value="{{ $data->nama }}" class="form-control" readonly>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Umur</label>
                    <input type="number" value="{{ $data->umur }}" class="form-control" readonly>
                </div>

                <div class="col-md-3 mb-3">
                    <label class="form-label">Kode RM</label>
                    <input type="text" value="{{ $data->kode_rm }}" class="form-control" readonly>
                </div>

                <div class="col-md-12 mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea rows="2" class="form-control" readonly>{{ $data->alamat }}</textarea>
                </div>

                <hr class="my-4">

                {{-- ===================== --}}
                {{-- DATA MEDIS (DINAMIS) --}}
                {{-- ===================== --}}

                @if($data->layanan == 'Surat Keterangan Rawat Inap')

                    <h5 class="text-primary mb-3">Data Medis Rawat Inap</h5>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Masuk</label>
                        <input type="date" name="tgl_masuk"
                               value="{{ old('tgl_masuk',$data->tgl_masuk) }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Keluar</label>
                        <input type="date" name="tgl_keluar"
                               value="{{ old('tgl_keluar',$data->tgl_keluar) }}"
                               class="form-control">
                    </div>

                @elseif($data->layanan == 'Surat Keterangan Rawat Jalan')

                    <h5 class="text-primary mb-3">Data Medis Rawat Jalan</h5>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Poliklinik</label>
                        <input type="text" name="poliklinik"
                               value="{{ old('poliklinik',$data->poliklinik) }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Tanggal Periksa</label>
                        <input type="date" name="tgl_periksa"
                               value="{{ old('tgl_periksa',$data->tgl_periksa) }}"
                               class="form-control">
                    </div>

                @endif

                {{-- ===================== --}}
                {{-- FIELD UMUM SEMUA SURAT --}}
                {{-- ===================== --}}

                <div class="col-md-12 mb-3">
                    <label class="form-label">Diagnosis</label>
                    <input type="text" name="diagnosis"
                           value="{{ old('diagnosis',$data->diagnosis) }}"
                           class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Dokter</label>
                    <input type="text" name="nama_dokter"
                           value="{{ old('nama_dokter',$data->nama_dokter) }}"
                           class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Persetujuan</label>
                    <input type="text" name="nama_persetujuan"
                           value="{{ old('nama_persetujuan',$data->nama_persetujuan) }}"
                           class="form-control">
                </div>

                {{-- ===================== --}}
                {{-- TAMBAHAN YANG KAMU INGINKAN --}}
                {{-- ===================== --}}

                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Penerima</label>
                    <input type="text" name="nm_penerima"
                           value="{{ old('nm_penerima',$data->nm_penerima) }}"
                           class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Petugas RM</label>
                    <input type="text" name="nm_petugas_rm"
                           value="{{ old('nm_petugas_rm',$data->nm_petugas_rm) }}"
                           class="form-control" required>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="pending" {{ $data->status=='pending'?'selected':'' }}>Pending</option>
                        <option value="proses" {{ $data->status=='proses'?'selected':'' }}>Proses</option>
                        <option value="selesai" {{ $data->status=='selesai'?'selected':'' }}>Selesai</option>
                    </select>
                </div>

            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-success">Update</button>
                <a href="{{ route('permintaan.index') }}" class="btn btn-secondary">Kembali</a>
            </div>

        </form>
    </div>
</div>

</body>
</html>