<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Surat Keterangan Rawat Inap</title>
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
    <div class="center bold underline">SURAT KETERANGAN RAWAT INAP</div>
    <div class="center italic">Inpatient Certificate</div>

    <div class="center mt-20">
        No. {{ $data->no_permintaan }}/RM/RS.AZRA/{{ \Carbon\Carbon::parse($data->tanggal)->format('m') }}/{{ \Carbon\Carbon::parse($data->tanggal)->format('Y') }}
    </div>

    <div class="mt-20">
        <span class="underline">Yang bertanda tangan di bawah ini, dokter <span class="bold">Rumah Sakit Azra Bogor</span>, menerangkan bahwa:</span><br>
        <span class="italic">The undersigned, the doctor of Azra Hospital Bogor, explained that:</span>
    </div>

    <!-- DATA PASIEN -->
    <table class="mt-20">
        <tr>
            <td class="field-label">Nama</td>
            <td class="field-sep">:</td>
            <td>{{ $data->nama ?? '.........................' }}</td>
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
            <td>{{ $data->kode_rm ?? '.........................' }}</td>
        </tr>
        <tr>
            <td class="italic">Medical Record Number</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $data->alamat ?? '.........................' }}</td>
        </tr>
        <tr>
            <td class="italic">Address</td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <!-- ISI SURAT -->
    <div class="mt-20">
        @if($data->tgl_masuk && $data->tgl_keluar)
            <span class="underline">Adalah benar pasien <strong>Rumah Sakit Azra Bogor</strong>, yang dirawat pada tanggal
            <strong>{{ \Carbon\Carbon::parse($data->tgl_masuk)->translatedFormat('d F Y') }}</strong>
            sampai
            <strong>{{ \Carbon\Carbon::parse($data->tgl_keluar)->translatedFormat('d F Y') }}</strong>,
            dengan diagnosis <strong>{{ $data->diagnosis ?? '-' }}</strong>.</span><br>
            <span class="italic">It is true that the patient of Azra Hospital Bogor, who was hospitalized from
            <strong>{{ \Carbon\Carbon::parse($data->tgl_masuk)->translatedFormat('F d') }}<sup>th</sup>, {{ \Carbon\Carbon::parse($data->tgl_masuk)->format('Y') }}</strong>
            to
            <strong>{{ \Carbon\Carbon::parse($data->tgl_keluar)->translatedFormat('F d') }}<sup>th</sup>, {{ \Carbon\Carbon::parse($data->tgl_keluar)->format('Y') }}</strong>,
            with diagnosis <strong>{{ $data->diagnosis ?? '-' }}</strong>.</span>
        @else
            <span class="underline">Adalah benar pasien <strong>Rumah Sakit Azra Bogor</strong>,
            dengan diagnosis <strong>{{ $data->diagnosis ?? '-' }}</strong>.</span><br>
            <span class="italic">It is true that the patient of Azra Hospital Bogor,
            with diagnosis <strong>{{ $data->diagnosis ?? '-' }}</strong>.</span>
        @endif
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
                {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('F d') }}<sup>th</sup>, {{ \Carbon\Carbon::parse($data->tanggal)->format('Y') }}<br><br>
                Dokter yang merawat,<br>
                <span class="italic">Attending Doctor,</span><br><br><br><br>
                <u>{{ $data->nama_dokter ?? 'dr. .......................' }}</u>
            </td>
            <td width="50%" class="center">
                Menyetujui data kesehatan saya<br>
                diberikan kepada pihak ketiga<br>
                <span class="italic">Approving my health data<br>
                given to third parties</span><br><br><br><br>
                <u>{{ $data->nama_persetujuan ?? '...................' }}</u>
            </td>
        </tr>
    </table>

<script>
    window.onload = function() { window.print(); }
</script>
</body>
</html>
