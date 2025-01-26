<?php

namespace App\Http\Controllers;

use App\Models\PajakKwitansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PajakKwitansiController extends Controller
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
        $data = PajakKwitansi::create([
            'spd_id' => $request->input('spd_id'),
            'kwi_id' => $request->input('kwi_id'),
            'uraian_pajak' => $request->input('uraian_pajak'),
            'jenis_pajak' => $request->input('jenis_pajak'),
            'billing' => $request->input('billing'),
            'ntpn' => $request->input('ntpn'),
            'tgl_setor' => $request->input('tgl_setor'),
            'ntb' => $request->input('ntb'),
            'nilai_pajak' => str_replace(",", "", $request->input('nilai_pajak')),
        ]);

        $data = PajakKwitansi::find($request->input('kwi_id'));
        return response()->json(['message' => 'Data berhasil disimpan', 'data' => $data], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($kwi_id)
    {
        $pajakKwitansi = DB::table('pajak_kwitansis')
            ->where('kwi_id', $kwi_id)
            ->get();

        return response()->json(['pajakKwitansi' => $pajakKwitansi]);
    }

    public function pajakSpd($id)
    {
        $pajakSpd = DB::table('pajak_kwitansis')
            ->where('spd_id', $id)
            ->get();

        return response()->json(['pajakSpd' => $pajakSpd]);
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
    public function destroy($pajak_id)
    {
        $pajakKwitansi = PajakKwitansi::find($pajak_id);

        if (!$pajakKwitansi) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $pajakKwitansi->delete();

        return response()->json(['message' => 'Data berhasil dihapus', 'status' => 'success']);
    }
}
