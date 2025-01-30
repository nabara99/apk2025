@extends('layouts.app')

@section('title', '')

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
                                <h4>Daftar SK</h4>
                                <a href="{{ route('sk.create') }}" class="btn btn-primary">Tambah SK</a>
                            </div>
                            <div class="card-body">
                                <div class="clearfix mb-3"></div>
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>No</th>
                                            <th>Nomor SK</th>
                                            <th>Hal</th>
                                            <th>Penandatangan</th>
                                            <th>File</th>
                                            <th>Aksi</th>
                                        </tr>
                                        @foreach ($sks as $index => $sk)
                                            <tr>
                                                <td>{{ ++$index }}</td>
                                                <td>{{ $sk->number_sk }}</td>
                                                <td>{{ $sk->name_sk }}</td>
                                                <td>{{ $sk->signer }}</td>
                                                <td>
                                                    @if ($sk->scan)
                                                        <div class="badge badge-success"></div>
                                                        <a href="{{ asset($sk->scan) }}" target="_blank" class="ml-2">
                                                            <i class="fas fa-file-pdf"></i> Lihat
                                                        </a>
                                                    @else
                                                        <div class="badge badge-danger">Tidak ada</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-left">
                                                        <a href="{{ route('sk.edit', $sk->id) }}"
                                                            class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>
                                                    </div>
                                                </td>
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
