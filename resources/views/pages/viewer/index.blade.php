tes
@extends('layouts.app')

<?php
use Carbon\Carbon;
setlocale(LC_TIME, 'id_ID');
?>

@section('title', '')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Daftar Kwitansi</h4>
                                <a href="{{ route('kwitansi.create') }}" class="btn btn-primary">Buat Kwitansi</a>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari transaksi"
                                                name="hal">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="clearfix mb-3"></div>
                                <div class="table-responsive">
                                    <table class="table-striped table table-hover">
                                        <tr>
                                            <th>No.Kwitansi</th>
                                            <th>Tanggal</th>
                                            <th>Uraian</th>
                                            <th>Penerima</th>
                                            <th>Total Bayar (Rp)</th>
                                            <th>File</th>
                                            <th>Aksi</th>
                                        </tr>
                                        @foreach ($kwitansis as $kwitansi)
                                            <tr>
                                                <td>{{ $kwitansi->kw_id }}/KTK/2024
                                                </td>
                                                <td>{{ Carbon::parse($kwitansi->tgl)->formatLocalized('%e %B %Y') }}</td>
                                                <td>{{ $kwitansi->hal }}</td>
                                                <td>{{ $kwitansi->penerima->nama_penerima }}</td>
                                                <td>{{ number_format($kwitansi->nilai) }}</td>
                                                <td>
                                                    @if ($kwitansi->file)
                                                        <a href="{{url($kwitansi->file)}}" target="blank" title="Lihat File"><i class="fa-regular fa-folder-open"></i></i></a>
                                                    @else
                                                        @if ($kwitansi->anggaran->rekening->kode_rekening == '5.1.02.04.01.0003')
                                                        @else
                                                            <button class="btn btn-sm btn-outline-danger" title="Tidak ada"><i class="fa-regular fa-circle-xmark"></i></button>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-left">
                                                        <button class="btn btn-sm btn-info"
                                                            onclick="cetak({{ $kwitansi->kw_id }})" title="cetak">
                                                            <i class="fa fa-print"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $kwitansis->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>

    <script>
        function cetak(kwitansi_id) {
            var windowCetak = window.open('/kwitansi/' + kwitansi_id,
                "Cetak Kwitansi",
                "width=1200, height=800");
            windowCetak.focus();
        }
    </script>
@endpush
