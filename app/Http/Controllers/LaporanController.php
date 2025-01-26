<?php

namespace App\Http\Controllers;

use App\Models\Decision;
use App\Models\Spd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.laporan.index');
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

    public function laporanRealisasi()
    {
        $realisasiBelanja = DB::table('temp_kwitansis')
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
                DB::raw('SUM(total) AS total'), // Menggunakan fungsi agregasi SUM untuk mendapatkan total
                DB::raw('MONTH(kwitansis.tgl) AS bulan')
            )
            ->join('kwitansis', 'temp_kwitansis.kwitansi_id', '=', 'kwitansis.kw_id')
            ->join('anggarans', 'temp_kwitansis.anggaran_id', '=', 'anggarans.id')
            ->join('rekenings', 'anggarans.rekening_id', '=', 'rekenings.id')
            ->join('subs', 'anggarans.sub_id', '=', 'subs.id')
            ->join('kegiatans', 'subs.kegiatan_id', '=', 'kegiatans.id')
            ->join('programs', 'kegiatans.program_id', '=', 'programs.id')
            ->groupBy('anggarans.uraian', 'anggarans.pagu', 'anggarans.sisa_pagu', 'rekenings.kode_rekening',
            'rekenings.nama_rekening', 'subs.kode_sub', 'subs.nama_sub', 'kegiatans.kode_kegiatan',
            'programs.kode_program', 'bulan');

        $realisasiSpd = DB::table('spd_rincis')
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
                DB::raw('SUM(total) AS total'), // Menggunakan fungsi agregasi SUM untuk mendapatkan total
                DB::raw('MONTH(spds.spd_tgl) AS bulan')
            )
            ->join('spds', 'spd_rincis.spd_id', '=', 'spds.id')
            ->join('anggarans', 'spd_rincis.anggaran_id', '=', 'anggarans.id')
            ->join('rekenings', 'anggarans.rekening_id', '=', 'rekenings.id')
            ->join('subs', 'anggarans.sub_id', '=', 'subs.id')
            ->join('kegiatans', 'subs.kegiatan_id', '=', 'kegiatans.id')
            ->join('programs', 'kegiatans.program_id', '=', 'programs.id')
            ->groupBy('anggarans.uraian', 'anggarans.pagu', 'anggarans.sisa_pagu', 'rekenings.kode_rekening',
            'rekenings.nama_rekening', 'subs.kode_sub', 'subs.nama_sub', 'kegiatans.kode_kegiatan',
            'programs.kode_program', 'bulan');
        $combinedQuery = $realisasiBelanja->union($realisasiSpd);

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

        $spds = DB::table('spds')
            // ->select(
            //     'kode_program',
            //     'kode_kegiatan',
            //     'kode_sub',
            //     'nama_sub',
            //     'kode_rekening',
            //     'nama_rekening',
            //     DB::raw('SUM(total) AS total_realisasi') // Hitung total realisasi
            // )
            ->whereBetween('spd_tgl', [$startDate, $endDate])
            ->orderBy('spd_tgl', 'asc')
            ->get();

        $decision = Decision::first();

        return view('pages.laporan.laporan_spd', [
            'spds' => $spds,
            'decision' => $decision,
        ]);
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
}
