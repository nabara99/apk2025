@extends('layouts.app')

@section('title', '')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Pengelola Keuangan</h4>
                                <a href="{{ route('pengelola.create') }}" class="btn btn-primary">Tambah Pengelola</a>
                            </div>
                            <div class="card-body">
                                <div class="clearfix mb-3"></div>
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>NIP</th>
                                            <th>Nama</th>
                                            <th>Aksi</th>
                                        </tr>
                                        @foreach ($pengelolas as $pengelola)
                                            <tr>
                                                <td>{{ $pengelola->nip_pa }}</td>
                                                <td>{{ $pengelola->nama_pa }}</td>
                                                <td>{{ $pengelola->nip_bp }}</td>
                                                <td>{{ $pengelola->nama_bp }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-left">
                                                        <a href="{{ route('pengelola.edit', $pengelola->id) }}"
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tr>
                                        @endforeach
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
@endpush
