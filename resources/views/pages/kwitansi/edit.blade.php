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
                                <h4>Edit Kwitansi</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('kwitansi.index') }}" class="btn btn-primary btn-icon"><i
                                            class="fa-solid fa-arrow-rotate-left"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('kwitansi.update', $kwitansis) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <div class="row gutters-sm">
                                            <div class="col-5 col-md-4 col-sm-4">
                                                <label class="form-label">Penerima</label>
                                                <select
                                                    class="form-control select2 select2-hidden-accessible @error('penerima_id')
                                                        is-invalid
                                                    @enderror"
                                                    style="width: 100%;" tabindex="-1" aria-hidden="true"
                                                    name="penerima_id">
                                                    <option value="{{ $kwitansis->penerima_id }}">
                                                        {{ $kwitansis->penerima->nama_penerima }} /
                                                        {{ $kwitansis->penerima->jabatan_penerima }}</option>
                                                    @foreach ($penerimas as $penerima)
                                                        <option value="{{ $penerima->id }}"
                                                            {{ old('penerima_id') == $penerima->id ? 'selected' : '' }}>
                                                            {{ $penerima->nama_penerima }} /
                                                            {{ $penerima->jabatan_penerima }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('penerima_id')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-3 col-md-2 col-sm-2">
                                                <label for="tgl">Tanggal</label>
                                                <input type="text" class="form-control datepicker" id="tgl"
                                                    name="tgl" value="{{ $kwitansis->tgl }}">
                                            </div>
                                            <div class="col-6 col-md-6 col-sm-6">
                                                <label for="hal">Uraian</label>
                                                <input type="text"
                                                    class="form-control @error('hal')
                                                        is-invalid
                                                    @enderror"
                                                    name="hal" value="{{ $kwitansis->hal }}">
                                                @error('hal')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row gutters-sm">
                                            <div class="col-3 col-md-3 col-sm-3">
                                                <label>Total Bayar</label>
                                                <input type="text"
                                                    class="number-separator form-control @error('nilai')
                                                    is-invalid
                                                @enderror"
                                                    name="nilai" id="nilai"
                                                    value="{{ number_format($kwitansis->nilai) }}">
                                                @error('nilai')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-3 col-md-3 col-sm-3">
                                                <label>PPN</label>
                                                <input type="text"
                                                    class="number-separator form-control @error('ppn')
                                                        is-invalid
                                                    @enderror"
                                                    name="ppn" id="ppn"
                                                    value="{{ number_format($kwitansis->ppn) }}">
                                                @error('ppn')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-3 col-md-3 col-sm-3">
                                                <label>PPh21</label>
                                                <input type="text"
                                                    class="number-separator form-control @error('pph21')
                                                        is-invalid
                                                    @enderror"
                                                    name="pph21" id="pph21"
                                                    value="{{ number_format($kwitansis->pph21) }}">
                                                @error('pph21')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-3 col-md-3 col-sm-3">
                                                <label>PPh22</label>
                                                <input type="text"
                                                    class="number-separator form-control @error('pph22')
                                                        is-invalid
                                                    @enderror"
                                                    name="pph22" id="pph22"
                                                    value="{{ number_format($kwitansis->pph22) }}">
                                                @error('pph22')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row gutters-sm">
                                            <div class="col-3 col-md-3 col-sm-3">
                                                <label>PPh23</label>
                                                <input type="text"
                                                    class="number-separator form-control @error('pph23')
                                                            is-invalid
                                                        @enderror"
                                                    name="pph23" id="pph23"
                                                    value="{{ number_format($kwitansis->pph23) }}">
                                                @error('pph23')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-3 col-md-3 col-sm-3">
                                                <label>Pajak Daerah</label>
                                                <input type="text"
                                                    class="number-separator form-control @error('pdaerah')
                                                            is-invalid
                                                        @enderror"
                                                    name="pdaerah" id="pdaerah"
                                                    value="{{ number_format($kwitansis->pdaerah) }}">
                                                @error('pdaerah')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-3 col-md-3 col-sm-3">
                                                <label>Sisa</label>
                                                <input type="text"
                                                    class="form-control @error('sisa')
                                                            is-invalid
                                                        @enderror"
                                                    name="sisa" id="sisa"
                                                    value="{{ number_format($kwitansis->sisa) }}">
                                                @error('pph22')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
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

    <script>
        function hitungSisa() {
            var nilai = parseFloat($('#nilai').val().replace(/[^0-9.-]/g, '')) || 0;

            var ppn = parseFloat($('#ppn').val().replace(/[^0-9.-]/g, '')) || 0;
            var pph21 = parseFloat($('#pph21').val().replace(/[^0-9.-]/g, '')) || 0;
            var pph22 = parseFloat($('#pph22').val().replace(/[^0-9.-]/g, '')) || 0;
            var pph23 = parseFloat($('#pph23').val().replace(/[^0-9.-]/g, '')) || 0;
            var pdaerah = parseFloat($('#pdaerah').val().replace(/[^0-9.-]/g, '')) || 0;

            var total_pajak = ppn + pph21 + pph22 + pph23 + pdaerah;

            var sisa = nilai - total_pajak;

            $('#sisa').val(sisa.toLocaleString());
        }

        $(document).ready(function() {
            $('#ppn, #pph21, #pph22, #pph23, #pdaerah').on('input', function() {
                hitungSisa();
            });
        });
    </script>
@endpush
