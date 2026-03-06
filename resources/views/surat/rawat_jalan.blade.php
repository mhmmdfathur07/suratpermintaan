<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Surat Keterangan Rawat Jalan</title>

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
    table{width:100%; border-collapse:collapse;}
    td{vertical-align:top; padding:2px 0;}

    @media print {
        body {
            margin: 0;
        }
    }
</style>
</head>
<body>

<div class="center bold underline">SURAT KETERANGAN RAWAT JALAN</div>

<div class="center mt-20">
No. {{ $data->no_permintaan }}/RM/RS.AZRA/{{ \Carbon\Carbon::parse($data->tanggal)->format('m') }}/{{ \Carbon\Carbon::parse($data->tanggal)->format('Y') }}
</div>

<div class="mt-30">
Yang bertanda tangan di bawah ini, dokter rumah sakit azra bogor, menerangkan bahwa:
</div>

<table class="mt-20">
<tr>
<td width="150">Nama</td>
<td width="10">:</td>
<td>{{ $data->nama }}</td>
</tr>
<tr>
<td>Umur</td>
<td>:</td>
<td>{{ $data->umur }} Tahun</td>
</tr>
<tr>
<td>No. RM</td>
<td>:</td>
<td>{{ $data->kode_rm }}</td>
</tr>
<tr>
<td>Alamat</td>
<td>:</td>
<td>{{ $data->alamat }}</td>
</tr>
</table>

<div class="mt-30">
    adalah benar pasien Rumah Sakit Azra Bogor, yang berobat ke 
    Poliklinik Spesialis {{ $data->poliklinik ?? '-' }} 
    pada tanggal 
    {{ $data->tgl_periksa 
        ? \Carbon\Carbon::parse($data->tgl_periksa)->translatedFormat('d F Y') 
        : '-' }}.
    <br><br>
    dengan diagnosis {{ $data->diagnosis ?? '-' }}.
</div>

<div class="mt-30">
Demikianlah surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.
</div>

<table class="mt-60">
<tr>
<td width="50%">
Bogor, {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}<br>
Dokter yang memeriksa,<br><br><br><br>
<u>{{ $data->nama_dokter ?? 'dr. ...................' }}</u>
</td>
<td width="50%" class="center">
Menyetujui data kesehatan saya<br>
diberikan kepada pihak ketiga<br><br><br><br>
<u>{{ $data->nama_persetujuan ?? '...................' }}</u>
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