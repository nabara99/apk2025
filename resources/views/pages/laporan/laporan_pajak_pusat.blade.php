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
    <title>Laporan Pajak Pusat</title>
</head>

<body>
    <table style="width: 100%; border-collapse: collapse; text-align: center; font-family: arial; font-size: 8pt;">
        <tr>
            <td colspan="3"><b>PEMERINTAH KABUPATEN TANAH BUMBU</b></td>
        </tr>
        <tr>
            <td colspan="3"><b>LAPORAN PAJAK PUSAT</b></td>
        </tr>
        <tr>
            <td colspan="3"><b>Periode {{ Carbon::parse($startDate)->isoFormat('D MMMM Y') }} s.d. {{ Carbon::parse($endDate)->isoFormat('D MMMM Y') }}</b></td>
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
                                <th>SP2D</th>
                                <th>Uraian</th>
                                <th>Jenis Pajak</th>
                                <th>Kode Billing</th>
                                <th>Tgl Bayar</th>
                                <th>NTPN</th>
                                <th>NTB</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalNilaiPajak = 0;
                                $no = 1;
                            @endphp
                            @foreach ($pajakPusat as $pajak)
                                @if ($pajak->jenis_pajak != 'Pdaerah')
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{ $pajak->no_spd }}</td>
                                        <td style="text-align: left;">{{ $pajak->jenis_pajak }} atas {{ $pajak->uraian_pajak }}</td>
                                        <td>{{ $pajak->jenis_pajak }}</td>
                                        <td>{{ $pajak->billing }}</td>
                                        <td>{{ Carbon::parse($pajak->tgl_setor)->isoFormat('D MMMM Y') }}</td>
                                        <td>{{ $pajak->ntpn }}</td>
                                        <td>{{ $pajak->ntb }}</td>
                                        <td style="text-align: right;">{{ number_format($pajak->nilai_pajak) }}</td>
                                    </tr>
                                    @php
                                        $totalNilaiPajak += $pajak->nilai_pajak;
                                    @endphp
                                @endif
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="8">Total</td>
                                <td style="text-align: right;">
                                    <strong>{{ number_format($totalNilaiPajak) }}</strong>
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
