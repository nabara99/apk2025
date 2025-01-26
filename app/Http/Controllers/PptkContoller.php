<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePptkRequest;
use App\Http\Requests\UpdatePptkRequest;
use App\Models\Pptk;
use Illuminate\Http\Request;

class PptkContoller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pptks = Pptk::all();
        return view('pages.pptk.index', compact('pptks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.pptk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePptkRequest $request)
    {
        $data = $request->all();
        Pptk::create($data);
        return redirect()->route('pptk.index')->with('success', 'PPTK berhasil disimpan');
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
        $pptk = Pptk::findOrFail($id);
        return view('pages.pptk.edit', compact('pptk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePptkRequest $request, $id)
    {
        $pptk = Pptk::findOrFail($id);
        $pptk->update($request->all());

        return redirect()->route('pptk.index')->with('success', 'PPTK berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
