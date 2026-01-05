<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <table>
        <tr>
            <td colspan="6"><b>PEMERINTAH KABUPATEN TANAH BUMBU</b></td>
        </tr>
        <tr>
            <td colspan="6"><b>REKAP SP2D{{ !empty($jenisSpd) ? ' - ' . $jenisSpd : '' }}</b></td>
        </tr>
        <tr>
            <td colspan="6"><b>TAHUN ANGGARAN 2025</b></td>
        </tr>
        <tr>
            <td>SKPD</td>
            <td>:</td>
            <td colspan="4">Kecamatan Teluk Kepayang</td>
        </tr>
        @if(!empty($jenisSpd))
        <tr>
            <td>Jenis SP2D</td>
            <td>:</td>
            <td colspan="4">{{ $jenisSpd }}</td>
        </tr>
        @endif
        <tr>
            <td>Periode</td>
            <td>:</td>
            <td colspan="4">{{ date('d-m-Y', strtotime($startDate)) }} s.d. {{ date('d-m-Y', strtotime($endDate)) }}</td>
        </tr>
    </table>

    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>SP2D</th>
                <th>Uraian</th>
                <th>Tanggal</th>
                <th>Jenis</th>
                <th>Nilai (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalNilai = 0;
            @endphp
            @foreach ($spds as $index => $spd)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $spd->no_spd }}</td>
                    <td>{{ $spd->spd_uraian }}</td>
                    <td>{{ date('d-m-Y', strtotime($spd->spd_tgl)) }}</td>
                    <td>{{ $spd->jenis }}</td>
                    <td>{{ $spd->spd_nilai }}</td>
                </tr>
                @php
                    $totalNilai += $spd->spd_nilai;
                @endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5"><b>Total</b></td>
                <td><b>{{ $totalNilai }}</b></td>
            </tr>
        </tfoot>
    </table>

    <table>
        <tr>
            <td colspan="2"></td>
            <td>Teluk Kepayang, {{ date('d-m-Y') }}</td>
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
