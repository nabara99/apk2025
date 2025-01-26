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
                                <h4>Buat Kegiatan</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('kegiatan.index') }}" class="btn btn-primary btn-icon"><i
                                            class="fa-solid fa-arrow-rotate-left"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('kegiatan.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label class="form-label">Program</label>
                                        <select class="form-control selectric @error('program_id') is-invalid @enderror"
                                            name="program_id">
                                            <option value="" selected disabled>-- Pilih Program --</option>
                                            @foreach ($programs as $program)
                                                <option value="{{ $program->id }}"
                                                    {{ old('program_id') == $program->id ? 'selected' : '' }}>
                                                    {{ $program->nama_program }}</option>
                                            @endforeach
                                        </select>
                                        @error('program_id')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Kode Kegiatan</label>
                                        <input type="text" value="{{ old('kode_kegiatan') }}"
                                            class="form-control @error('kode_kegiatan')
                                        is-invalid
                                    @enderror"
                                            name="kode_kegiatan">
                                        @error('kode_kegiatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Kegiatan</label>
                                        <input type="text" value="{{ old('nama_kegiatan') }}"
                                            class="form-control @error('nama_kegiatan')
                                        is-invalid
                                    @enderror"
                                            name="nama_kegiatan">
                                        @error('nama_kegiatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">PPTK</label>
                                        <select class="form-control selectric @error('pptk_id') is-invalid @enderror"
                                            name="pptk_id">
                                            <option value="" selected disabled>-- Pilih PPTK --</option>
                                            @foreach ($pptks as $pptk)
                                                <option value="{{ $pptk->id }}"
                                                    {{ old('pptk_id') == $pptk->id ? 'selected' : '' }}>
                                                    {{ $pptk->nip_pptk }} / {{ $pptk->nama_pptk }}</option>
                                            @endforeach
                                        </select>
                                        @error('pptk_id')
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
