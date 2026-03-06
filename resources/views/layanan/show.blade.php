<!DOCTYPE html>
<html>
<head>
<title>Detail Permintaan</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">

<div class="card p-4">
<h4>Detail Permintaan</h4>
<hr>

<p><b>No Permintaan:</b> {{ $data->no_permintaan }}</p>
<p><b>Nama:</b> {{ $data->nama }}</p>
<p><b>Layanan:</b> {{ $data->layanan }}</p>
<p><b>Status:</b> {{ strtoupper($data->status) }}</p>
<p><b>Petugas RM:</b> {{ $data->nm_petugas_rm ?? '-' }}</p>

@if($data->status=='selesai')
<a href="{{ route('user.permintaan.download',$data->id) }}" class="btn btn-success">
Download Surat
</a>
@endif

</div>

</div>
</body>
</html>