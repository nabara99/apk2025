<?php

namespace App\Http\Controllers;

use App\Exports\LaporanRealisasiExport;
use App\Exports\LaporanRenjaExport;
use App\Exports\LaporanPajakPusatExport;
use App\Exports\LaporanSpdExport;
use App\Exports\RekapBelanjaExport;
use App\Models\Decision;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RealisasiBelanjaExport;
use App\Models\Spd;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spds = Spd::where('jenis', 'TU')->get();
        return view('pages.laporan.index', compact('spds'));
    }

    public function laporanBendahara(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $realisasiBelanja = DB::table('temp_kwitansis')
            ->join('kwitansis', 'temp_kwitansis.kwitansi_id', '=', 'kwitansis.kw_id')
            ->join('anggarans', 'temp_kwitansis.anggaran_id', '=', 'anggarans.id')
            ->join('rekenings', 'anggarans.rekening_id', '=', 'rekenings.id')
            ->join('subs', 'anggarans.sub_id', '=', 'subs.id')
            ->join('kegiatans', 'subs.kegiatan_id', '=', 'kegiatans.id')
            ->join('programs', 'kegiatans.program_id', '=', 'programs.id')
            ->select(
                'kode_program',
                'kode_kegiatan',
                'kode_sub',
                'nama_sub',
                'kode_rekening',
                'nama_rekening',
                DB::raw('SUM(total) AS total_realisasi') // Hitung total realisasi
            )
            ->whereBetween('tgl', [$startDate, $endDate])
            ->groupBy('kode_program', 'kode_kegiatan', 'kode_sub', 'kode_rekening', 'nama_sub', 'nama_rekening')
            ->get();

        $decision = Decision::first();

        return view('pages.laporan.laporan_bendahara', [
            'realisasiBelanja' => $realisasiBelanja,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'decision' => $decision,
        ]);
    }

    public function laporanTu(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $spdTu = $request->input('spd_id');

        $spd = Spd::find($spdTu);

        if (!$spd) {
            return back()->with('error', 'Data SP2D tidak ditemukan.');
        }

        $realisasiBelanja = DB::table('temp_kwitansi_tus')
            ->join('kwitansi_tus', 'temp_kwitansi_tus.kwitansi_id', '=', 'kwitansi_tus.kw_id')
            ->join('anggarans', 'temp_kwitansi_tus.anggaran_id', '=', 'anggarans.id')
            ->join('rekenings', 'anggarans.rekening_id', '=', 'rekenings.id')
            ->join('subs', 'anggarans.sub_id', '=', 'subs.id')
            ->join('kegiatans', 'subs.kegiatan_id', '=', 'kegiatans.id')
            ->join('programs', 'kegiatans.program_id', '=', 'programs.id')
            ->select(
                'kode_program',
                'kode_kegiatan',
                'kode_sub',
                'nama_sub',
                'kode_rekening',
                'nama_rekening',
                DB::raw('SUM(total) AS total_realisasi')
            )
            ->whereBetween('tgl', [$startDate, $endDate])
            ->groupBy('kode_program', 'kode_kegiatan', 'kode_sub', 'kode_rekening', 'nama_sub', 'nama_rekening')
            ->get();

        $decision = Decision::first();

        return view('pages.laporan.laporan_tu', [
            'realisasiBelanja' => $realisasiBelanja,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'decision' => $decision,
            'spd' => $spd
        ]);
    }

    public function laporanRealisasi()
    {
        $realisasiBelanja = DB::table('anggarans')
        ->select(
            'anggarans.uraian as uraian',
            'anggarans.pagu as pagu',
            'anggarans.sisa_pagu as sisa_pagu',
            'rekenings.kode_rekening as kode_rekening',
            'rekenings.nama_rekening as nama_rekening',
            'subs.kode_sub as kode_sub',
            'subs.nama_sub as nama_sub',
            'kegiatans.kode_kegiatan as kode_kegiatan',
            'programs.kode_program as kode_program',
            DB::raw('SUM(COALESCE(temp_kwitansis.total, 0) + COALESCE(temp_kwitansi_tus.total, 0)) AS total'),
            DB::raw('COALESCE(MONTH(kwitansis.tgl), MONTH(kwitansi_tus.tgl)) AS bulan')
        )
        ->leftJoin('temp_kwitansis', 'anggarans.id', '=', 'temp_kwitansis.anggaran_id')
        ->leftJoin('kwitansis', 'temp_kwitansis.kwitansi_id', '=', 'kwitansis.kw_id')
        ->leftJoin('temp_kwitansi_tus', 'anggarans.id', '=', 'temp_kwitansi_tus.anggaran_id')
        ->leftJoin('kwitansi_tus', 'temp_kwitansi_tus.kwitansi_id', '=', 'kwitansi_tus.kw_id')
        ->join('rekenings', 'anggarans.rekening_id', '=', 'rekenings.id')
        ->join('subs', 'anggarans.sub_id', '=', 'subs.id')
        ->join('kegiatans', 'subs.kegiatan_id', '=', 'kegiatans.id')
        ->join('programs', 'kegiatans.program_id', '=', 'programs.id')
        ->groupBy(
            'anggarans.uraian',
            'anggarans.pagu',
            'anggarans.sisa_pagu',
            'rekenings.kode_rekening',
            'rekenings.nama_rekening',
            'subs.kode_sub',
            'subs.nama_sub',
            'kegiatans.kode_kegiatan',
            'programs.kode_program',
            DB::raw('COALESCE(MONTH(kwitansis.tgl), MONTH(kwitansi_tus.tgl))')
        );


        $realisasiSpd = DB::table('anggarans')
        ->select(
            'anggarans.uraian as uraian',
            'anggarans.pagu as pagu',
            'anggarans.sisa_pagu as sisa_pagu',
            'rekenings.kode_rekening as kode_rekening',
            'rekenings.nama_rekening as nama_rekening',
            'subs.kode_sub as kode_sub',
            'subs.nama_sub as nama_sub',
            'kegiatans.kode_kegiatan as kode_kegiatan',
            'programs.kode_program as kode_program',
            DB::raw('SUM(spd_rincis.total) AS total'),
            DB::raw('MONTH(spds.spd_tgl) AS bulan')
        )
        ->leftJoin('spd_rincis', 'anggarans.id', '=', 'spd_rincis.anggaran_id')
        ->leftJoin('spds', 'spd_rincis.spd_id', '=', 'spds.id')
        ->join('rekenings', 'anggarans.rekening_id', '=', 'rekenings.id')
        ->join('subs', 'anggarans.sub_id', '=', 'subs.id')
        ->join('kegiatans', 'subs.kegiatan_id', '=', 'kegiatans.id')
        ->join('programs', 'kegiatans.program_id', '=', 'programs.id')
        ->groupBy(
            'anggarans.uraian',
            'anggarans.pagu',
            'anggarans.sisa_pagu',
            'rekenings.kode_rekening',
            'rekenings.nama_rekening',
            'subs.kode_sub',
            'subs.nama_sub',
            'kegiatans.kode_kegiatan',
            'programs.kode_program',
            'bulan'
        );

        $combinedQuery = $realisasiBelanja->unionAll($realisasiSpd);


        $realisasiBelanjaUnionSpd = DB::table(DB::raw("({$combinedQuery->toSql()}) as combined"))
            ->mergeBindings($combinedQuery)
            ->select(
                'uraian',
                'kode_rekening',
                'nama_rekening',
                'kode_sub',
                'nama_sub',
                'pagu',
                'sisa_pagu',
                'kode_kegiatan',
                'kode_program',
                DB::raw('SUM(CASE WHEN bulan = 1 THEN total ELSE 0 END) AS januari_total'),
                DB::raw('SUM(CASE WHEN bulan = 2 THEN total ELSE 0 END) AS februari_total'),
                DB::raw('SUM(CASE WHEN bulan = 3 THEN total ELSE 0 END) AS maret_total'),
                DB::raw('SUM(CASE WHEN bulan = 4 THEN total ELSE 0 END) AS april_total'),
                DB::raw('SUM(CASE WHEN bulan = 5 THEN total ELSE 0 END) AS mei_total'),
                DB::raw('SUM(CASE WHEN bulan = 6 THEN total ELSE 0 END) AS juni_total'),
                DB::raw('SUM(CASE WHEN bulan = 7 THEN total ELSE 0 END) AS juli_total'),
                DB::raw('SUM(CASE WHEN bulan = 8 THEN total ELSE 0 END) AS agustus_total'),
                DB::raw('SUM(CASE WHEN bulan = 9 THEN total ELSE 0 END) AS september_total'),
                DB::raw('SUM(CASE WHEN bulan = 10 THEN total ELSE 0 END) AS oktober_total'),
                DB::raw('SUM(CASE WHEN bulan = 11 THEN total ELSE 0 END) AS november_total'),
                DB::raw('SUM(CASE WHEN bulan = 12 THEN total ELSE 0 END) AS desember_total'),
            )
            ->groupBy('uraian', 'kode_rekening', 'nama_rekening', 'nama_sub', 'kode_sub', 'kode_kegiatan',
                'kode_program', 'pagu', 'sisa_pagu')
            ->orderBy('kode_program', 'asc')
            ->orderBy('kode_kegiatan', 'asc')
            ->orderBy('kode_sub', 'asc')
            ->orderBy('kode_rekening', 'asc')
            ->get();

        // Menghitung total per bulan
        $totalJanuari = 0;
        $totalFebruari = 0;
        $totalMaret = 0;
        $totalApril = 0;
        $totalMei = 0;
        $totalJuni = 0;
        $totalJuli = 0;
        $totalAgustus = 0;
        $totalSeptember = 0;
        $totalOktober = 0;
        $totalNovember = 0;
        $totalDesember = 0;

        foreach ($realisasiBelanjaUnionSpd as $realisasi) {
            $totalJanuari += $realisasi->januari_total;
            $totalFebruari += $realisasi->februari_total;
            $totalMaret += $realisasi->maret_total;
            $totalApril += $realisasi->april_total;
            $totalMei += $realisasi->mei_total;
            $totalJuni += $realisasi->juni_total;
            $totalJuli += $realisasi->juli_total;
            $totalAgustus += $realisasi->agustus_total;
            $totalSeptember += $realisasi->september_total;
            $totalOktober += $realisasi->oktober_total;
            $totalNovember += $realisasi->november_total;
            $totalDesember += $realisasi->desember_total;
        }

        return view('pages.laporan.laporan_renja', compact('realisasiBelanjaUnionSpd', 'totalJanuari', 'totalFebruari',
        'totalMaret', 'totalApril', 'totalMei', 'totalJuni', 'totalJuli', 'totalAgustus', 'totalSeptember', 'totalOktober',
        'totalNovember', 'totalDesember',));
    }

    public function laporanPajakPusat(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $pajakPusat = DB::table('pajak_kwitansis')
            ->join('spds', 'pajak_kwitansis.spd_id', '=', 'spds.id')
            ->select(
                'no_spd',
                'kwi_id',
                'uraian_pajak',
                'jenis_pajak',
                'nilai_pajak',
                'billing',
                'ntpn',
                'ntb',
                'tgl_setor',
            )
            ->whereBetween('tgl_setor', [$startDate, $endDate])
            ->get();

        $decision = Decision::first();

        return view('pages.laporan.laporan_pajak_pusat', [
            'pajakPusat' => $pajakPusat,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'decision' => $decision,
        ]);
    }

    public function laporanPajakDaerah(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $pajakDaerah = DB::table('pajak_kwitansis')
            ->join('spds', 'pajak_kwitansis.spd_id', '=', 'spds.id')
            ->select(
                'no_spd',
                'kwi_id',
                'uraian_pajak',
                'jenis_pajak',
                'nilai_pajak',
                'billing',
                'ntpn',
                'ntb',
                'tgl_setor',
            )
            ->whereBetween('tgl_setor', [$startDate, $endDate])
            ->get();

        $decision = Decision::first();

        return view('pages.laporan.laporan_pajak_daerah', [
            'pajakDaerah' => $pajakDaerah,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'decision' => $decision,
        ]);
    }

    public function laporanSpd(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $jenisSpd = $request->input('jenis_spd');

        $query = DB::table('spds')
            ->whereBetween('spd_tgl', [$startDate, $endDate]);

        // Filter by jenis if provided
        if (!empty($jenisSpd)) {
            $query->where('jenis', $jenisSpd);
        }

        $spds = $query->orderBy('spd_tgl', 'asc')->get();

        $decision = Decision::first();

        return view('pages.laporan.laporan_spd', [
            'spds' => $spds,
            'decision' => $decision,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'jenisSpd' => $jenisSpd,
        ]);
    }

    public function rekapBelanja(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query untuk kwitansi biasa dan TU
        $realisasiBelanja = DB::table('rekenings')
            ->select(
                'rekenings.kode_rekening',
                'rekenings.nama_rekening',
                DB::raw('SUM(COALESCE(temp_kwitansis.total, 0) + COALESCE(temp_kwitansi_tus.total, 0)) AS total'),
                DB::raw('COALESCE(MONTH(kwitansis.tgl), MONTH(kwitansi_tus.tgl)) AS bulan')
            )
            ->leftJoin('anggarans', 'rekenings.id', '=', 'anggarans.rekening_id')
            ->leftJoin('temp_kwitansis', 'anggarans.id', '=', 'temp_kwitansis.anggaran_id')
            ->leftJoin('kwitansis', 'temp_kwitansis.kwitansi_id', '=', 'kwitansis.kw_id')
            ->leftJoin('temp_kwitansi_tus', 'anggarans.id', '=', 'temp_kwitansi_tus.anggaran_id')
            ->leftJoin('kwitansi_tus', 'temp_kwitansi_tus.kwitansi_id', '=', 'kwitansi_tus.kw_id')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->where(function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('kwitansis.tgl', [$startDate, $endDate])
                      ->orWhereBetween('kwitansi_tus.tgl', [$startDate, $endDate]);
                });
            })
            ->groupBy(
                'rekenings.kode_rekening',
                'rekenings.nama_rekening',
                DB::raw('COALESCE(MONTH(kwitansis.tgl), MONTH(kwitansi_tus.tgl))')
            );

        // Query untuk SPD
        $realisasiSpd = DB::table('rekenings')
            ->select(
                'rekenings.kode_rekening',
                'rekenings.nama_rekening',
                DB::raw('SUM(spd_rincis.total) AS total'),
                DB::raw('MONTH(spds.spd_tgl) AS bulan')
            )
            ->leftJoin('anggarans', 'rekenings.id', '=', 'anggarans.rekening_id')
            ->leftJoin('spd_rincis', 'anggarans.id', '=', 'spd_rincis.anggaran_id')
            ->leftJoin('spds', 'spd_rincis.spd_id', '=', 'spds.id')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('spds.spd_tgl', [$startDate, $endDate]);
            })
            ->groupBy(
                'rekenings.kode_rekening',
                'rekenings.nama_rekening',
                'bulan'
            );

        $combinedQuery = $realisasiBelanja->unionAll($realisasiSpd);

        // Agregasi per bulan
        $rekapBelanja = DB::table(DB::raw("({$combinedQuery->toSql()}) as combined"))
            ->mergeBindings($combinedQuery)
            ->select(
                'kode_rekening',
                'nama_rekening',
                DB::raw('SUM(CASE WHEN bulan = 1 THEN total ELSE 0 END) AS januari_total'),
                DB::raw('SUM(CASE WHEN bulan = 2 THEN total ELSE 0 END) AS februari_total'),
                DB::raw('SUM(CASE WHEN bulan = 3 THEN total ELSE 0 END) AS maret_total'),
                DB::raw('SUM(CASE WHEN bulan = 4 THEN total ELSE 0 END) AS april_total'),
                DB::raw('SUM(CASE WHEN bulan = 5 THEN total ELSE 0 END) AS mei_total'),
                DB::raw('SUM(CASE WHEN bulan = 6 THEN total ELSE 0 END) AS juni_total'),
                DB::raw('SUM(CASE WHEN bulan = 7 THEN total ELSE 0 END) AS juli_total'),
                DB::raw('SUM(CASE WHEN bulan = 8 THEN total ELSE 0 END) AS agustus_total'),
                DB::raw('SUM(CASE WHEN bulan = 9 THEN total ELSE 0 END) AS september_total'),
                DB::raw('SUM(CASE WHEN bulan = 10 THEN total ELSE 0 END) AS oktober_total'),
                DB::raw('SUM(CASE WHEN bulan = 11 THEN total ELSE 0 END) AS november_total'),
                DB::raw('SUM(CASE WHEN bulan = 12 THEN total ELSE 0 END) AS desember_total')
            )
            ->groupBy('kode_rekening', 'nama_rekening')
            ->orderBy('kode_rekening', 'asc')
            ->get();

        // Ambil data pagu per rekening
        $paguPerRekening = DB::table('anggarans')
            ->join('rekenings', 'anggarans.rekening_id', '=', 'rekenings.id')
            ->select(
                'rekenings.kode_rekening',
                DB::raw('SUM(anggarans.pagu) as total_pagu')
            )
            ->groupBy('rekenings.kode_rekening')
            ->pluck('total_pagu', 'kode_rekening');

        // Gabungkan data pagu ke rekapBelanja
        $rekapBelanja = $rekapBelanja->map(function ($item) use ($paguPerRekening) {
            $item->pagu = $paguPerRekening[$item->kode_rekening] ?? 0;
            return $item;
        });

        // Menghitung total per bulan dan total pagu
        $totalJanuari = $totalFebruari = $totalMaret = $totalApril = $totalMei = $totalJuni = 0;
        $totalJuli = $totalAgustus = $totalSeptember = $totalOktober = $totalNovember = $totalDesember = 0;
        $totalPagu = 0;

        foreach ($rekapBelanja as $rekap) {
            $totalPagu += $rekap->pagu;
            $totalJanuari += $rekap->januari_total;
            $totalFebruari += $rekap->februari_total;
            $totalMaret += $rekap->maret_total;
            $totalApril += $rekap->april_total;
            $totalMei += $rekap->mei_total;
            $totalJuni += $rekap->juni_total;
            $totalJuli += $rekap->juli_total;
            $totalAgustus += $rekap->agustus_total;
            $totalSeptember += $rekap->september_total;
            $totalOktober += $rekap->oktober_total;
            $totalNovember += $rekap->november_total;
            $totalDesember += $rekap->desember_total;
        }

        $decision = Decision::first();

        return view('pages.laporan.rekap_belanja', compact(
            'rekapBelanja',
            'totalJanuari',
            'totalFebruari',
            'totalMaret',
            'totalApril',
            'totalMei',
            'totalJuni',
            'totalJuli',
            'totalAgustus',
            'totalSeptember',
            'totalOktober',
            'totalNovember',
            'totalDesember',
            'totalPagu',
            'decision',
            'startDate',
            'endDate'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function exportExcel()
    {
        $data = $this->laporanRealisasi()->getData()['realisasiBelanjaUnionSpd'];

        return Excel::download(new LaporanRealisasiExport($data), 'laporan_realisasi.xlsx');
    }

    public function exportPajakPusat(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $pajakPusat = DB::table('pajak_kwitansis')
            ->join('spds', 'pajak_kwitansis.spd_id', '=', 'spds.id')
            ->select(
                'no_spd',
                'kwi_id',
                'uraian_pajak',
                'jenis_pajak',
                'nilai_pajak',
                'billing',
                'ntpn',
                'ntb',
                'tgl_setor',
            )
            ->whereBetween('tgl_setor', [$startDate, $endDate])
            ->get();

        $decision = Decision::first();

        return Excel::download(
            new LaporanPajakPusatExport($pajakPusat, $startDate, $endDate, $decision),
            'laporan_pajak_pusat_' . date('Y-m-d', strtotime($startDate)) . '_' . date('Y-m-d', strtotime($endDate)) . '.xlsx'
        );
    }

    public function exportSpd(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $jenisSpd = $request->input('jenis_spd');

        $query = DB::table('spds')
            ->whereBetween('spd_tgl', [$startDate, $endDate]);

        // Filter by jenis if provided
        if (!empty($jenisSpd)) {
            $query->where('jenis', $jenisSpd);
        }

        $spds = $query->orderBy('spd_tgl', 'asc')->get();

        $decision = Decision::first();

        $fileName = 'laporan_spd';
        if (!empty($jenisSpd)) {
            $fileName .= '_' . strtolower($jenisSpd);
        }
        $fileName .= '_' . date('Y-m-d', strtotime($startDate)) . '_' . date('Y-m-d', strtotime($endDate)) . '.xlsx';

        return Excel::download(
            new LaporanSpdExport($spds, $startDate, $endDate, $jenisSpd, $decision),
            $fileName
        );
    }

    public function exportRekapBelanja(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Query untuk kwitansi biasa dan TU
        $realisasiBelanja = DB::table('rekenings')
            ->select(
                'rekenings.kode_rekening',
                'rekenings.nama_rekening',
                DB::raw('SUM(COALESCE(temp_kwitansis.total, 0) + COALESCE(temp_kwitansi_tus.total, 0)) AS total'),
                DB::raw('COALESCE(MONTH(kwitansis.tgl), MONTH(kwitansi_tus.tgl)) AS bulan')
            )
            ->leftJoin('anggarans', 'rekenings.id', '=', 'anggarans.rekening_id')
            ->leftJoin('temp_kwitansis', 'anggarans.id', '=', 'temp_kwitansis.anggaran_id')
            ->leftJoin('kwitansis', 'temp_kwitansis.kwitansi_id', '=', 'kwitansis.kw_id')
            ->leftJoin('temp_kwitansi_tus', 'anggarans.id', '=', 'temp_kwitansi_tus.anggaran_id')
            ->leftJoin('kwitansi_tus', 'temp_kwitansi_tus.kwitansi_id', '=', 'kwitansi_tus.kw_id')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->where(function ($q) use ($startDate, $endDate) {
                    $q->whereBetween('kwitansis.tgl', [$startDate, $endDate])
                      ->orWhereBetween('kwitansi_tus.tgl', [$startDate, $endDate]);
                });
            })
            ->groupBy(
                'rekenings.kode_rekening',
                'rekenings.nama_rekening',
                DB::raw('COALESCE(MONTH(kwitansis.tgl), MONTH(kwitansi_tus.tgl))')
            );

        // Query untuk SPD
        $realisasiSpd = DB::table('rekenings')
            ->select(
                'rekenings.kode_rekening',
                'rekenings.nama_rekening',
                DB::raw('SUM(spd_rincis.total) AS total'),
                DB::raw('MONTH(spds.spd_tgl) AS bulan')
            )
            ->leftJoin('anggarans', 'rekenings.id', '=', 'anggarans.rekening_id')
            ->leftJoin('spd_rincis', 'anggarans.id', '=', 'spd_rincis.anggaran_id')
            ->leftJoin('spds', 'spd_rincis.spd_id', '=', 'spds.id')
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                $query->whereBetween('spds.spd_tgl', [$startDate, $endDate]);
            })
            ->groupBy(
                'rekenings.kode_rekening',
                'rekenings.nama_rekening',
                'bulan'
            );

        $combinedQuery = $realisasiBelanja->unionAll($realisasiSpd);

        // Agregasi per bulan
        $rekapBelanja = DB::table(DB::raw("({$combinedQuery->toSql()}) as combined"))
            ->mergeBindings($combinedQuery)
            ->select(
                'kode_rekening',
                'nama_rekening',
                DB::raw('SUM(CASE WHEN bulan = 1 THEN total ELSE 0 END) AS januari_total'),
                DB::raw('SUM(CASE WHEN bulan = 2 THEN total ELSE 0 END) AS februari_total'),
                DB::raw('SUM(CASE WHEN bulan = 3 THEN total ELSE 0 END) AS maret_total'),
                DB::raw('SUM(CASE WHEN bulan = 4 THEN total ELSE 0 END) AS april_total'),
                DB::raw('SUM(CASE WHEN bulan = 5 THEN total ELSE 0 END) AS mei_total'),
                DB::raw('SUM(CASE WHEN bulan = 6 THEN total ELSE 0 END) AS juni_total'),
                DB::raw('SUM(CASE WHEN bulan = 7 THEN total ELSE 0 END) AS juli_total'),
                DB::raw('SUM(CASE WHEN bulan = 8 THEN total ELSE 0 END) AS agustus_total'),
                DB::raw('SUM(CASE WHEN bulan = 9 THEN total ELSE 0 END) AS september_total'),
                DB::raw('SUM(CASE WHEN bulan = 10 THEN total ELSE 0 END) AS oktober_total'),
                DB::raw('SUM(CASE WHEN bulan = 11 THEN total ELSE 0 END) AS november_total'),
                DB::raw('SUM(CASE WHEN bulan = 12 THEN total ELSE 0 END) AS desember_total')
            )
            ->groupBy('kode_rekening', 'nama_rekening')
            ->orderBy('kode_rekening', 'asc')
            ->get();

        // Ambil data pagu per rekening
        $paguPerRekening = DB::table('anggarans')
            ->join('rekenings', 'anggarans.rekening_id', '=', 'rekenings.id')
            ->select(
                'rekenings.kode_rekening',
                DB::raw('SUM(anggarans.pagu) as total_pagu')
            )
            ->groupBy('rekenings.kode_rekening')
            ->pluck('total_pagu', 'kode_rekening');

        // Gabungkan data pagu ke rekapBelanja
        $rekapBelanja = $rekapBelanja->map(function ($item) use ($paguPerRekening) {
            $item->pagu = $paguPerRekening[$item->kode_rekening] ?? 0;
            return $item;
        });

        // Menghitung total per bulan dan total pagu
        $totalJanuari = $totalFebruari = $totalMaret = $totalApril = $totalMei = $totalJuni = 0;
        $totalJuli = $totalAgustus = $totalSeptember = $totalOktober = $totalNovember = $totalDesember = 0;
        $totalPagu = 0;

        foreach ($rekapBelanja as $rekap) {
            $totalPagu += $rekap->pagu;
            $totalJanuari += $rekap->januari_total;
            $totalFebruari += $rekap->februari_total;
            $totalMaret += $rekap->maret_total;
            $totalApril += $rekap->april_total;
            $totalMei += $rekap->mei_total;
            $totalJuni += $rekap->juni_total;
            $totalJuli += $rekap->juli_total;
            $totalAgustus += $rekap->agustus_total;
            $totalSeptember += $rekap->september_total;
            $totalOktober += $rekap->oktober_total;
            $totalNovember += $rekap->november_total;
            $totalDesember += $rekap->desember_total;
        }

        $decision = Decision::first();

        return Excel::download(
            new RekapBelanjaExport(
                $rekapBelanja,
                $totalJanuari,
                $totalFebruari,
                $totalMaret,
                $totalApril,
                $totalMei,
                $totalJuni,
                $totalJuli,
                $totalAgustus,
                $totalSeptember,
                $totalOktober,
                $totalNovember,
                $totalDesember,
                $totalPagu,
                $decision,
                $startDate,
                $endDate
            ),
            'rekap_belanja_' . date('Y-m-d', strtotime($startDate)) . '_' . date('Y-m-d', strtotime($endDate)) . '.xlsx'
        );
    }

}
