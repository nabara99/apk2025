<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <table>
        <tr>
            <td colspan="3"><b>PEMERINTAH KABUPATEN TANAH BUMBU</b></td>
        </tr>
        <tr>
            <td colspan="3"><b>LAPORAN RENCANA KERJA</b></td>
        </tr>
        <tr>
            <td colspan="3"><b>TAHUN ANGGARAN 2025</b></td>
        </tr>
        <tr>
            <td>SKPD</td>
            <td>:</td>
            <td>Kecamatan Teluk Kepayang</td>
        </tr>
    </table>

    <table border="1">
        <thead>
            <tr>
                <th>Sub Kegiatan</th>
                <th>Rekening</th>
                <th>Komponen Belanja</th>
                <th>Anggaran</th>
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
                <th>Jumlah</th>
                <th>Sisa</th>
                <th>% Realisasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($realisasiBelanjaUnionSpd as $realisasi)
                <tr>
                    <td>{{ $realisasi->nama_sub }}</td>
                    <td>{{ $realisasi->kode_rekening }} - {{ $realisasi->nama_rekening }}</td>
                    <td>{{ $realisasi->uraian }}</td>
                    <td>{{ $realisasi->pagu }}</td>
                    <td>{{ $realisasi->januari_total }}</td>
                    <td>{{ $realisasi->februari_total }}</td>
                    <td>{{ $realisasi->maret_total }}</td>
                    <td>{{ $realisasi->april_total }}</td>
                    <td>{{ $realisasi->mei_total }}</td>
                    <td>{{ $realisasi->juni_total }}</td>
                    <td>{{ $realisasi->juli_total }}</td>
                    <td>{{ $realisasi->agustus_total }}</td>
                    <td>{{ $realisasi->september_total }}</td>
                    <td>{{ $realisasi->oktober_total }}</td>
                    <td>{{ $realisasi->november_total }}</td>
                    <td>{{ $realisasi->desember_total }}</td>
                    <td>{{ $realisasi->januari_total + $realisasi->februari_total + $realisasi->maret_total + $realisasi->april_total + $realisasi->mei_total + $realisasi->juni_total + $realisasi->juli_total + $realisasi->agustus_total + $realisasi->september_total + $realisasi->oktober_total + $realisasi->november_total + $realisasi->desember_total }}</td>
                    <td>{{ $realisasi->sisa_pagu }}</td>
                    <td>
                        @php
                            $total_realisasi = $realisasi->januari_total + $realisasi->februari_total + $realisasi->maret_total + $realisasi->april_total + $realisasi->mei_total + $realisasi->juni_total + $realisasi->juli_total + $realisasi->agustus_total + $realisasi->september_total + $realisasi->oktober_total + $realisasi->november_total + $realisasi->desember_total;
                            $persentase = $total_realisasi > 0 ? ($total_realisasi / $realisasi->pagu) * 100 : 0;
                        @endphp
                        {{ number_format($persentase, 2, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
