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
                                <h4>Buat SP2D</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('spd.index') }}" class="btn btn-primary btn-icon"><i
                                            class="fa-solid fa-arrow-rotate-left"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('spd.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <div class="row gutters-sm">
                                            <div class="col-8 col-md-8 col-sm-8">
                                            <label>Nomor</label>
                                            <input type="text" value="{{ old('no_spd') }}"
                                                class="form-control @error('no_spd')
                                                is-invalid
                                                @enderror"
                                                    name="no_spd">
                                                @error('no_spd')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            </div>
                                            <div class="col-4 col-md-4 col-sm-4">
                                                <label>Tanggal</label>
                                                <input type="text" value="{{ old('spd_tgl') }}"
                                                    class="form-control datepicker @error('spd_tgl')
                                                    is-invalid
                                                @enderror"
                                                    name="spd_tgl">
                                                @error('spd_tgl')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row gutters-sm">
                                            <div class="col-9 col-md-9 col-sm-9">
                                                <label>Uraian</label>
                                                <textarea class="form-control @error('spd_uraian')
                                                    is-invalid
                                                @enderror"
                                                data-height="120"
                                                name="spd_uraian">{{old('spd_uraian')}}</textarea>
                                                    @error('spd_uraian')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-3 col-md-3 col-sm-3">
                                                <label>Nilai</label>
                                                <input type="text" value="{{ old('spd_nilai') }}"
                                                    class="number-separator form-control @error('spd_nilai')
                                                is-invalid
                                            @enderror"
                                                    name="spd_nilai">
                                                @error('spd_nilai')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label>IWP 1%</label>
                                                <input type="text" value="0"
                                                    class="number-separator form-control"
                                                    name="iwp1">
                                            </div>
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label>IWP 8%</label>
                                                <input type="text" value="0"
                                                    class="number-separator form-control"
                                                    name="iwp8">
                                            </div>
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label>PPh21</label>
                                                <input type="text" value="0"
                                                    class="number-separator form-control"
                                                    name="pph21">
                                            </div>
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label>PPh22</label>
                                                <input type="text" value="0"
                                                    class="number-separator form-control"
                                                    name="pph22">
                                            </div>
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label>PPh23</label>
                                                <input type="text" value="0"
                                                    class="number-separator form-control"
                                                    name="pph23">
                                            </div>
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label>PPN</label>
                                                <input type="text" value="0"
                                                    class="number-separator form-control"
                                                    name="ppn">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label">Jenis SP2D</div>
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="jenis" value="UP"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">UP</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="jenis" value="GU"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">GU</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="jenis" value="LS"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">LS</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="jenis" value="TU"
                                                    class="selectgroup-input">
                                                <span class="selectgroup-button">TU</span>
                                            </label>
                                        </div>
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
    <script src="{{ asset('library/easy-number/easy-number-separator.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/forms-advanced-forms.js') }}"></script>
@endpush
