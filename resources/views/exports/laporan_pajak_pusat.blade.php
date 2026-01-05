<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <table>
        <tr>
            <td colspan="9"><b>PEMERINTAH KABUPATEN TANAH BUMBU</b></td>
        </tr>
        <tr>
            <td colspan="9"><b>LAPORAN PAJAK PUSAT</b></td>
        </tr>
        <tr>
            <td colspan="9"><b>Periode {{ date('d-m-Y', strtotime($startDate)) }} s.d. {{ date('d-m-Y', strtotime($endDate)) }}</b></td>
        </tr>
        <tr>
            <td>SKPD</td>
            <td>:</td>
            <td colspan="7">Kecamatan Teluk Kepayang</td>
        </tr>
        <tr>
            <td>Tahun Anggaran</td>
            <td>:</td>
            <td colspan="7">{{ date('Y', strtotime($startDate)) }}</td>
        </tr>
    </table>

    <table border="1">
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
                        <td>{{ $no++ }}</td>
                        <td>{{ $pajak->no_spd }}</td>
                        <td>{{ $pajak->jenis_pajak }} atas {{ $pajak->uraian_pajak }}</td>
                        <td>{{ $pajak->jenis_pajak }}</td>
                        <td>{{ $pajak->billing }}</td>
                        <td>{{ date('d-m-Y', strtotime($pajak->tgl_setor)) }}</td>
                        <td>{{ $pajak->ntpn }}</td>
                        <td>{{ $pajak->ntb }}</td>
                        <td>{{ $pajak->nilai_pajak }}</td>
                    </tr>
                    @php
                        $totalNilaiPajak += $pajak->nilai_pajak;
                    @endphp
                @endif
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8"><b>Total</b></td>
                <td><b>{{ $totalNilaiPajak }}</b></td>
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
