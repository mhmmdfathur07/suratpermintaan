<!DOCTYPE html>
<html>
<head>
    <title>View Surat</title>
</head>
<body>
    <h2>Surat Permintaan Layanan RM</h2>
    <hr>
    <p>No Permintaan: {{ $data->no_permintaan }}</p>
    <p>Nama: {{ $data->nama }}</p>
    <p>Layanan: {{ $data->layanan }}</p>
    <p>Tanggal: {{ $data->tanggal }}</p>
</body>
</html>