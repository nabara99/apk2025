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
                                <h4>Buat Anggaran</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('anggaran.index') }}" class="btn btn-primary btn-icon"><i
                                            class="fa-solid fa-arrow-rotate-left"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('anggaran.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="form-label">Sub Kegiatan</label>
                                                <select
                                                    class="form-control select2 select2-hidden-accessible @error('sub_id')
                                                    is-invalid
                                                @enderror"
                                                    style="width: 100%;" tabindex="-1" aria-hidden="true" name="sub_id">
                                                    <option value="" selected disabled>--Pilih Sub Kegiatan--</option>
                                                    @foreach ($subs as $sub)
                                                        <option value="{{ $sub->id }}"
                                                            {{ old('sub_id') == $sub->id ? 'selected' : '' }}>
                                                            {{ $sub->kegiatan->program->kode_program }}.{{ $sub->kegiatan->kode_kegiatan }}.{{ $sub->kode_sub }}
                                                            / {{ $sub->nama_sub }}</option>
                                                    @endforeach
                                                </select>
                                                @error('sub_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <label class="form-label">Rekening</label>
                                                <select
                                                    class="form-control select2 select2-hidden-accessible @error('rekening_id')
                                                    is-invalid
                                                @enderror"
                                                    style="width: 100%;" tabindex="-1" aria-hidden="true" name="rekening_id">
                                                    <option value="" selected disabled>--Pilih Rekening--</option>
                                                    @foreach ($rekenings as $rekening)
                                                        <option value="{{ $rekening->id }}"
                                                            {{ old('rekening_id') == $rekening->id ? 'selected' : '' }}>
                                                            {{ $rekening->kode_rekening }} / {{ $rekening->nama_rekening }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('rekening_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-9">
                                                <label>Uraian</label>
                                                <input type="text" value="{{ old('uraian') }}"
                                                    class="form-control @error('uraian')
                                                    is-invalid
                                                @enderror"
                                                    name="uraian">
                                                @error('uraian')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-3">
                                                <label>Pagu</label>
                                                <input type="text" value="{{ old('pagu') }}"
                                                    class="number-separator form-control @error('pagu')
                                                        is-invalid
                                                    @enderror"
                                                    name="pagu">
                                                @error('pagu')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">

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
    <script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('library/easy-number/easy-number-separator.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('.sub_id').select2({
                closeOnSelect: false
            });
            $('.rekening_id').select2({
                closeOnSelect: false
            });
        });
    </script>
@endpush
