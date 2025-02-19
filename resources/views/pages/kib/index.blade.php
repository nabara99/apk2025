@extends('layouts.app')

@section('title', '')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/datatables/media/css/jquery.dataTables.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-8"></div>
                    <div class="col-4">
                        @include('layouts.alert')
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Daftar Barang</h4>
                                <form action="{{ route('kib.upload') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group">
                                        <input type="file" name="file" class="form-control" accept=".xlsx" required>
                                        <div class="input-group-append">
                                            <button class="btn btn-success">Upload</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama</th>
                                                <th>Merk/Tipe</th>
                                                <th>Kode</th>
                                                <th>Harga Perolehan</th>
                                                <th>Kondisi</th>
                                                <th>Pemegang/Lokasi</th>
                                                <th>Tahun</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kibs as $kib)
                                                <tr>
                                                    <td>{{ $kib->id }}</td>
                                                <td>{{ $kib->name }}</td>
                                                <td>{{ $kib->merk }}/{{ $kib->tipe }}</td>
                                                <td>{{ $kib->code }}</td>
                                                <td>{{ number_format($kib->price, '0', '.', '.') }}</td>
                                                <td>{{ $kib->condition }}</td>
                                                <td>{{ $kib->place }}</td>
                                                <td>{{ $kib->year }}</td>
                                                <td>
                                                    <a href="{{ route('kib.edit', $kib->id) }}" class="btn btn-sm btn-warning"
                                                        title="Edit">
                                                        <i class="fa fa-edit"></i></a>
                                                    {{-- <a href="{{ route('kib.generate.qr', $kib->id) }}" class="btn btn-sm"
                                                        title="Generate QR Code">
                                                        <i class="fa-solid fa-barcode"></i>
                                                    </a> --}}
                                                </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
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

    <script src="{{ asset('library/datatables/media/js/jquery.dataTables.min.js') }}"></script>

    <script src="{{ asset('library/jquery-ui-dist/jquery-ui.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/modules-datatables.js') }}"></script>
@endpush
