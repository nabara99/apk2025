<!DOCTYPE html>
<html lang="en">

<?php
use Carbon\Carbon;
setlocale(LC_TIME, 'id_ID');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bendahara</title>
</head>

<body>
    <table style="width: 100%; border-collapse: collapse; text-align: center; font-family: arial; font-size: 8pt;">
        <tr>
            <td colspan="3"><b>PEMERINTAH KABUPATEN TANAH BUMBU</b></td>
        </tr>
        <tr>
            <td colspan="3"><b>LAPORAN PERTANGGUNG JAWABAN UANG PERSEDIAAN</b></td>
        </tr>
        <tr>
            <td colspan="3"><b>BENDAHARA PENGELUARAN</b></td>
        </tr>
        <tr>
            <td width="15%">&nbsp&nbsp&nbsp&nbsp SKPD</td>
            <td width="1%">:</td>
            <td width="50%" style="text-align: left;">Kecamatan Teluk Kepayang</td>
        </tr>
        <tr>
            <td width="15%">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                Tahun Anggaran</td>
            <td width="1%">:</td>
            <td width="50%" style="text-align: left;"><?= date('Y', strtotime($startDate)) ?></td>
        </tr>
        <tr>
            <td colspan="3">
                <br>
                <center>
                    <table border="1" cellpadding="5" style="border-collapse: collapse; border: 1px solid #000; text-align: center; width: 80%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width="30%">Sub Kegiatan</th>
                                <th>Kode Rekening</th>
                                <th>Uraian</th>
                                <th>Jumlah (Rp)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($realisasiBelanja as $index => $realisasi)
                            <tr>
                                <td>{{$index +1}}</td>
                                <td>{{$realisasi->kode_program}}.{{$realisasi->kode_kegiatan}}.{{$realisasi->kode_sub}}</td>
                                <td>{{$realisasi->kode_rekening}}</td>
                                <td style="text-align: left">{{$realisasi->nama_rekening}}</td>
                                <td style="text-align: right">{{number_format($realisasi->total_realisasi) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" style="text-align:right;">Total</td>
                                <td style="text-align: right;">
                                    {{ number_format($realisasiBelanja->sum('total_realisasi')) }}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align:right;">Uang Persediaan Awal Periode</td>
                                <td style="text-align: right;">100.000.000</td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align:right;">Uang Persediaan Akhir Periode</td>
                                <td style="text-align: right;">
                                    {{ number_format(100000000 - $realisasiBelanja->sum('total_realisasi')) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </center>
            </td>
        <tr>
            <td colspan="2"></td>
            <td><br/>Teluk Kepayang, {{ Carbon::parse($endDate)->isoFormat('D MMMM Y') }}</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td>Bendahara Pengeluaran</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td><br/><br/><br/><br/><br/>{{$decision->nama_bp}}</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td>NIP. {{$decision->nip_bp}}</td>
        </tr>
    </table>
</body>

</html>
