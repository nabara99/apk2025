<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\TempKwitansiTu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TempKwitansiTuController extends Controller
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
            $data = TempKwitansiTu::create([
                'kwitansi_id' => $request->input('kwitansi_id'),
                'anggaran_id' => $request->input('anggaran_id'),
                'total' => str_replace(",", "", $request->input('total')),
            ]);

            $data = TempKwitansiTu::find($request->input('kwitansi_id'));
            return response()->json(['message' => 'Data berhasil disimpan', 'data' => $data], 200);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($kwitansi_id)
    {
        $detailKwitansi = DB::table('temp_kwitansi_tus')
            ->join('anggarans', 'temp_kwitansi_tus.anggaran_id', '=', 'anggarans.id')
            ->join('rekenings', 'anggarans.rekening_id', '=', 'rekenings.id')
            ->join('subs', 'anggarans.sub_id', '=', 'subs.id')
            ->join('kegiatans', 'subs.kegiatan_id', '=', 'kegiatans.id')
            ->join('programs', 'kegiatans.program_id', '=', 'programs.id')
            ->selectRaw('uraian, total, temp_kwitansi_tus.id, nama_sub, kode_sub, kode_kegiatan, kode_program, kode_rekening, nama_rekening',)
            ->where('kwitansi_id', $kwitansi_id)
            ->get();
        $total_belanja = $detailKwitansi->sum('total');

        return response()->json([
            'detailKwitansi' => $detailKwitansi,
            'total_belanja' => $total_belanja,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TempKwitansiTu $tempKwitansiTu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTempKwitansiTuRequest $request, TempKwitansiTu $tempKwitansiTu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($detail_id)
    {
        $detailKwitansi = TempKwitansiTu::find($detail_id);

        if (!$detailKwitansi) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $detailKwitansi->delete();

        return response()->json(['message' => 'Data berhasil dihapus', 'status' => 'success']);

    }
}
