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
                    <div class="col-12 col-md-12 col-lg-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Buat Kwitansi</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('kwitansi.index') }}" class="btn btn-primary btn-icon"><i
                                            class="fa-solid fa-arrow-rotate-left"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row gutters-sm">
                                        <div class="col-3 col-md-2 col-sm-2">
                                            <label for="kw_id">No. Kwitansi</label>
                                            <input type="text" name="kw_id" id="kw_id"
                                                value="<?= $item->no_faktur ?>" class="form-control" readonly>
                                        </div>
                                        <div class="col-4 col-md-3 col-sm-3">
                                            <label for="namapenerima">Cari Penerima</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Nama Penerima"
                                                    name="namapenerima" id="namapenerima" readonly>
                                                <input type="hidden" name="idpenerima" id="idpenerima">
                                                <div class="input-group-append">
                                                    @foreach ($penerimas as $penerima)
                                                    @endforeach
                                                    <button type="button" class="btn btn-primary open-modal-penerima"
                                                        data-toggle="modal" data-target="#modalPenerima"
                                                        data-id="{{ $penerima->id ?? '' }}">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3 col-md-2 col-sm-2">
                                            <label for="kode_pagu">Cari Pagu</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" name="kode_pagu" id="kode_pagu"
                                                    readonly>
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
                                        <div class="col-6 col-md-5 col-sm-5">
                                            <label for="uraian">Uraian</label>
                                            <input type="text" name="uraian" id="uraian" class="form-control"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row gutters-sm">
                                        <div class="col-5 col-md-3 col-sm-3">
                                            <label for="sisa_pagu">Anggaran (Rp)</label>
                                            <input type="text" name="sisa_pagu" id="sisa_pagu" class="form-control"
                                                readonly>
                                        </div>
                                        <div class="col-5 col-md-3 col-sm-3">
                                            <label for="nilai_belanja">Nilai Belanja</label>
                                            <input type="text" name="nilai_belanja" id="nilai_belanja"
                                                class="number-separator form-control" value="0">
                                        </div>
                                        <div class="col-4 col-md-3 col-sm-3">
                                            <label for="">#</label>
                                            <div class="input-group">
                                                <button type="button" class="btn btn-success" onclick="simpanItem()">
                                                    <i class="fa fa-save"></i> Simpan
                                                </button>&nbsp
                                                <button class="btn btn-primary" id="btn-simpan-kwitansi">Selesai</button>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <label for="nilai_belanja">Total</label>
                                            <div id="total-belanja-container">
                                                <h4> <b> Rp. <span id="total-belanja"></span>,-</b></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table style="width: 100%"
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
                                    <tbody id="detailKwitansi">
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
    <div class="modal fade" id="modalPenerima" data-backdrop="static" data-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Penerima</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="float-right">
                            <div class="input-group">
                                <input type="text" class="form-control" id="searchPenerimaInput"
                                    placeholder="Cari Penerima" name="nama_penerima">
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
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Rekening</th>
                                <th>Alamat</th>
                                <th>Pilih</th>
                            </tr>
                        </thead>
                        <tbody id="penerimaList">
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-simpan-kwitansi" data-backdrop="static" data-keyboard="false" tabindex="-1"
        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Simpan Kwitansi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6">
                                <label for="kwitansi_id">Nomor Kwitansi</label>
                                <input type="text" class="form-control" id="kwitansi_id" name="kwitansi_id" readonly>
                                <input type="hidden" class="form-control" id="idpenerima" name="idpenerima" readonly>
                                <input type="hidden" class="form-control" id="anggaran_id" name="anggaran_id" readonly>
                            </div>
                            <div class="col-6">
                                <label for="total_belanja">Total Pembayaran</label>
                                <input type="text" class="form-control" id="total_belanja" name="total_belanja"
                                    readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tgl">Tanggal</label>
                        <input type="text" class="form-control datepicker" id="tgl" name="tgl">
                    </div>
                    <div class="form-group">
                        <label for="hal">Uraian</label>
                        <input type="text" class="form-control" id="hal" name="hal">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6"><label for="ppn">PPN</label>
                                <input type="text" class="number-separator form-control" id="ppn"
                                    name="ppn">
                            </div>
                            <div class="col-6"><label for="pph21">PPh 21</label>
                                <input type="text" class="number-separator form-control" id="pph21"
                                    name="pph21">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6"><label for="pph22">PPh 22</label>
                                <input type="text" class="number-separator form-control" id="pph22"
                                    name="pph22">
                            </div>
                            <div class="col-6"><label for="pph23">PPh 23</label>
                                <input type="text" class="number-separator form-control" id="pph23"
                                    name="pph23">
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-6"> <label for="pajakdaerah">Pajak Daerah</label>
                                <input type="text" class="number-separator form-control" id="pajakdaerah"
                                    name="pajakdaerah">
                            </div>
                            <div class="col-6">
                                <label for="sisa">Sisa Pembayaran</label>
                                <input type="text" class="form-control" id="sisa" name="sisa" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="btn-simpan">Simpan</button>
                </div>
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
            // $('#kode_pagu').val('');
            $('#uraian').val('');
            $('#sisa_pagu').val('');
            $('#nilai_belanja').val(0);
        }

        function simpanItem() {
            var kwitansi_id = $('#kw_id').val();
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
                    url: "/tempkwitansi",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        kwitansi_id: kwitansi_id,
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
                        loadDetailKwitansi(kwitansi_id);
                        updateTotalBelanja(kwitansi_id);
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
                            timer: 2000,
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

        function loadDetailKwitansi(kwitansi_id) {
            $.ajax({
                type: 'GET',
                url: '/tempkwitansi/' + kwitansi_id,
                data: {
                    kwitansi_id: kwitansi_id
                },
                success: function(response) {
                    $('#detailKwitansi').empty();

                    $('#total-belanja').text(response.total_belanja.toLocaleString());

                    $.each(response.detailKwitansi, function(index, detail) {
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
                        $('#detailKwitansi').append(newRow);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function updateTotalBelanja(kwitansi_id) {
            $.ajax({
                type: 'GET',
                url: '/tempkwitansi/' + kwitansi_id,
                success: function(response) {
                    $('#total-belanja').text(response.total_belanja.toLocaleString());
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function hapusDetail(detail_id) {
            var kwitansi_id = $('#kw_id').val();
            $.ajax({
                type: 'DELETE',
                url: '/tempkwitansi/' + detail_id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('.btn-hapus[data-id="' + detail_id + '"]').closest('tr').remove();

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
                    updateTotalBelanja(kwitansi_id);
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

        function hitungSisa() {
            var total_belanja = parseFloat($('#total_belanja').val().replace(/[^0-9.-]/g, '')) || 0;

            var ppn = parseFloat($('#ppn').val().replace(/[^0-9.-]/g, '')) || 0;
            var pph21 = parseFloat($('#pph21').val().replace(/[^0-9.-]/g, '')) || 0;
            var pph22 = parseFloat($('#pph22').val().replace(/[^0-9.-]/g, '')) || 0;
            var pph23 = parseFloat($('#pph23').val().replace(/[^0-9.-]/g, '')) || 0;
            var pajakdaerah = parseFloat($('#pajakdaerah').val().replace(/[^0-9.-]/g, '')) || 0;

            var total_pajak = ppn + pph21 + pph22 + pph23 + pajakdaerah;

            var sisa_pembayaran = total_belanja - total_pajak;

            $('#sisa').val(sisa_pembayaran.toLocaleString());
        }

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

            $(".open-modal-penerima").click(function() {
                var penerimaId = $(this).data('id');

                var penerimasData;

                function displayPenerimas(searchTerm) {
                    var penerimaList = $("#penerimaList");
                    penerimaList.empty();

                    var filteredPenerimas = penerimasData.filter(function(penerima) {
                        return penerima.nama_penerima.toLowerCase().includes(searchTerm
                            .toLowerCase());
                    });

                    // Tampilkan data penerima yang sesuai dengan hasil pencarian
                    $.each(filteredPenerimas, function(index, penerima) {
                        var row = $("<tr>");
                        row.append("<td>" + penerima.nama_penerima + "</td>");
                        row.append("<td>" + penerima.jabatan_penerima + "</td>");
                        row.append("<td>" + penerima.rek_bank + "</td>");
                        row.append("<td>" + penerima.alamat + "</td>");
                        row.append(
                            '<td><button type="button" class="btn btn-info select-penerima" data-dismiss="modal" data-selected-id="' +
                            penerima.id +
                            '">Pilih</button></td>');
                        penerimaList.append(row);
                    });
                }

                $.ajax({
                    type: "GET",
                    url: "/modalcaripenerima",
                    success: function(response) {
                        penerimasData = response.data;

                        displayPenerimas("");


                        $("#modalPenerima").modal('show');
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
                // Fungsi untuk menangani perubahan pada input pencarian
                $("#searchPenerimaInput").on("input", function() {
                    var searchTerm = $(this).val();
                    displayPenerimas(searchTerm);
                });
            });

            $(document).on("click", ".select-penerima", function() {
                var selectedPenerimaId = $(this).data("selected-id");

                $("#penerimaIdInput").val(selectedPenerimaId);

                displayPenerimaData(selectedPenerimaId);
            });

            function displayPenerimaData(penerimaId) {
                $.ajax({
                    type: "GET",
                    url: "/penerima/" + penerimaId,
                    success: function(response) {
                        $('#idpenerima').val(response.data.id);
                        $('#namapenerima').val(response.data.nama_penerima);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            };

            $('.nilai_belanja').select2({
                closeOnSelect: false
            });

            var kwitansi_id = $('#kw_id').val();
            loadDetailKwitansi(kwitansi_id);

            $('#kw_id').change(function() {
                kwitansi_id = $(this).val();
                loadDetailKwitansi(kwitansi_id);
            });

            $('#detailKwitansi').on('click', '.btn-hapus', function() {
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

            $('#btn-simpan-kwitansi').click(function() {
                var kwitansi_id = $('#kw_id').val();
                var idpenerima = $('#idpenerima').val();
                var anggaran_id = $('#kode_pagu').val();

                if ($('#idpenerima').val() === '') {
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
                        title: 'Penerima belum ada !',
                    })
                    return;
                }

                $.ajax({
                    type: 'GET',
                    url: '/tempkwitansi/' + kwitansi_id,
                    success: function(response) {
                        var total_belanja = response.total_belanja;
                        var penerima = idpenerima;

                        $('#total_belanja').val(total_belanja.toLocaleString());
                        $('#penerima').val(penerima);
                        $('#kwitansi_id').val(kwitansi_id);
                        $('#anggaran_id').val(anggaran_id);

                        $('#modal-simpan-kwitansi').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#ppn, #pph21, #pph22, #pph23, #pajakdaerah').on('input', function() {
                hitungSisa();
            });

            $('#btn-simpan').click(function() {
                var kwitansi_id = $('#kwitansi_id').val();
                var idpenerima = $('#idpenerima').val();
                var total_belanja = $('#total_belanja').val();
                var tgl = $('#tgl').val();
                var hal = $('#hal').val();
                var ppn = $('#ppn').val();
                var pph21 = $('#pph21').val();
                var pph22 = $('#pph22').val();
                var pph23 = $('#pph23').val();
                var pajakdaerah = $('#pajakdaerah').val();
                var sisa = $('#sisa').val();
                var anggaran_id = $('#anggaran_id').val();

                if (!uraian || sisa == '') {
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
                        title: 'Uraian dan pajak harus diisi !',
                    })
                    return;
                }
                $.ajax({
                    type: "POST",
                    url: "/kwitansi",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        kwitansi_id: kwitansi_id,
                        idpenerima: idpenerima,
                        total_belanja: total_belanja,
                        tgl: tgl,
                        hal: hal,
                        ppn: ppn,
                        pph21: pph21,
                        pph22: pph22,
                        pph23: pph23,
                        pajakdaerah: pajakdaerah,
                        sisa: sisa,
                        anggaran_id: anggaran_id,
                    },
                    success: function(response) {
                        if (response.message) {
                            Swal.fire({
                                title: 'Cetak Kwitansi',
                                text: response.message + " , cetak kwitansi?",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya, cetak'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    var windowCetak = window.open('/kwitansi/' +
                                        kwitansi_id,
                                        "Cetak Kwitansi",
                                        "width=1200, height=800");
                                    windowCetak.focus();
                                    window.location.reload();
                                } else {
                                    window.location.reload();
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-right',
                            iconColor: 'white',
                            customClass: {
                                popup: 'colored-toast',
                            },
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true,
                        });
                        Toast.fire({
                            icon: 'error',
                            title: xhr.responseText,
                        });
                    }
                });

            });

        });
    </script>
@endpush
