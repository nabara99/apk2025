<?php

namespace App\Http\Controllers;

use App\Models\Kib;
use App\Http\Requests\StoreKibRequest;
use App\Http\Requests\UpdateKibRequest;
use App\Imports\KibsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class KibController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kibs = Kib::all();
        return view('pages.kib.index', compact('kibs'));
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
    public function store(StoreKibRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Kib $kib)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kib = Kib::findOrFail($id);

        return view('pages.kib.edit', compact('kib'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKibRequest $request, Kib $kib)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kib $kib)
    {
        //
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xlsx'
        ]);

        Excel::import(new KibsImport, $request->file('file'));
        return redirect()->back()->with('success', 'Data kib berhasil diupload');
    }

}
