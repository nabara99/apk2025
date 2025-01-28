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
                                <h4>Daftar Anggaran | Pagu Anggaran = Rp. {{ number_format($total_pagu) }}.-</h4>
                                <a href="{{ route('anggaran.create') }}" class="btn btn-primary">Tambah Anggaran</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table-striped table" id="table-1">
                                        <thead>
                                            <tr>
                                                <th>Sub Kegiatan</th>
                                                <th>Kode & Nama Rekening</th>
                                                <th>Uraian</th>
                                                <th>Pagu (Rp)</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($anggarans as $anggaran)
                                                <tr>
                                                    <td>{{ $anggaran->sub->nama_sub }}</td>
                                                    <td>{{ $anggaran->rekening->kode_rekening }}<br />{{ $anggaran->rekening->nama_rekening }}
                                                    </td>
                                                    <td>{{ $anggaran->uraian }}</td>
                                                    <td>{{ number_format($anggaran->pagu) }}</td>
                                                    <td>
                                                        <a href="{{ route('anggaran.edit', $anggaran->id) }}"
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>
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
