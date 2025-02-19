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
                                <h4>Edit Data KIB</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('kib.index') }}" class="btn btn-primary btn-icon"><i
                                        class="fa-solid fa-arrow-rotate-left" title="kembali"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('kib.update', $kib->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="">Nama Barang</label>
                                                <input type="text"
                                                    class="form-control @error('name')
                                                is-invalid @enderror"
                                                    name="name" value="{{ $kib->name }}">
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-4">
                                                <label for="">Merk</label>
                                                <input type="text"
                                                    class="form-control @error('merk')
                                                is-invalid @enderror"
                                                    name="merk" value="{{ $kib->merk }}">
                                                @error('merk')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-4">
                                                <label for="">Tipe</label>
                                                <input type="text"
                                                    class="form-control @error('tipe')
                                                is-invalid @enderror"
                                                    name="tipe" value="{{ $kib->tipe }}">
                                                @error('tipe')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-3">
                                                <label for="">Harga</label>
                                                <input type="number"
                                                    class="form-control @error('price')
                                                is-invalid @enderror"
                                                    name="price" value="{{ $kib->price }}">
                                                @error('price')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-4">
                                                <label for="">Pemegang/ Lokasi</label>
                                                <input type="text"
                                                    class="form-control @error('place')
                                                is-invalid @enderror"
                                                    name="place" value="{{ $kib->place }}">
                                                @error('place')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-3">
                                                <label for="">Kode Barang</label>
                                                <input type="text"
                                                    class="form-control @error('code')
                                                is-invalid @enderror"
                                                    name="code" value="{{ $kib->code }}">
                                                @error('code')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="col-2">
                                                <label for="">Tahun</label>
                                                <input type="text"
                                                    class="form-control @error('year')
                                                is-invalid @enderror"
                                                    name="year" value="{{ $kib->year }}">
                                                @error('year')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label">Status</div>
                                        <div class="selectgroup w-100">
                                            <label class="selectgroup-item">
                                                <input type="radio" name="condition" value="Baik"
                                                    class="selectgroup-input"
                                                    @if ($kib->condition == 'Baik') checked @endif>
                                                <span class="selectgroup-button">Baik</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="condition" value="Rusak Ringan"
                                                    class="selectgroup-input"
                                                    @if ($kib->condition == 'Rusak Ringan') checked @endif>
                                                <span class="selectgroup-button">Rusak Ringan</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" name="condition" value="Rusak Berat"
                                                    class="selectgroup-input"
                                                    @if ($kib->condition == 'Rusak Berat') checked @endif>
                                                <span class="selectgroup-button">Rusak Berat</span>
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
@endpush
