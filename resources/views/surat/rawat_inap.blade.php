<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Surat Keterangan Rawat Inap</title>

<style>
    @page {
        size: A4;
        margin: 2.5cm;
    }

    body{
        font-family: "Times New Roman", serif;
        font-size: 11pt;
        line-height: 1.6;
        margin: 60px;
    }

    .center{text-align:center;}
    .bold{font-weight:bold;}
    .underline{text-decoration:underline;}

    .mt-20{margin-top:20px;}
    .mt-30{margin-top:30px;}
    .mt-60{margin-top:60px;}

    table{
        width:100%;
        border-collapse:collapse;
    }
    td{
        vertical-align:top;
        padding:2px 0;
    }

    .field-label{width:160px;}
    .field-sep{width:10px;}

    /* Hilangkan margin saat print */
    @media print {
        body {
            margin: 0;
        }
    }
</style>

</head>
<body>

    <!-- JUDUL -->
    <div class="center bold underline">SURAT KETERANGAN RAWAT INAP</div>

    <div class="center mt-20">
        No. {{ $data->no_permintaan }}/RM/RS.AZRA/{{ \Carbon\Carbon::parse($data->tanggal)->format('m') }}/{{ \Carbon\Carbon::parse($data->tanggal)->format('Y') }}
    </div>

    <div class="mt-30">
        Yang bertanda tangan di bawah ini, dokter 
        <span class="bold">Rumah Sakit Azra Bogor</span>,
        menerangkan bahwa:
    </div>

    <!-- DATA PASIEN -->
    <table class="mt-20">
        <tr>
            <td class="field-label">Nama</td>
            <td class="field-sep">:</td>
            <td>{{ $data->nama }}</td>
        </tr>
        <tr>
            <td>Umur</td>
            <td>:</td>
            <td>{{ $data->umur ?? '-' }} Tahun</td>
        </tr>
        <tr>
            <td>No. RM</td>
            <td>:</td>
            <td>{{ $data->kode_rm }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $data->alamat ?? '-' }}</td>
        </tr>
    </table>

    <!-- ISI OTOMATIS -->
    <div class="mt-30">
        @if($data->tgl_masuk && $data->tgl_keluar)
            Adalah benar pasien 
            <strong>Rumah Sakit Azra Bogor,</strong> 
            yang dirawat pada tanggal 
            <strong>{{ \Carbon\Carbon::parse($data->tgl_masuk)->translatedFormat('d F Y') }}</strong>
            sampai  
            <strong>{{ \Carbon\Carbon::parse($data->tgl_keluar)->translatedFormat('d F Y') }}</strong>.
        @else
            Adalah benar pasien 
            <strong>Rumah Sakit Azra Bogor</strong>.
        @endif

        <br><br>

        dengan diagnosis
        <strong>{{ $data->diagnosis ?? '-' }}</strong>.
    </div>

    <div class="mt-30">
        Demikianlah surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.
    </div>

    <!-- TTD -->
    <table class="mt-60">
        <tr>
            <td width="50%">
                Bogor, {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}<br>
                Dokter yang merawat,<br><br><br><br>
                <u>{{ $data->nama_dokter ?? 'dr. ............................' }}</u>
            </td>
            <td width="50%" class="center">
                Menyetujui data kesehatan saya<br>
                diberikan kepada pihak ketiga<br><br><br><br>
                <u>{{ $data->nama_persetujuan ?? $data->nama }}</u>
            </td>
        </tr>
    </table>

<script>
    window.onload = function() {
        window.print();
    }
</script>

</body>
</html>