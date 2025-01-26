<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKegiatanRequest;
use App\Models\Kegiatan;
use App\Models\Pptk;
use App\Models\Program;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kegiatans = Kegiatan::when($request->input('nama_kegiatan'), function ($query, $name) {
            return $query->where('nama_kegiatan', 'like', '%' . $name . '%');
        })
            ->orderBy('id', 'asc')
            ->paginate(10);
        return view('pages.kegiatan.index', compact('kegiatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programs = Program::all();
        $pptks = Pptk::all();
        return view('pages.kegiatan.create', compact('programs', 'pptks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKegiatanRequest $request)
    {
        $data = $request->all();
        Kegiatan::create($data);
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dibuat');
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
        $kegiatan = Kegiatan::findOrFail($id);
        $programs = Program::all();
        $pptks = Pptk::all();
        return view('pages.kegiatan.edit', compact('kegiatan', 'programs', 'pptks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->update($request->all());

        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil dihapus');
    }
}
