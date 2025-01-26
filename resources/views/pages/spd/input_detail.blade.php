@extends('layouts.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

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
                                <h4>SP2D</h4>
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
                                                <input type="hidden" id="spd_id" value="{{$spd->id}}">
                                                <input type="text" value="{{$spd->no_spd}}"
                                                    class="form-control"
                                                    name="no_spd" readonly>
                                            </div>
                                            <div class="col-4 col-md-4 col-sm-4">
                                                <label>Tanggal</label>
                                                <input type="text" value="{{$spd->spd_tgl}}"
                                                    class="form-control datepicker"
                                                    name="spd_tgl" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row gutters-sm">
                                            <div class="col-8 col-md-8 col-sm-8">
                                                <label>Uraian</label>
                                                <textarea class="form-control"
                                                    data-height="80" readonly
                                                    name="spd_uraian">{{$spd->spd_uraian}}</textarea>
                                            </div>
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label>Nilai</label>
                                                <input type="text" value="{{ number_format($spd->spd_nilai) }}"
                                                    class="number-separator form-control" readonly
                                                    name="spd_nilai">
                                            </div>
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label>Selisih</label>
                                                <div>
                                                    <h5> <b> Rp. <span id="selisih"></span>,-</b></h5>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Rincian SP2D</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row gutters-sm">
                                        <div class="col-2 col-md-2 col-sm-2">
                                            <label>Cari Pagu</label>
                                            <div class="input-group mb-3">
                                                <input type="hidden" class="form-control" name="kode_pagu"
                                                    id="kode_pagu" readonly>
                                                <input type="text" name="sisa_pagu" id="sisa_pagu"
                                                    class="form-control" readonly>
                                                <div class="input-group-append">
                                                    @foreach ($anggarans as $anggaran)
                                                    @endforeach
                                                    <button type="button" class="btn btn-primary open-modal"
                                                        data-toggle="modal" data-target="#modalAnggaran"
                                                        data-id="{{ $anggaran->id }}">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4 col-md-4 col-sm-4">
                                            <label for="uraian">Uraian</label>
                                            <input type="text" name="uraian" id="uraian" class="form-control"
                                                readonly>
                                        </div>
                                        <div class="col-2 col-md-2 col-sm-2">
                                            <label for="nilai_belanja">Nilai Belanja</label>
                                            <input type="text" name="nilai_belanja" id="nilai_belanja"
                                                class="number-separator form-control" value="0">
                                        </div>
                                        <div class="col-2 col-md-2 col-sm-2">
                                            <label>#</label>
                                            <div class="input-group">
                                                <button type="button" class="btn btn-success" onclick="simpanItem()">
                                                    <i class="fa fa-save"></i> Simpan
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <label>Total</label>
                                            <div id="nilai">
                                                <h5> <b> Rp. <span id="total-belanja"></span>,-</b></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table
                                    class="table table-striped table-responsive-lg table-responsive-md table-responsive-sm table-bordered table-hover dataTable">
                                    <thead>
                                        <tr>
                                            <th>Sub Kegiatan</th>
                                            <th>Rekening</th>
                                            <th>Uraian</th>
                                            <th>Jumlah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detailSpd">
                                    </tbody>
                                </table>
                                <div class="viewmodal" style="display: none;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="modalAnggaran" data-backdrop="static" data-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Anggaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="float-right">
                            <div class="input-group">
                                <input type="text" class="form-control" id="searchAnggaranInput"
                                    placeholder="Cari Anggaran" name="spd_uraian">
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table style="width: 100%"
                        class="table table-striped table-responsive-lg table-responsive-md table-responsive-sm table-bordered table-hover dataTable dtr-inline collapsed">
                        <thead>
                            <tr>
                                <th>Sub Kegiatan</th>
                                <th>Rekening</th>
                                <th>Uraian</th>
                                <th>Pagu</th>
                                <th>Pilih</th>
                            </tr>
                        </thead>
                        <tbody id="anggaranList">
                            <!-- Daftar anggaran akan ditampilkan di sini -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
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
        function kosong() {
            $('#uraian').val('');
            $('#sisa_pagu').val('');
            $('#nilai_belanja').val(0);
        }

        function simpanItem() {
            var spd_id = $('#spd_id').val();
            var anggaran_id = $('#kode_pagu').val();
            var total = $('#nilai_belanja').val();

            if (anggaran_id.length == 0) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-right',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast',
                    },
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                })
                Toast.fire({
                    icon: 'error',
                    title: 'Pagu masih kosong !',
                })
                return;
            } else if (total < 1) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-right',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast',
                    },
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                })
                Toast.fire({
                    icon: 'error',
                    title: 'Nilai belanja belum ada !',
                })
                return;
            } else {
                $.ajax({
                    type: "POST",
                    url: "/spdrinci",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        spd_id: spd_id,
                        anggaran_id: anggaran_id,
                        total: total,
                    },
                    success: function(response) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-right',
                            iconColor: 'white',
                            customClass: {
                                popup: 'colored-toast',
                            },
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                        })
                        Toast.fire({
                            icon: 'success',
                            title: response.message,
                        })
                        loadDetailSpd(spd_id);
                        updateTotalBelanja(spd_id);
                        kosong();
                    },
                    error: function(xhr, status, error) {
                        var jsonResponse = JSON.parse(xhr.responseText);
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-right',
                            iconColor: 'white',
                            customClass: {
                                popup: 'colored-toast',
                            },
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                        })
                        Toast.fire({
                            icon: 'error',
                            title: jsonResponse.message,
                        })
                    }
                });
            }

        }

        function loadDetailSpd(spd_id) {
            $.ajax({
                type: 'GET',
                url: '/spdrinci/' + spd_id,
                data: {
                    spd_id: spd_id
                },
                success: function(response) {
                    $('#detailSpd').empty();

                    $('#total-belanja').text(response.total_belanja.toLocaleString());
                    $('#selisih').text(response.selisih.toLocaleString());

                    $.each(response.detailSpd, function(index, detail) {
                        var newRow =
                            '<tr>' +
                            '<td>' + detail.kode_program + '.' + detail.kode_kegiatan +
                            '.' + detail
                            .kode_sub + ' / ' + detail.nama_sub + '</td>' +
                            '<td>' + detail.kode_rekening + ' / ' + detail.nama_rekening +
                            '</td>' +
                            '<td>' + detail.uraian + '</td>' +
                            '<td>' + detail.total.toLocaleString() + '</td>' +
                            '<td>' +
                            '<button class="btn btn-sm btn-danger btn-hapus" data-id="' +
                            detail.id +
                            '">Hapus</button>' +
                            '</td>' +
                            '</tr>';
                        $('#detailSpd').append(newRow);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function updateTotalBelanja(spd_id) {
            $.ajax({
                type: 'GET',
                url: '/spdrinci/' + spd_id,
                success: function(response) {
                    $('#total-belanja').text(response.total_belanja.toLocaleString());
                    $('#selisih').text(response.selisih.toLocaleString());
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function hapusDetail(detail_id) {
            var spd_id = $('#spd_id').val();
            $.ajax({
                type: 'DELETE',
                url: '/spdrinci/' + detail_id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('.btn-hapus[data-id="' + detail_id + '"]').closest('tr').remove();

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    updateTotalBelanja(spd_id);
                },
                error: function(xhr, status, error) {
                    var jsonResponse = JSON.parse(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: jsonResponse.message,
                    });
                }
            });
        }

        var totalBelanja = document.getElementById('total-belanja').innerText;
        window.addEventListener('DOMContentLoaded', function() {
            var totalBelanja = document.getElementById('total-belanja').innerText;
            document.getElementById('total_belanja_input').value = totalBelanja;
        });


        $(document).ready(function() {
            $(".open-modal").click(function() {
                var anggaranId = $(this).data('id');

                var anggaransData;

                function displayAnggarans(searchTerm) {
                    var anggaranList = $("#anggaranList");
                    anggaranList.empty();

                    var filteredAnggarans = anggaransData.filter(function(anggaran) {
                        return anggaran.uraian.toLowerCase().includes(searchTerm.toLowerCase());
                    });

                    $.each(filteredAnggarans, function(index, anggaran) {
                        var row = $("<tr>");
                        row.append("<td>" + anggaran.nama_sub + "</td>");
                        row.append("<td>" + anggaran.kode_rekening + "</td>");
                        row.append("<td>" + anggaran.uraian + "</td>");
                        row.append("<td>" + anggaran.sisa_pagu.toLocaleString() +
                            "</td>");
                        row.append(
                            '<td><button type="button" class="btn btn-info select-anggaran" data-dismiss="modal" data-selected-id="' +
                            anggaran.id +
                            '">Pilih</button></td>');
                        anggaranList.append(row);
                    });
                }

                $.ajax({
                    type: "GET",
                    url: "/modalcaripagu",
                    success: function(response) {
                        anggaransData = response.data;
                        displayAnggarans("");
                        $("#modalAnggaran").modal('show');
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });

                $("#searchAnggaranInput").on("input", function() {
                    var searchTerm = $(this).val();
                    displayAnggarans(searchTerm);
                });
            });

            $(document).on("click", ".select-anggaran", function() {
                var selectedAnggaranId = $(this).data("selected-id");

                // Set nilai input dengan ID anggaran yang dipilih
                $("#anggaranIdInput").val(selectedAnggaranId);

                // Memunculkan data field berdasarkan ID anggaran
                displayAnggaranData(selectedAnggaranId);
            });

            function displayAnggaranData(anggaranId) {
                $.ajax({
                    type: "GET",
                    url: "/anggaran/" + anggaranId,
                    success: function(response) {
                        $('#kode_pagu').val(response.data.id);
                        $('#uraian').val(response.data.uraian);
                        $('#sisa_pagu').val(response.data.sisa_pagu.toLocaleString());
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            };

            $('.nilai_belanja').select2({
                closeOnSelect: false
            });

            var spd_id = $('#spd_id').val();
            loadDetailSpd(spd_id);

            $('#spd_id').change(function() {
                spd_id = $(this).val();
                loadDetailSpd(spd_id);
            });

            $('#detailSpd').on('click', '.btn-hapus', function() {
                var detail_id = $(this).data('id');

                Swal.fire({
                    title: 'Kamu yakin?',
                    text: 'Data akan dihapus!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        hapusDetail(detail_id);
                    }
                });
            });

        });
    </script>
@endpush
