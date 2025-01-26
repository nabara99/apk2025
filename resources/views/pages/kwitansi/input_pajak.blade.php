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
                                <h4>Kwitansi</h4>
                                <div class="card-header-action">
                                    <a href="{{ route('kwitansi.index') }}" class="btn btn-primary btn-icon"><i
                                            class="fa-solid fa-arrow-rotate-left"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-2 col-md-2 col-sm-2">
                                            <label for="kwi_id">Nomor</label>
                                            <input type="text" value="{{$kwitansi->kw_id}}"
                                                class="form-control" id="kwi_id"
                                                name="kwi_id" readonly>
                                        </div>
                                        <div class="col-2 col-md-2 col-sm-2">
                                            <label for="tgl">Tanggal</label>
                                            <input type="text" value="{{$kwitansi->tgl}}"
                                                class="form-control datepicker" id="tgl"
                                                name="tgl" readonly>
                                        </div>
                                        <div class="col-6 col-md-6 col-sm-6">
                                            <label for="hal">Uraian</label>
                                            <textarea class="form-control"
                                                data-height="80" readonly id="hal"
                                                name="hal">{{$kwitansi->hal}}</textarea>
                                        </div>
                                        <div class="col-2 col-md-2 col-sm-2">
                                            <label for="nilai">Nilai</label>
                                            <input type="text" value="{{ number_format($kwitansi->nilai) }}"
                                                class="number-separator form-control" readonly id="nilai"
                                                name="nilai">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Rincian Pajak</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-md-12 col-sm-12">
                                            <label for="spd_id">Cari SP2D</label>
                                            <select
                                                class="form-control select2 select2-hidden-accessible @error('spd_id')
                                                is-invalid
                                            @enderror"
                                                style="width: 100%;" tabindex="-1" aria-hidden="true" name="spd_id" id="spd_id">
                                                <option value="" selected disabled>--Pilih SP2D--</option>
                                                @foreach ($spds as $spd)
                                                    <option value="{{ $spd->id }}"
                                                        {{ old('spd_id') == $spd->id ? 'selected' : '' }}>
                                                        {{ $spd->no_spd }} {{ $spd->spd_uraian }} tanggal {{ $spd->spd_tgl }}</option>
                                                @endforeach
                                            </select>
                                            @error('spd_id')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-3 col-md-3 col-sm-3">
                                            <label for="billing">Kode Billing</label>
                                            <input type="text" name="billing" id="billing" class="form-control">
                                        </div>
                                        <div class="col-3 col-md-3 col-sm-3">
                                            <label for="ntpn">NTPN</label>
                                            <input type="text" name="ntpn" id="ntpn" class="form-control">
                                        </div>
                                        <div class="col-3 col-md-3 col-sm-3">
                                            <label for="ntb">NTB</label>
                                            <input type="text" name="ntb" id="ntb" class="form-control">
                                        </div>
                                        <div class="col-2 col-md-2 col-sm-2">
                                            <label for="tgl_setor">Tanggal Bayar</label>
                                            <input type="text" name="tgl_setor" id="tgl_setor"
                                                class="form-control datepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        @if($kwitansi->ppn > 1)
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label for="ppn">PPN</label>
                                                <div class="input-group">
                                                    <button class="btn btn-warning" id="ppn">{{number_format($kwitansi->ppn)}}</button>
                                                </div>
                                            </div>
                                            <script>
                                                document.getElementById('ppn').addEventListener('click', function () {
                                                    setNilaiPajak({{ $kwitansi->ppn }}, 'PPN');
                                                });
                                            </script>
                                        @endif
                                        @if($kwitansi->pph21 > 1)
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label for="pph21">PPh 21</label>
                                                <div class="input-group">
                                                    <button class="btn btn-warning" id="pph21">{{number_format($kwitansi->pph21)}}</button>
                                                </div>
                                            </div>
                                            <script>
                                                document.getElementById('pph21').addEventListener('click', function () {
                                                    setNilaiPajak({{ $kwitansi->pph21 }}, 'PPh21');
                                                });
                                            </script>
                                        @endif
                                        @if($kwitansi->pph22 > 1)
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label for="pph22">PPh 22</label>
                                                <div class="input-group">
                                                    <button class="btn btn-info" id="pph22">{{number_format($kwitansi->pph22)}}</button>
                                                </div>
                                            </div>
                                            <script>
                                                document.getElementById('pph22').addEventListener('click', function () {
                                                    setNilaiPajak({{ $kwitansi->pph22 }}, 'PPh22');
                                                });
                                            </script>
                                        @endif
                                        @if($kwitansi->pph23 > 1)
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label for="pph23">PPh 23</label>
                                                <div class="input-group">
                                                    <button class="btn btn-warning" id="pph23">{{number_format($kwitansi->pph23)}}</button>
                                                </div>
                                            </div>
                                            <script>
                                                document.getElementById('pph23').addEventListener('click', function () {
                                                    setNilaiPajak({{ $kwitansi->pph23 }}, 'PPh23');
                                                });
                                            </script>
                                        @endif
                                        @if($kwitansi->pdaerah > 1)
                                            <div class="col-2 col-md-2 col-sm-2">
                                                <label for="pdaerah">Pajak Daerah</label>
                                                <div class="input-group">
                                                    <button class="btn btn-info" id="pdaerah">{{number_format($kwitansi->pdaerah)}}</button>
                                                </div>
                                            </div>
                                            <script>
                                                document.getElementById('pdaerah').addEventListener('click', function () {
                                                    setNilaiPajak({{ $kwitansi->pdaerah }}, 'Pdaerah');
                                                });
                                            </script>
                                        @endif
                                        <div class="col-2 col-md-2 col-sm-2">
                                            <label for="nilai_pajak">Nilai Pajak</label>
                                            <input type="text" name="nilai_pajak" id="nilai_pajak"
                                                class="number-separator form-control" value="0" readonly>
                                        </div>
                                            <input type="hidden" name="jenis_pajak" id="jenis_pajak"
                                                class="form-control" readonly>
                                        <div class="col-2 col-md-2 col-sm-2">
                                            <label for="simpan_item">#</label>
                                            <div class="input-group">
                                                <button type="button" class="btn btn-success" id="simpan_item" onclick="simpanItem()">
                                                    <i class="fa fa-save"></i> Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table style="width: 100%"
                                    class="table table-striped table-responsive-lg table-responsive-md table-responsive-sm table-bordered table-hover dataTable">
                                    <thead>
                                        <tr>
                                            <th>Uraian</th>
                                            <th>Jenis</th>
                                            <th>Billing</th>
                                            <th>NTPN</th>
                                            <th>NTB</th>
                                            <th>Tgl Setor</th>
                                            <th>Nilai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="pajakKwitansi">
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
        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join('');
            var ribuan = reverse.match(/\d{1,3}/g);
            var formatted = ribuan.join(',').split('').reverse().join('');
            return formatted;
        }

        function setNilaiPajak(nilai, jenis) {
            document.getElementById('nilai_pajak').value = formatRupiah(nilai);
            document.getElementById('jenis_pajak').value = jenis;
        }

        function kosong() {
            $('#billing').val('');
            $('#ntpn').val('');
            $('#ntb').val('');
            $('#nilai_pajak').val(0);
        }

        function simpanItem() {
            var spd_id = document.getElementById('spd_id').value;
            var kwi_id = document.getElementById('kwi_id').value;
            var uraian_pajak = document.getElementById('hal').value;
            var nilai_pajak = document.getElementById('nilai_pajak').value;
            var billing = document.getElementById('billing').value;
            var ntpn = document.getElementById('ntpn').value;
            var tgl_setor = document.getElementById('tgl_setor').value;
            var ntb = document.getElementById('ntb').value;
            var jenis_pajak = document.getElementById('jenis_pajak').value;

            if (!spd_id) {
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
                    title: 'SP2D belum dipilih !',
                })
                return;
            } else if (!billing) {
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
                    title: 'Billing belum diisi !',
                })
                return;
            } else if (!ntpn) {
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
                    title: 'NTPN belum diisi !',
                })
                return;
            } else if (!ntb) {
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
                    title: 'NTB belum diisi !',
                })
                return;
            } else if (nilai_pajak == 0) {
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
                    title: 'Tombol Pajak belum diklik !',
                })
                return;
            } else {
                $.ajax({
                    type: "POST",
                    url: "/pajak-kwitansi",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        spd_id: spd_id,
                        kwi_id: kwi_id,
                        uraian_pajak: uraian_pajak,
                        nilai_pajak: nilai_pajak,
                        billing: billing,
                        ntpn: ntpn,
                        tgl_setor: tgl_setor,
                        ntb: ntb,
                        jenis_pajak: jenis_pajak,
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
                        kosong();
                        loadPajakKwitansi(kwi_id);
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

        function loadPajakKwitansi(kwi_id) {
            $.ajax({
                type: 'GET',
                url: '/pajak-kwitansi/' + kwi_id,
                data: {
                    kwi_id: kwi_id
                },
                success: function(response) {
                    $('#pajakKwitansi').empty();

                    $.each(response.pajakKwitansi, function(index, pajak) {
                        var newRow =
                            '<tr>' +
                            '<td>' + pajak.uraian_pajak + '</td>' +
                            '<td>' + pajak.jenis_pajak + '</td>' +
                            '<td>' + pajak.billing + '</td>' +
                            '<td>' + pajak.ntpn + '</td>' +
                            '<td>' + pajak.ntb + '</td>' +
                            '<td>' + pajak.tgl_setor + '</td>' +
                            '<td>' + pajak.nilai_pajak.toLocaleString() + '</td>' +
                            '<td>' +
                            '<button class="btn btn-sm btn-danger btn-hapus" data-id="' +
                            pajak.id +
                            '">Hapus</button>' +
                            '</td>' +
                            '</tr>';
                        $('#pajakKwitansi').append(newRow);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        function hapusPajak(pajak_id) {
            var kwi_id = $('#kwi_id').val();
            $.ajax({
                type: 'DELETE',
                url: '/pajak-kwitansi/' + pajak_id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('.btn-hapus[data-id="' + pajak_id + '"]').closest('tr').remove();

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

    $(document).ready(function() {
        var kwi_id = $('#kwi_id').val();
        loadPajakKwitansi(kwi_id);

        $('#kwi_id').change(function() {
            kwi_id = $(this).val();
            loadPajakKwitansi(kwi_id);
        });

        $('#pajakKwitansi').on('click', '.btn-hapus', function() {
            var pajak_id = $(this).data('id');

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
                    hapusPajak(pajak_id);
                }
            });
        });
    });

    </script>
@endpush
