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
    <title>Rekap Belanja Per Rekening</title>
</head>

<body>
    <table style="width: 100%; border-collapse: collapse; text-align: center; font-family: arial; font-size: 8pt;">

        <a href="{{ route('laporan.rekap-belanja.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}" class="btn btn-success">Download Excel</a>

        <tr>
            <td colspan="3"><b>PEMERINTAH KABUPATEN TANAH BUMBU</b></td>
        </tr>
        <tr>
            <td colspan="3"><b>REKAP BELANJA PER KODE REKENING</b></td>
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
            <td width="50%" style="text-align: left;">{{ date('Y', strtotime($startDate)) }}</td>
        </tr>
        <tr>
            <td colspan="3">
                <br>
                <center>
                    <table border="1" cellpadding="5"
                        style="border-collapse: collapse; border: 1px solid #000; text-align: center; width: 95%">
                        <thead>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Kode Rekening</th>
                                <th rowspan="2">Nama Rekening</th>
                                <th rowspan="2">Anggaran</th>
                                <th colspan="12">Realisasi Belanja per Bulan</th>
                                <th rowspan="2">Total</th>
                                <th rowspan="2">Sisa</th>
                                <th rowspan="2">Persentase Realisasi</th>
                            </tr>
                            <tr>
                                <th>Jan</th>
                                <th>Feb</th>
                                <th>Mar</th>
                                <th>Apr</th>
                                <th>Mei</th>
                                <th>Juni</th>
                                <th>Juli</th>
                                <th>Agt</th>
                                <th>Sept</th>
                                <th>Okt</th>
                                <th>Nov</th>
                                <th>Des</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rekapBelanja as $index => $rekap)
                                @php
                                    $totalRealisasi = $rekap->januari_total + $rekap->februari_total + $rekap->maret_total + $rekap->april_total + $rekap->mei_total + $rekap->juni_total + $rekap->juli_total + $rekap->agustus_total + $rekap->september_total + $rekap->oktober_total + $rekap->november_total + $rekap->desember_total;
                                    $sisa = $rekap->pagu - $totalRealisasi;
                                    $persentase = $rekap->pagu > 0 ? ($totalRealisasi / $rekap->pagu) * 100 : 0;
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $rekap->kode_rekening }}</td>
                                    <td style="text-align: left">{{ $rekap->nama_rekening }}</td>
                                    <td style="text-align: right">{{ number_format($rekap->pagu) }}</td>
                                    <td style="text-align: right">{{ number_format($rekap->januari_total) }}</td>
                                    <td style="text-align: right">{{ number_format($rekap->februari_total) }}</td>
                                    <td style="text-align: right">{{ number_format($rekap->maret_total) }}</td>
                                    <td style="text-align: right">{{ number_format($rekap->april_total) }}</td>
                                    <td style="text-align: right">{{ number_format($rekap->mei_total) }}</td>
                                    <td style="text-align: right">{{ number_format($rekap->juni_total) }}</td>
                                    <td style="text-align: right">{{ number_format($rekap->juli_total) }}</td>
                                    <td style="text-align: right">{{ number_format($rekap->agustus_total) }}</td>
                                    <td style="text-align: right">{{ number_format($rekap->september_total) }}</td>
                                    <td style="text-align: right">{{ number_format($rekap->oktober_total) }}</td>
                                    <td style="text-align: right">{{ number_format($rekap->november_total) }}</td>
                                    <td style="text-align: right">{{ number_format($rekap->desember_total) }}</td>
                                    <td style="text-align: right">{{ number_format($totalRealisasi) }}</td>
                                    <td style="text-align: right">{{ number_format($sisa) }}</td>
                                    <td style="text-align: right">{{ number_format($persentase, 2) }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            @php
                                $grandTotalRealisasi = $totalJanuari + $totalFebruari + $totalMaret + $totalApril + $totalMei + $totalJuni + $totalJuli + $totalAgustus + $totalSeptember + $totalOktober + $totalNovember + $totalDesember;
                                $grandSisa = $totalPagu - $grandTotalRealisasi;
                                $grandPersentase = $totalPagu > 0 ? ($grandTotalRealisasi / $totalPagu) * 100 : 0;
                            @endphp
                            <tr style="font-weight: bold">
                                <td colspan="3" style="text-align: center">TOTAL</td>
                                <td style="text-align: right">{{ number_format($totalPagu) }}</td>
                                <td style="text-align: right">{{ number_format($totalJanuari) }}</td>
                                <td style="text-align: right">{{ number_format($totalFebruari) }}</td>
                                <td style="text-align: right">{{ number_format($totalMaret) }}</td>
                                <td style="text-align: right">{{ number_format($totalApril) }}</td>
                                <td style="text-align: right">{{ number_format($totalMei) }}</td>
                                <td style="text-align: right">{{ number_format($totalJuni) }}</td>
                                <td style="text-align: right">{{ number_format($totalJuli) }}</td>
                                <td style="text-align: right">{{ number_format($totalAgustus) }}</td>
                                <td style="text-align: right">{{ number_format($totalSeptember) }}</td>
                                <td style="text-align: right">{{ number_format($totalOktober) }}</td>
                                <td style="text-align: right">{{ number_format($totalNovember) }}</td>
                                <td style="text-align: right">{{ number_format($totalDesember) }}</td>
                                <td style="text-align: right">{{ number_format($grandTotalRealisasi) }}</td>
                                <td style="text-align: right">{{ number_format($grandSisa) }}</td>
                                <td style="text-align: right">{{ number_format($grandPersentase, 2) }}%</td>
                            </tr>
                        </tfoot>
                    </table>
                </center>
            </td>
        <tr>
            <td colspan="2"></td>
            <td><br/>Teluk Kepayang, {{ Carbon::now()->isoFormat('D MMMM Y') }}</td>
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
