@if($data->layanan == 'Surat Keterangan Rawat Inap')

    @include('surat.rawat_inap', ['data' => $data])

@elseif($data->layanan == 'Surat Keterangan Rawat Jalan')

    @include('surat.rawat_jalan', ['data' => $data])

@else

    <h3>Template surat tidak ditemukan</h3>

@endif