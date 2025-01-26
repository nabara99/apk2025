<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Spd;
use App\Models\SpdRinci;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpdRinciController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $anggaran = Anggaran::find($request->input('anggaran_id'));

        if ($anggaran && $anggaran->sisa_pagu < str_replace(",", "", $request->input('total'))) {
            return response()->json(['message' => 'Saldo tidak cukup !'], 422);
        } else {
            $data = SpdRinci::create([
                'spd_id' => $request->input('spd_id'),
                'anggaran_id' => $request->input('anggaran_id'),
                'total' => str_replace(",", "", $request->input('total')),
            ]);

            $data = SpdRinci::find($request->input('spd_id'));
            return response()->json(['message' => 'Data berhasil disimpan', 'data' => $data], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($spd_id)
    {
        $detailSpd = DB::table('spd_rincis')
            ->join('anggarans', 'spd_rincis.anggaran_id', '=', 'anggarans.id')
            ->join('rekenings', 'anggarans.rekening_id', '=', 'rekenings.id')
            ->join('subs', 'anggarans.sub_id', '=', 'subs.id')
            ->join('kegiatans', 'subs.kegiatan_id', '=', 'kegiatans.id')
            ->join('programs', 'kegiatans.program_id', '=', 'programs.id')
            ->selectRaw('uraian, total, spd_rincis.id, nama_sub, kode_sub, kode_kegiatan, kode_program, kode_rekening, nama_rekening',)
            ->where('spd_id', $spd_id)
            ->get();
        $total_belanja = $detailSpd->sum('total');

        $spd = Spd::findOrFail($spd_id);
        $selisih = $spd->spd_nilai - $total_belanja;

        return response()->json([
            'detailSpd' => $detailSpd,
            'total_belanja' => $total_belanja,
            'selisih' => $selisih,
        ]);
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
    public function destroy( $detail_id)
    {
        $detailSpd = SpdRinci::find($detail_id);

        if (!$detailSpd) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $detailSpd->delete();

        return response()->json(['message' => 'Data berhasil dihapus', 'status' => 'success']);
    }
}
