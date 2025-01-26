<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\TempKwitansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TempKwitansiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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
            $data = TempKwitansi::create([
                'kwitansi_id' => $request->input('kwitansi_id'),
                'anggaran_id' => $request->input('anggaran_id'),
                'total' => str_replace(",", "", $request->input('total')),
            ]);

            $data = TempKwitansi::find($request->input('kwitansi_id'));
            return response()->json(['message' => 'Data berhasil disimpan', 'data' => $data], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($kwitansi_id)
    {
        $detailKwitansi = DB::table('temp_kwitansis')
            ->join('anggarans', 'temp_kwitansis.anggaran_id', '=', 'anggarans.id')
            ->join('rekenings', 'anggarans.rekening_id', '=', 'rekenings.id')
            ->join('subs', 'anggarans.sub_id', '=', 'subs.id')
            ->join('kegiatans', 'subs.kegiatan_id', '=', 'kegiatans.id')
            ->join('programs', 'kegiatans.program_id', '=', 'programs.id')
            ->selectRaw('uraian, total, temp_kwitansis.id, nama_sub, kode_sub, kode_kegiatan, kode_program, kode_rekening, nama_rekening',)
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
    public function destroy($detail_id)
    {
        $detailKwitansi = TempKwitansi::find($detail_id);

        if (!$detailKwitansi) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $detailKwitansi->delete();

        return response()->json(['message' => 'Data berhasil dihapus', 'status' => 'success']);
    }
}
