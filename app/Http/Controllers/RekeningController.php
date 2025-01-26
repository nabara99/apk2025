<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRekeningRequest;
use App\Http\Requests\UpdateRekeningRequest;
use App\Models\Rekening;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $rekenings = DB::table('rekenings')
            ->when($request->input('nama_rekening'), function ($query, $name) {
                return $query->where('nama_rekening', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'asc')
            ->paginate(10);
        return view('pages.rekening.index', compact('rekenings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.rekening.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRekeningRequest $request)
    {
        $data = $request->all();
        Rekening::create($data);
        return redirect()->route('rekening.index')->with('success', 'Rekening berhasil dibuat');
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
        $rekening = Rekening::findOrFail($id);
        return view('pages.rekening.edit', compact('rekening'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRekeningRequest $request, Rekening $rekening)
    {
        $data = $request->validated();
        $rekening->update($data);
        return redirect()->route('rekening.index')->with('success', 'Rekening berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rekening $rekening)
    {
        $rekening->delete();
        return redirect()->route('rekening.index')->with('success', 'Rekening berhasil dihapus');
    }
}
