<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <table>
        <tr>
            <td colspan="19"><b>PEMERINTAH KABUPATEN TANAH BUMBU</b></td>
        </tr>
        <tr>
            <td colspan="19"><b>REKAP BELANJA PER KODE REKENING</b></td>
        </tr>
        <tr>
            <td colspan="19"><b>Periode {{ date('d-m-Y', strtotime($startDate)) }} s.d. {{ date('d-m-Y', strtotime($endDate)) }}</b></td>
        </tr>
        <tr>
            <td>SKPD</td>
            <td>:</td>
            <td colspan="17">Kecamatan Teluk Kepayang</td>
        </tr>
        <tr>
            <td>Tahun Anggaran</td>
            <td>:</td>
            <td colspan="17">{{ date('Y', strtotime($startDate)) }}</td>
        </tr>
    </table>

    <table border="1">
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
                <th>Agustus</th>
                <th>September</th>
                <th>Oktober</th>
                <th>November</th>
                <th>Desember</th>
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
                    <td>{{ $rekap->nama_rekening }}</td>
                    <td>{{ $rekap->pagu }}</td>
                    <td>{{ $rekap->januari_total }}</td>
                    <td>{{ $rekap->februari_total }}</td>
                    <td>{{ $rekap->maret_total }}</td>
                    <td>{{ $rekap->april_total }}</td>
                    <td>{{ $rekap->mei_total }}</td>
                    <td>{{ $rekap->juni_total }}</td>
                    <td>{{ $rekap->juli_total }}</td>
                    <td>{{ $rekap->agustus_total }}</td>
                    <td>{{ $rekap->september_total }}</td>
                    <td>{{ $rekap->oktober_total }}</td>
                    <td>{{ $rekap->november_total }}</td>
                    <td>{{ $rekap->desember_total }}</td>
                    <td>{{ $totalRealisasi }}</td>
                    <td>{{ $sisa }}</td>
                    <td>{{ number_format($persentase, 2) }}%</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            @php
                $grandTotalRealisasi = $totalJanuari + $totalFebruari + $totalMaret + $totalApril + $totalMei + $totalJuni + $totalJuli + $totalAgustus + $totalSeptember + $totalOktober + $totalNovember + $totalDesember;
                $grandSisa = $totalPagu - $grandTotalRealisasi;
                $grandPersentase = $totalPagu > 0 ? ($grandTotalRealisasi / $totalPagu) * 100 : 0;
            @endphp
            <tr>
                <td colspan="3"><b>TOTAL</b></td>
                <td><b>{{ $totalPagu }}</b></td>
                <td><b>{{ $totalJanuari }}</b></td>
                <td><b>{{ $totalFebruari }}</b></td>
                <td><b>{{ $totalMaret }}</b></td>
                <td><b>{{ $totalApril }}</b></td>
                <td><b>{{ $totalMei }}</b></td>
                <td><b>{{ $totalJuni }}</b></td>
                <td><b>{{ $totalJuli }}</b></td>
                <td><b>{{ $totalAgustus }}</b></td>
                <td><b>{{ $totalSeptember }}</b></td>
                <td><b>{{ $totalOktober }}</b></td>
                <td><b>{{ $totalNovember }}</b></td>
                <td><b>{{ $totalDesember }}</b></td>
                <td><b>{{ $grandTotalRealisasi }}</b></td>
                <td><b>{{ $grandSisa }}</b></td>
                <td><b>{{ number_format($grandPersentase, 2) }}%</b></td>
            </tr>
        </tfoot>
    </table>

    <table>
        <tr>
            <td colspan="2"></td>
            <td>Teluk Kepayang, {{ date('d-m-Y', strtotime($endDate)) }}</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td>Bendahara Pengeluaran</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td><br/><br/><br/></td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td>{{ $decision->nama_bp }}</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td>NIP. {{ $decision->nip_bp }}</td>
        </tr>
    </table>
</body>
</html>
