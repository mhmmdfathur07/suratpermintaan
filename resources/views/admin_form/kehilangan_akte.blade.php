<h4>Data Tambahan Kehilangan Akte</h4>

<label>No. Surat Kelahiran (bagian setelah RM/SRTLHR/)</label>
<input type="text" name="no_surat_kelahiran" value="{{ $data->no_surat_kelahiran }}" placeholder="Contoh: 01/2026">

<label>Jenis Kelamin Bayi</label>
<select name="jenis_kelamin_bayi">
    <option value="">-- Pilih --</option>
    <option value="Laki-laki" {{ $data->jenis_kelamin_bayi == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
    <option value="Perempuan" {{ $data->jenis_kelamin_bayi == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
</select>

<label>Tanggal Lahir Bayi</label>
<input type="date" name="tgl_lahir_bayi" value="{{ $data->tgl_lahir_bayi }}">

<label>Jam Lahir Bayi (WIB)</label>
<input type="text" name="jam_lahir_bayi" value="{{ $data->jam_lahir_bayi }}" placeholder="Contoh: 08.30">

<label>Nama Dokter / Ka. Inst. Ruang Persalinan</label>
<input type="text" name="nama_dokter" value="{{ $data->nama_dokter }}">
