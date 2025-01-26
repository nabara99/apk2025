<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengelolaRequest;
use App\Http\Requests\UpdatePengelolaRequest;
use App\Models\Decision;
use Illuminate\Http\Request;

class DecisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengelolas = Decision::all();
        return view('pages.pengelola.index', compact('pengelolas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pengelola.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePengelolaRequest $request)
    {
        $data = $request->all();
        Decision::create($data);
        return redirect()->route('pengelola.index')->with('success', 'Pengelola Keuangan berhasil disimpan');
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
    public function edit( $id)
    {
        $pengelola = Decision::findOrFail($id);
        return view('pages.pengelola.edit', compact('pengelola'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePengelolaRequest $request, Decision $pengelola)
    {
        $data = $request->validated();
        $pengelola->update($data);
        return redirect()->route('pengelola.index')->with('success', 'Pengelola Keuangan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
