@extends('layouts.app')

@section('title', '')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Buat Rekanan</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('penerima.index') }}" class="btn btn-primary btn-icon"><i
                                            class="fa-solid fa-arrow-rotate-left"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('penerima.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" value="{{ old('nama_penerima') }}"
                                            class="form-control @error('nama_penerima')
                                        is-invalid
                                    @enderror"
                                            name="nama_penerima">
                                        @error('nama_penerima')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Jabatan</label>
                                        <input type="text" value="{{ old('jabatan_penerima') }}"
                                            class="form-control @error('jabatan_penerima')
                                        is-invalid
                                    @enderror"
                                            name="jabatan_penerima">
                                        @error('jabatan_penerima')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Alamat</label>
                                        <input type="text" value="{{ old('alamat') }}"
                                            class="form-control @error('alamat')
                                        is-invalid
                                    @enderror"
                                            name="alamat">
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Bank</label>
                                        <input type="text" value="{{ old('bank') }}"
                                            class="form-control @error('bank')
                                        is-invalid
                                    @enderror"
                                            name="bank">
                                        @error('bank')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>No. Rekening</label>
                                        <input type="text" value="{{ old('rek_bank') }}"
                                            class="form-control @error('rek_bank')
                                        is-invalid
                                    @enderror"
                                            name="rek_bank">
                                        @error('rek_bank')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>NPWP</label>
                                        <input type="text" value="{{ old('npwp') }}"
                                            class="form-control @error('npwp')
                                        is-invalid
                                    @enderror"
                                            name="npwp">
                                        @error('npwp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/cleave.js/dist/cleave.min.js') }}"></script>
    <script src="{{ asset('library/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
    <script src="{{ asset('library/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('library/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
@endpush
