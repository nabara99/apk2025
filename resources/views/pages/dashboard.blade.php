@extends('layouts.app')

@section('title', '')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard - APK 2025</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>DPA 2025</h4>
                            </div>
                            <div class="card-body">
                                <h6>Rp. {{ number_format($dpas) }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-newspaper"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Sisa Anggaran</h4>
                            </div>
                            <div class="card-body">
                                <h6>Rp. {{ number_format($sisas) }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Realisasi</h4>
                            </div>
                            <div class="card-body">
                                <h6>Rp. {{ number_format($dpas - $sisas) }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fas fa-circle"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Capaian (%)</h4>
                            </div>
                            <div class="card-body">
                                <h6>
                                    {{ $dpas > 0 ? number_format((($dpas - ($sisas ?? 0)) / $dpas) * 100, 2, ',', '.') : '0' }}
                                    %
                                </h6>

                                {{-- <h6>{{ number_format((($dpas - $sisas) / $dpas) * 100, 2, ',', '.') ?? '' }} %</h6> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Dokumen Pelaksanaan Anggaran (DPA) Tahun Anggaran 2025</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table-striped mb-0 table">
                                <thead>
                                    <tr>
                                        <th>Kode Sub Kegiatan</th>
                                        <th>Nama Sub Kegiatan</th>
                                        <th>Pagu</th>
                                        <th>Realisasi</th>
                                        <th>Sisa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anggarans as $dpa)
                                        <tr>
                                            <td>{{ $dpa->kode_program }}.{{ $dpa->kode_kegiatan }}.{{ $dpa->kode_sub }}</td>
                                            <td>{{ $dpa->nama_sub }}</td>
                                            <td>{{ number_format($dpa->nilai) }}</td>
                                            <td>{{ number_format($dpa->nilai - ($dpa->realisasi ?? '0')) }}</td>
                                            <td>{{ number_format($dpa->realisasi ?? '0') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
