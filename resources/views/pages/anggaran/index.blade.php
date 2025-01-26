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
                                <h4>Daftar Anggaran | Pagu Anggaran = Rp. {{ number_format($total_pagu) }}.-</h4>
                                <a href="{{ route('anggaran.create') }}" class="btn btn-primary">Tambah Anggaran</a>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari anggaran"
                                                name="uraian">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="clearfix mb-3"></div>
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>Sub Kegiatan</th>
                                            <th>Kode & Nama Rekening</th>
                                            <th>Uraian</th>
                                            <th>Pagu (Rp)</th>
                                            <th>Aksi</th>
                                        </tr>
                                        @foreach ($anggarans as $anggaran)
                                            <tr>
                                                <td>{{ $anggaran->sub->nama_sub }}</td>
                                                <td>{{ $anggaran->rekening->kode_rekening }}<br />{{ $anggaran->rekening->nama_rekening }}
                                                </td>
                                                <td>{{ $anggaran->uraian }}</td>
                                                <td>{{ number_format($anggaran->pagu) }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-left">
                                                        <a href="{{ route('anggaran.edit', $anggaran->id) }}"
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>
                                                        {{-- <form action="{{ route('anggaran.destroy', $anggaran->id) }}"
                                                            method="POST" class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}" />
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete"
                                                                onclick="return confirm('Yakin menghapus data?')">
                                                                <i class="fas fa-times"></i> Hapus
                                                            </button>
                                                        </form> --}}
                                                    </div>
                                                </td>
                                            </tr>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $anggarans->withQueryString()->links() }}
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
