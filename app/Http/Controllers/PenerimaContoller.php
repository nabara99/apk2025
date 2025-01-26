<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePenerimaRequest;
use App\Models\Penerima;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenerimaContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $penerimas = DB::table('penerimas')
            ->when($request->input('nama_penerima'), function ($query, $name) {
                return $query->where('nama_penerima', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
        return  view('pages.penerima.index', compact('penerimas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.penerima.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePenerimaRequest $request)
    {
        $data = $request->all();
        Penerima::create($data);
        return redirect()->route('penerima.index')->with('success', 'Rekanan berhasil dibuat');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $penerima = Penerima::findOrFail($id);

        return response()->json(['data' => $penerima]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $penerima = Penerima::findOrFail($id);
        return view('pages.penerima.edit', compact('penerima'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $penerima = Penerima::findOrFail($id);
        $penerima->update($request->all());
        return redirect()->route('penerima.index')->with('success', 'Rekanan berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penerima $penerima)
    {
        $penerima->delete();
        return redirect()->route('penerima.index')->with('success', 'Rekanan berhasil dihapus');
    }
}
