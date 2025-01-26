<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnggaranRequest;
use App\Models\Anggaran;
use App\Models\Rekening;
use App\Models\Sub;
use Illuminate\Http\Request;

class AnggaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $total_pagu = Anggaran::sum('pagu');
        $anggarans = Anggaran::when($request->input('uraian'), function ($query, $name) {
            return $query->where('uraian', 'like', '%' . $name . '%');
        })
            ->orderBy('id', 'asc')
            ->paginate(10);
        return view('pages.anggaran.index', compact('anggarans', 'total_pagu'));
    }

    public function dashboard()
    {
        $total_pagu = Anggaran::sum('pagu');
        dd($total_pagu);
        return view('pages.dashboard', compact('total_pagu'));
    }

    /**
     * Show the form for creating a new resource.
     */


    public function create(Request $request)
    {
        $subs = Sub::all();
        $rekenings = Rekening::all();
        return view('pages.anggaran.create', compact('subs', 'rekenings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnggaranRequest $request)
    {
        $anggaran = new Anggaran();
        $anggaran->sub_id = $request->sub_id;
        $anggaran->rekening_id = $request->rekening_id;
        $anggaran->uraian = $request->uraian;
        $anggaran->pagu = str_replace(",", "", $request->pagu);
        $anggaran->sisa_pagu = str_replace(",", "", $request->pagu);

        $anggaran->save();
        return redirect()->route('anggaran.index')->with('success', 'Anggaran berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $anggaran = Anggaran::findOrFail($id);

        return response()->json(['data' => $anggaran]);
    }

    public function edit($id)
    {
        $anggaran = Anggaran::findOrFail($id);
        $subs = Sub::all();
        $rekenings = Rekening::all();
        return view('pages.anggaran.edit', compact('anggaran', 'subs', 'rekenings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $anggaran = Anggaran::findOrFail($id);

        $anggaran->update([
            'sub_id' => $request->sub_id,
            'rekening_id' => $request->rekening_id,
            'uraian' => $request->uraian,
            'pagu' => str_replace(",", "", $request->pagu),
            'sisa_pagu' => str_replace(",", "", $request->sisa_pagu),
        ]);

        return redirect()->route('anggaran.index')->with('success', 'Anggaran berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anggaran $anggaran)
    {
        // $anggaran->delete();
        // return redirect()->route('anggaran.index')->with('success', 'Anggaran berhasil dihapus');
    }
}
