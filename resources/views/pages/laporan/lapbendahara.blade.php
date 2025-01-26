@extends('layouts.app')

@section('title', '')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Laporan Realisasi</h4>
                            </div>
                            <div class="card-body">
                                <div class="clearfix mb-3"></div>
                                <div class="table-responsive">
                                    <table class="table-bordered table table-hover">
                                        <thead>
                                            <tr>
                                                <th rowspan="2">Sub Kegiatan</th>
                                                <th rowspan="2">Kode Rekening</th>
                                                <th rowspan="2">Nama Rekening</th>
                                                <th colspan="12">Total per Bulan</th>
                                                <th rowspan="2">Jumlah</th>
                                            </tr>
                                            <tr>
                                                <th>Januari</th>
                                                <th>Februari</th>
                                                <th>Maret</th>
                                                <th>April</th>
                                                <th>Mei</th>
                                                <th>Juni</th>
                                                <th>Juli</th>
                                                <th>Agustus</th>
                                                <th>September</th>
                                                <th>Oktober</th>
                                                <th>November</th>
                                                <th>Desember</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($realisasiBelanja as $realisasi)
                                                <tr>
                                                    <td>{{ $realisasi->kode_program }}.{{ $realisasi->kode_kegiatan }}.{{ $realisasi->kode_sub }}
                                                        {{ $realisasi->nama_sub }}</td>
                                                    <td>{{ $realisasi->kode_rekening }}</td>
                                                    <td>{{ $realisasi->nama_rekening }}</td>
                                                    <td>{{ number_format($realisasi->januari_total) }}</td>
                                                    <td>{{ number_format($realisasi->februari_total) }}</td>
                                                    <td>{{ number_format($realisasi->maret_total) }}</td>
                                                    <td>{{ number_format($realisasi->april_total) }}</td>
                                                    <td>{{ number_format($realisasi->mei_total) }}</td>
                                                    <td>{{ number_format($realisasi->juni_total) }}</td>
                                                    <td>{{ number_format($realisasi->juli_total) }}</td>
                                                    <td>{{ number_format($realisasi->agustus_total) }}</td>
                                                    <td>{{ number_format($realisasi->september_total) }}</td>
                                                    <td>{{ number_format($realisasi->oktober_total) }}</td>
                                                    <td>{{ number_format($realisasi->november_total) }}</td>
                                                    <td>{{ number_format($realisasi->desember_total) }}</td>
                                                    <td>{{ number_format($realisasi->januari_total + $realisasi->februari_total + $realisasi->maret_total + $realisasi->april_total + $realisasi->mei_total + $realisasi->juni_total + $realisasi->juli_total + $realisasi->agustus_total + $realisasi->september_total + $realisasi->oktober_total + $realisasi->november_total + $realisasi->desember_total) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3">Total</td>
                                                <td>{{ number_format($totalJanuari) }}</td>
                                                <td>{{ number_format($totalFebruari) }}</td>
                                                <td>{{ number_format($totalMaret) }}</td>
                                                <td>{{ number_format($totalApril) }}</td>
                                                <td>{{ number_format($totalMei) }}</td>
                                                <td>{{ number_format($totalJuni) }}</td>
                                                <td>{{ number_format($totalJuli) }}</td>
                                                <td>{{ number_format($totalAgustus) }}</td>
                                                <td>{{ number_format($totalSeptember) }}</td>
                                                <td>{{ number_format($totalOktober) }}</td>
                                                <td>{{ number_format($totalNovember) }}</td>
                                                <td>{{ number_format($totalDesember) }}</td>
                                                <td>{{ number_format($totalJanuari + $totalFebruari + $totalMaret + $totalApril + $totalMei + $totalJuni + $totalJuli + $totalAgustus + $totalSeptember + $totalOktober + $totalNovember + $totalDesember) }}
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
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
@endpush
