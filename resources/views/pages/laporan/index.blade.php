@extends('layouts.app')

@section('title', '')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Laporan</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card card-primary">
                        <form action="{{ route('laporan.bendahara') }}" method="POST" target="blank">
                            @csrf
                            <div class="card-header">
                                <h4>Laporan Bendahara</h4>
                                <div class="card-header-action">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Tanggal Awal</label>
                                            <input type="text" id="start_date" name="start_date"
                                                class="form-control datepicker" value="{{ $startDate ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Tanggal Akhir</label>
                                            <input type="text" id="end_date" name="end_date"
                                                class="form-control datepicker" value="{{ $endDate ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card card-primary">
                        <form action="{{ route('laporan.pajak') }}" method="POST" target="blank">
                            @csrf
                            <div class="card-header">
                                <h4>Laporan Pajak Pusat</h4>
                                <div class="card-header-action">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Tanggal Awal</label>
                                            <input type="text" id="start_date" name="start_date"
                                                class="form-control datepicker" value="{{ $startDate ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Tanggal Akhir</label>
                                            <input type="text" id="end_date" name="end_date"
                                                class="form-control datepicker" value="{{ $endDate ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card card-secondary">
                        <form action="{{ route('laporan.realisasi') }}" method="GET" target="blank">
                            @csrf
                            <div class="card-header">
                                <h4>Laporan Renja</h4>
                                <div class="card-header-action">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                Laporan Realisasi Renja update
                            </div>
                        </form>
                    </div>
                    <div class="card card-danger">
                        <form action="{{ route('laporan.pajakdaerah') }}" method="POST" target="blank">
                            @csrf
                            <div class="card-header">
                                <h4>Laporan Pajak Daerah</h4>
                                <div class="card-header-action">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-print"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Tanggal Awal</label>
                                            <input type="text" id="start_date" name="start_date"
                                                class="form-control datepicker" value="{{ $startDate ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Tanggal Akhir</label>
                                            <input type="text" id="end_date" name="end_date"
                                                class="form-control datepicker" value="{{ $endDate ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card card-warning">
                        <form action="{{ route('laporan.spd') }}" method="GET" target="blank">
                            @csrf
                            <div class="card-header">
                                <h4>Rekap SP2D</h4>
                                <div class="card-header-action">

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Tanggal Awal</label>
                                            <input type="text" id="start_date" name="start_date"
                                                class="form-control datepicker" value="{{ $startDate ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Tanggal Akhir</label>
                                            <input type="text" id="end_date" name="end_date"
                                                class="form-control datepicker" value="{{ $endDate ?? '' }}">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="">Semua SP2D</label>
                                            <button type="submit" class="btn btn-primary"><i
                                                    class="fa fa-print"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->

    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
