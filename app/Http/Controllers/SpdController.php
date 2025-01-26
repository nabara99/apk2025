<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpdRequest;
use App\Models\Anggaran;
use App\Models\Spd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $spds = DB::table('spds')
            ->when($request->input('spd_uraian'), function ($query, $name) {
                return $query->where('spd_uraian', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'asc')
            ->paginate(5);
        return view('pages.spd.index', compact('spds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.spd.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpdRequest $request)
    {
        $spd = new Spd();
        $spd->no_spd = $request->no_spd;
        $spd->spd_tgl = $request->spd_tgl;
        $spd->spd_uraian = $request->spd_uraian;
        $spd->jenis = $request->jenis;
        $spd->spd_nilai = str_replace(",", "", $request->spd_nilai);
        $spd->spd_sisa = str_replace(",", "", $request->spd_nilai);
        $spd->iwp1 = str_replace(",", "", $request->iwp1);
        $spd->iwp8 = str_replace(",", "", $request->iwp8);
        $spd->pph21 = str_replace(",", "", $request->pph21);
        $spd->pph22 = str_replace(",", "", $request->pph22);
        $spd->pph23 = str_replace(",", "", $request->pph23);
        $spd->ppn = str_replace(",", "", $request->ppn);

        $spd->save();
        return redirect()->route('spd.index')->with('success', 'SP2D berhasil disimpan');
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
    public function edit($id)
    {
        $spd = Spd::findOrFail($id);

        return view('pages.spd.edit', compact('spd'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $spd = Spd::findOrFail($id);
        $spd->update([
            'no_spd' => $request->no_spd,
            'spd_tgl' => $request->spd_tgl,
            'spd_uraian' => $request->spd_uraian,
            'jenis' => $request->jenis,
            'spd_nilai' => str_replace(",", "", $request->spd_nilai),
            'iwp1' => str_replace(",", "", $request->iwp1),
            'iwp8' => str_replace(",", "", $request->iwp8),
            'pph21' => str_replace(",", "", $request->pph21),
            'pph22' => str_replace(",", "", $request->pph22),
            'pph23' => str_replace(",", "", $request->pph23),
            'ppn' => str_replace(",", "", $request->ppn),
        ]);

        return redirect()->route('spd.index')->with('success', 'SP2D berhasil diupdate');
    }

    public function detail($id)
    {
        $spd = Spd::findOrFail($id);
        $anggarans = Anggaran::all();

        return view('pages.spd.input_detail', compact('spd', 'anggarans'));
    }

    public function tax($id)
    {
        $spd = Spd::findOrFail($id);

        return view('pages.spd.input_pajak', compact('spd'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spd $spd)
    {
        // $spd->delete();
        // return redirect()->route('spd.index')->with('success', 'SP2D telah dihapus');
    }
}
