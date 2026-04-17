<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Surat Keterangan Kehilangan Akte</title>
<style>
    @page { size: A4; margin: 2.5cm; }
    body {
        font-family: "Times New Roman", serif;
        font-size: 11pt;
        line-height: 1.6;
        margin: 60px;
    }
    .center { text-align: center; }
    .bold { font-weight: bold; }
    .underline { text-decoration: underline; }
    .italic { font-style: italic; }
    .mt-20 { margin-top: 20px; }
    .mt-30 { margin-top: 30px; }
    .mt-60 { margin-top: 60px; }
    table { width: 100%; border-collapse: collapse; }
    td { vertical-align: top; padding: 2px 0; }
    .field-label { width: 180px; }
    .field-sep { width: 10px; }
    @media print { body { margin: 0; } }
</style>
</head>
<body>

    <!-- JUDUL -->
    <div class="center bold underline">SURAT KETERANGAN KEHILANGAN AKTE</div>
    <div class="center italic">Certificate of Lost Birth Certificate</div>

    <div class="center mt-20">
        No. {{ $data->no_permintaan }}/RM/RS.AZRA/{{ \Carbon\Carbon::parse($data->tanggal)->format('m') }}/{{ \Carbon\Carbon::parse($data->tanggal)->format('Y') }}
    </div>

    <div class="mt-20">
        <span class="underline">Yang bertandatangan dibawah ini, dokter <span class="bold">Rumah Sakit Azra Bogor</span>, menerangkan bahwa:</span><br>
        <span class="italic">The undersigned, the doctor of Azra Hospital Bogor, explained that:</span>
    </div>

    <!-- DATA PASIEN -->
    <table class="mt-20">
        <tr>
            <td class="field-label">Nama</td>
            <td class="field-sep">:</td>
            <td>{{ $data->nama ?? '.............................' }}</td>
        </tr>
        <tr>
            <td class="italic">Name</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Umur</td>
            <td>:</td>
            <td>{{ $data->umur ?? '..' }} Tahun</td>
        </tr>
        <tr>
            <td class="italic">Age</td>
            <td></td>
            <td class="italic">years old</td>
        </tr>
        <tr>
            <td>No. Rekam Medis</td>
            <td>:</td>
            <td>{{ $data->kode_rm ?? '.........' }}</td>
        </tr>
        <tr>
            <td class="italic">Medical Record Number</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $data->alamat ?? '.....................................' }}</td>
        </tr>
        <tr>
            <td class="italic">Address</td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <!-- ISI SURAT -->
    <div class="mt-20">
        <span class="underline">Berdasarkan Surat Kelahiran yang pernah dikeluarkan dengan
        No.{{ $data->kode_rm ?? '.........' }}/<span class="bold">RM/SRTLHR</span>/{{ $data->no_surat_kelahiran ?? '../....' }}
        adalah benar pasien <span class="bold">Rumah Sakit Azra Bogor</span>,
        yang telah melahirkan bayi ({{ $data->jenis_kelamin_bayi ?? 'Perempuan/Laki-laki' }})
        pada tanggal {{ $data->tgl_lahir_bayi ? \Carbon\Carbon::parse($data->tgl_lahir_bayi)->translatedFormat('d F Y') : '..........' }}
        pukul {{ $data->jam_lahir_bayi ?? '......' }} WIB.</span><br>
        <span class="italic">Based on the Birth Certificate previously issued with
        No.{{ $data->kode_rm ?? '.........' }}/RM/SRTLHR/{{ $data->no_surat_kelahiran ?? '../....' }}
        it is true that the patient of Azra Hospital Bogor,
        who gave birth to a baby ({{ $data->jenis_kelamin_bayi ?? 'Female/Male' }})
        on {{ $data->tgl_lahir_bayi ? \Carbon\Carbon::parse($data->tgl_lahir_bayi)->format('F jS, Y') : '..........' }}
        at {{ $data->jam_lahir_bayi ?? '......' }} WIB.</span>
    </div>

    <div class="mt-20">
        <span class="underline">Demikianlah surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</span><br>
        <span class="italic">Thus this statement was made so that those with an interest in understanding.</span>
    </div>

    <!-- TTD -->
    <table class="mt-60">
        <tr>
            <td width="50%">
                Bogor,
                {{ \Carbon\Carbon::parse($data->tanggal)->format('F jS, Y') }}<br><br>
                <span class="bold">Ka.Inst. Ruang Persalinan,</span><br>
                <span class="italic">Head of Maternity Room,</span><br><br><br><br>
                ({{ $data->nama_dokter ?? '.............................' }})
            </td>
            <td width="50%"></td>
        </tr>
    </table>

<script>
    window.onload = function() { window.print(); }
</script>
</body>
</html>
