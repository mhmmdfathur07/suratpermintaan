<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Surat Keterangan Layak Terbang</title>

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

    .field-label{width:180px;}
    .field-sep{width:10px;}

    .italic{font-style:italic;}

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
    <div class="center bold underline">SURAT KETERANGAN LAYAK TEBANG</div>
    <div class="center italic">Airworthy Certificate</div>

    <div class="center mt-20">
        No. {{ $data->no_permintaan }}/RM-RS.AZRA/{{ \Carbon\Carbon::parse($data->tanggal)->format('m') }}/{{ \Carbon\Carbon::parse($data->tanggal)->format('Y') }}
    </div>

    <div class="mt-20">
        <span class="underline">Yang bertandatangan dibawah ini, dokter <span class="bold">Rumah Sakit Azra Bogor</span>, menerangkan bahwa :</span><br>
        <span class="italic">The undersigned, the doctor of Azra Hospital Bogor, explained that:</span>
    </div>

    <!-- DATA PASIEN -->
    <table class="mt-20">
        <tr>
            <td class="field-label">Nama</td>
            <td class="field-sep">:</td>
            <td>{{ $data->nama ?? '.........................' }}, Ny / Mrs</td>
        </tr>
        <tr>
            <td class="italic">Name</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Umur</td>
            <td>:</td>
            <td>{{ $data->umur ?? '...' }} Tahun</td>
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
            <td class="italic">Medical Record Numbers</td>
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
        </tr>
    </table>

    <!-- ISI SURAT -->
    <div class="mt-20">
        <span class="underline">Adalah benar pasien Rumah Sakit Azra Bogor, yang berobat pada tanggal 
        @if($data->tgl_berobat)
            {{ \Carbon\Carbon::parse($data->tgl_berobat)->translatedFormat('d F Y') }}
        @else
            .........................
        @endif
        </span><br>
        <span class="italic">It is true that the patient of Azra Hospital in Bogor, on 
        @if($data->tgl_berobat)
            {{ \Carbon\Carbon::parse($data->tgl_berobat)->translatedFormat('F d') }}<sup>th</sup>, {{ \Carbon\Carbon::parse($data->tgl_berobat)->format('Y') }}
        @else
            .........................
        @endif
        </span>
    </div>

    <div class="mt-20">
        <span class="underline">Hamil : 
        @if($data->usia_kehamilan_minggu || $data->usia_kehamilan_hari)
            G.P.A. {{ $data->usia_kehamilan_minggu ?? '..' }} minggu + {{ $data->usia_kehamilan_hari ?? '..' }} hari
        @else
            .........................
        @endif
        </span><br>
        <span class="italic">Was pregnant : 
        @if($data->usia_kehamilan_minggu || $data->usia_kehamilan_hari)
            G.P.A. {{ $data->usia_kehamilan_minggu ?? '..' }} weeks + {{ $data->usia_kehamilan_hari ?? '..' }} days
        @else
            .........................
        @endif
        </span>
    </div>

    <div class="mt-20">
        <span class="underline">Kondisi ibu baik dan dapat melakukan perjalanan dengan pesawat</span><br>
        <span class="italic">The condition of mother is good and can travel by plane</span>
    </div>

    <div class="mt-20">
        <span class="underline">Demikianlah surat keterangan ini dibuat agar yang berkepentingan maklum.</span><br>
        <span class="italic">Thus this statement was made so that those with an interest in understanding</span>
    </div>

    <!-- TTD -->
    <table class="mt-20">
        <tr>
            <td width="50%">
                Bogor, 
                @if($data->tanggal)
                    {{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('F d') }}<sup>th</sup>, {{ \Carbon\Carbon::parse($data->tanggal)->format('Y') }}
                @else
                    .........................
                @endif
                <br><br>
                Hormat kami,<br>
                Best regards,<br><br><br><br>
                <u>{{ $data->nama_dokter ?? 'dr. ............................, ' }}</u><br>
                <span class="bold">Dokter Pemeriksa</span><br>
                <span class="italic">Examining Doctor</span>
            </td>
            <td width="50%">
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
