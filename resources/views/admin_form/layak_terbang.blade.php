<h4>Data Tambahan Layak Terbang</h4>

<label>Tanggal Berobat</label>
<input type="date" name="tgl_berobat" value="{{ $data->tgl_berobat }}">

<label>Status Kehamilan (Hamil/Tidak Hamil)</label>
<input type="text" name="status_kehamilan" value="{{ $data->status_kehamilan }}" placeholder="Contoh: Hamil / Tidak Hamil">

<label>Usia Kehamilan (Minggu)</label>
<input type="number" name="usia_kehamilan_minggu" value="{{ $data->usia_kehamilan_minggu }}" placeholder="Contoh: 12">

<label>Usia Kehamilan (Hari)</label>
<input type="number" name="usia_kehamilan_hari" value="{{ $data->usia_kehamilan_hari }}" placeholder="Contoh: 3">

<label>Nama Dokter</label>
<input type="text" name="nama_dokter" value="{{ $data->nama_dokter }}">
