<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Kwitansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dpas = Anggaran::sum('pagu');
        $sisas = Anggaran::sum('sisa_pagu');
        $kwitansi = Kwitansi::count('kw_id');

        $anggarans = DB::table('anggarans')
            ->join('subs', 'anggarans.sub_id', '=', 'subs.id')
            ->join('kegiatans', 'subs.kegiatan_id', '=', 'kegiatans.id')
            ->join('programs', 'kegiatans.program_id', '=', 'programs.id')
            ->selectRaw('sum(pagu) as nilai, sum(sisa_pagu) as realisasi,nama_sub, kode_sub, kode_kegiatan, kode_program')
            ->groupBy('nama_sub', 'kode_sub', 'kode_kegiatan', 'kode_program')
            ->orderBy('programs.kode_program', 'desc')
            ->get();

        return view('pages.dashboard', compact('anggarans', 'dpas', 'sisas', 'kwitansi'));
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
