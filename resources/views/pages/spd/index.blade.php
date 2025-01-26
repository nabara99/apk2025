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
                                <h4>Daftar SP2D</h4>
                                <a href="{{ route('spd.create') }}" class="btn btn-primary">Tambah SP2D</a>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari SP2D"
                                                name="spd_uraian">
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
                                            <th>Nomor</th>
                                            <th>Tanggal</th>
                                            <th>Uraian</th>
                                            <th>Nilai (Rp)</th>
                                            <th>Aksi</th>
                                        </tr>
                                        @foreach ($spds as $spd)
                                            <tr>
                                                <td>{{ $spd->no_spd }}</td>
                                                <td>{{ date('d F Y', strtotime($spd->spd_tgl)) }}</td>
                                                <td>{{ $spd->spd_uraian }}</td>
                                                <td>{{ number_format($spd->spd_nilai) }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-left">
                                                        <a href="{{ route('spd.edit', $spd->id) }}" title="Edit"
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                        </a>&nbsp;
                                                        @if ($spd->jenis == 'LS')
                                                            <a href="{{ route('detail', $spd->id) }}" title="Rincian"
                                                                class="btn btn-sm btn-warning btn-icon">
                                                                <i class="fa-solid fa-list"></i>
                                                            </a>
                                                        @endif  &nbsp;
                                                        @if ($spd->pph21 || $spd->ppn)
                                                            <a href="{{ route('tax', $spd->id) }}" title="Input Pajak"
                                                                class="btn btn-sm btn-success btn-icon">
                                                                <i class="fa-solid fa-dollar"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $spds->withQueryString()->links() }}
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
