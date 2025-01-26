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
                                <h4>Edit SP2D</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('spd.index') }}" class="btn btn-primary btn-icon"><i
                                            class="fa-solid fa-arrow-rotate-left"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('spd.update', $spd) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <div class="row gutters-sm">
                                            <div class="col-8 col-md-8 col-sm-8">
                                                <label>Nomor</label>
                                                <input type="text" value="{{$spd->no_spd}}"
                                                    class="form-control"
                                                    name="no_spd" required>
                                            </div>
                                            <div class="col-4 col-md-4 col-sm-4">
                                                <label>Tanggal</label>
                                                <input type="text" value="{{$spd->spd_tgl}}"
                                                    class="form-control datepicker"
                                                    name="spd_tgl" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row gutters-sm">
                                            <div class="col-9 col-md-9 col-sm-9">
                                                <label>Uraian</label>
                                                <textarea class="form-control"
                                                    data-height="120" required
                                                    name="spd_uraian">{{$spd->spd_uraian}}</textarea>
                                            </div>
                                            <div class="col-3 col-md-3 col-sm-3">
                                                <label>Nilai</label>
                                                <input type="text" value="{{ number_format($spd->spd_nilai) }}"
                                                    class="number-separator form-control" required
                                                    name="spd_nilai">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label>IWP 1%</label>
                                                <input type="text" value="{{ number_format($spd->iwp1) }}"
                                                    class="number-separator form-control"
                                                    name="iwp1" required>
                                            </div>
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label>IWP 8%</label>
                                                <input type="text" value="{{ number_format($spd->iwp8) }}"
                                                    class="number-separator form-control" required
                                                    name="iwp8">
                                            </div>
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label>PPh21</label>
                                                <input type="text" value="{{ number_format($spd->pph21) }}"
                                                    class="number-separator form-control" required
                                                    name="pph21">
                                            </div>
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label>PPh22</label>
                                                <input type="text" value="{{ number_format($spd->pph22) }}"
                                                    class="number-separator form-control"
                                                    name="pph22" required>
                                            </div>
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label>PPh23</label>
                                                <input type="text" value="{{ number_format($spd->pph23) }}"
                                                    class="number-separator form-control" required
                                                    name="pph23">
                                            </div>
                                            <div class="col-2">
                                                <label class="form-label">PPN</label>
                                                <input type="text" value="{{ number_format($spd->ppn) }}"
                                                    class="number-separator form-control" required
                                                    name="ppn">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label">Jenis SP2D</div>
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="jenis" value="UP"
                                                    class="selectgroup-input"
                                                    @if ($spd->jenis == 'UP') checked @endif>
                                                <span class="selectgroup-button">UP</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="jenis" value="GU"
                                                    class="selectgroup-input"
                                                    @if ($spd->jenis == 'GU') checked @endif>
                                                <span class="selectgroup-button">GU</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="jenis" value="LS"
                                                    class="selectgroup-input"
                                                    @if ($spd->jenis == 'LS') checked @endif>
                                                <span class="selectgroup-button">LS</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="jenis" value="TU"
                                                    class="selectgroup-input"
                                                    @if ($spd->jenis == 'TU') checked @endif>
                                                <span class="selectgroup-button">TU</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button class="btn btn-primary">Update</button>
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
