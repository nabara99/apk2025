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
                                            <div class="col-3 col-md-2 col-sm-2">
                                                <label for="kw_id">No. Kwitansi</label>
                                                <input type="text" name="kw_id" id="kw_id"
                                                    value="<?= $kwitansis->kw_id ?>" class="form-control" readonly>
                                            </div>
                                            <div class="col-6 col-md-6 col-sm-6">
                                                <label for="namaanggaran">Anggaran</label>
                                                <div class="input-group mb-3">
                                                    <select
                                                        class="form-control select2 select2-hidden-accessible @error('anggaran_id')
                                                        is-invalid
                                                    @enderror"
                                                        style="width: 100%;" tabindex="-1" aria-hidden="true"
                                                        name="anggaran_id">
                                                        <option value="{{ $kwitansis->anggaran_id }}">
                                                            {{ $kwitansis->anggaran->sub->nama_sub }} |
                                                            {{ $kwitansis->anggaran->rekening->kode_rekening }} |
                                                            {{ $kwitansis->anggaran->uraian }}
                                                        </option>
                                                        @foreach ($anggarans as $anggaran)
                                                            <option value="{{ $anggaran->id }}"
                                                                {{ old('anggaran_id') == $anggaran->id ? 'selected' : '' }}>
                                                                {{ $anggaran->sub->nama_sub }} |
                                                                {{ $anggaran->rekening->kode_rekening }} |
                                                                {{ $anggaran->uraian }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('anggaran_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-5 col-md-4 col-sm-4">
                                                <label for="namapenerima">Penerima</label>
                                                <div class="input-group mb-3">
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
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row gutters-sm">
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label for="tgl">Tanggal</label>
                                                <input type="text" class="form-control datepicker" id="tgl"
                                                    name="tgl" value="{{ $kwitansis->tgl }}">
                                            </div>
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label for="nilai">Total Pembayaran</label>
                                                <input type="text" class="number-separator form-control" id="nilai"
                                                    name="nilai" value="{{ number_format($kwitansis->nilai) }}">
                                            </div>
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label for="ppn">PPN</label>
                                                <input type="text" class="number-separator form-control" id="ppn"
                                                    name="ppn" value="{{ number_format($kwitansis->ppn) }}">
                                            </div>
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label for="pph21">PPh 21</label>
                                                <input type="text" class="number-separator form-control" id="pph21"
                                                    name="pph21" value="{{ number_format($kwitansis->pph21) }}">
                                            </div>
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label for="pph22">PPh 22</label>
                                                <input type="text" class="number-separator form-control" id="pph22"
                                                    name="pph22" value="{{ number_format($kwitansis->pph22) }}">
                                            </div>
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label for="pph23">PPh 23</label>
                                                <input type="text" class="number-separator form-control" id="pph23"
                                                    name="pph23" value="{{ number_format($kwitansis->pph23) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row gutters-sm">
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label for="pdaerah">Pajak Daerah</label>
                                                <input type="text" class="number-separator form-control"
                                                    id="pdaerah" name="pdaerah"
                                                    value="{{ number_format($kwitansis->pdaerah) }}">
                                            </div>
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label for="sisa">Sisa</label>
                                                <input type="text" class="form-control" id="sisa" name="sisa"
                                                    value="{{ number_format($kwitansis->sisa) }}" readonly>
                                            </div>
                                            <div class="col-10 col-md-8 col-sm-8">
                                                <label for="uraian">Uraian</label>
                                                <textarea name="hal" id="hal" data-height="100" class="form-control">{{ $kwitansis->hal }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12 col-md-12 col-sm-12">
                                                <label for="file">Link</label>
                                                <input type="text" class="form-control" id="file" name="file"
                                                    value="{{ $kwitansis->file }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit"
                                            class="btn btn-primary btn-lg btn-icon icon-right">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Rincian Kwitansi</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row gutters-sm">
                                        <div class="col-2 col-md-2 col-sm-2">
                                            <label for="kode_pagu">Cari Pagu</label>
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
                                            <label for="">#</label>
                                            <div class="input-group">
                                                <button type="button" class="btn btn-success" onclick="simpanItem()">
                                                    <i class="fa fa-save"></i> Simpan
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <label>Total</label>
                                            <div id="nilai">
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

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
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
            var total_belanja = parseFloat($('#nilai').val().replace(/[^0-9.-]/g, '')) || 0;

            var ppn = parseFloat($('#ppn').val().replace(/[^0-9.-]/g, '')) || 0;
            var pph21 = parseFloat($('#pph21').val().replace(/[^0-9.-]/g, '')) || 0;
            var pph22 = parseFloat($('#pph22').val().replace(/[^0-9.-]/g, '')) || 0;
            var pph23 = parseFloat($('#pph23').val().replace(/[^0-9.-]/g, '')) || 0;
            var pdaerah = parseFloat($('#pdaerah').val().replace(/[^0-9.-]/g, '')) || 0;

            var total_pajak = ppn + pph21 + pph22 + pph23 + pdaerah;

            var sisa_pembayaran = total_belanja - total_pajak;

            $('#sisa').val(sisa_pembayaran.toLocaleString());
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

            $('#ppn, #pph21, #pph22, #pph23, #pdaerah').on('input', function() {
                hitungSisa();
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

        });
    </script>
@endpush
