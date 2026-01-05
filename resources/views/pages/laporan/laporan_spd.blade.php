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
    <title>SP2D</title>
</head>

<body>
    <table style="width: 100%; border-collapse: collapse; text-align: center; font-family: arial; font-size: 8pt;">

        <a href="{{ route('laporan.spd.export', ['start_date' => $startDate, 'end_date' => $endDate, 'jenis_spd' => $jenisSpd]) }}" class="btn btn-success">Download Excel</a>

        <tr>
            <td colspan="3"><b>PEMERINTAH KABUPATEN TANAH BUMBU</b></td>
        </tr>
        <tr>
            <td colspan="3"><b>REKAP SP2D{{ !empty($jenisSpd) ? ' - ' . $jenisSpd : '' }}</b></td>
        </tr>
        <tr>
            <td colspan="3"><b>TAHUN ANGGARAN 2025</b></td>
        </tr>
        <tr>
            <td width="15%">&nbsp&nbsp&nbsp&nbsp SKPD</td>
            <td width="1%">:</td>
            <td width="50%" style="text-align: left;">Kecamatan Teluk Kepayang</td>
        </tr>
        @if(!empty($jenisSpd))
        <tr>
            <td width="15%">&nbsp&nbsp&nbsp&nbsp Jenis SP2D</td>
            <td width="1%">:</td>
            <td width="50%" style="text-align: left;">{{ $jenisSpd }}</td>
        </tr>
        @endif
        <tr>
            <td colspan="3">
                <br>
                <center>
                    <table border="1" cellpadding="5"
                        style="border-collapse: collapse; border: 1px solid #000; text-align: center; width: 80%">
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
                                    <td style="text-align: left">{{ $spd->spd_uraian }}</td>
                                    <td>{{ Carbon::parse($spd->spd_tgl)->isoFormat('D MMMM Y') }}</td>
                                    <td>{{ $spd->jenis }}</td>
                                    <td style="text-align: right">{{ number_format($spd->spd_nilai) }}</td>
                                </tr>
                                @php
                                    $totalNilai += $spd->spd_nilai;
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" style="text-align:text;">Total</td>
                                <td style="text-align: right;">
                                    {{ number_format($totalNilai) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </center>
            </td>
        <tr>
            <td colspan="2"></td>
            <td>Bendahara Pengeluaran</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td><br /><br /><br /><br /><br />{{ $decision->nama_bp }}</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td>NIP. {{ $decision->nip_bp }}</td>
        </tr>
    </table>
</body>

</html>
