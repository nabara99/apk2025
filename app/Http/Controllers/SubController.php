<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubRequest;
use App\Models\Kegiatan;
use App\Models\Sub;
use Illuminate\Http\Request;

class SubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $subs = Sub::when($request->input('nama_sub'), function ($query, $name) {
            return $query->where('nama_sub', 'like', '%' . $name . '%');
        })
            ->orderBy('id', 'asc')
            ->paginate(10);
        return view('pages.sub.index', compact('subs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kegiatans = Kegiatan::all();
        return view('pages.sub.create', compact('kegiatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSubRequest $request)
    {
        $data = $request->all();
        Sub::create($data);
        return redirect()->route('sub.index')->with('success', 'Sub Kegiatan berhasil dibuat');
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
        $sub = Sub::findOrFail($id);
        $kegiatans = Kegiatan::all();
        return view('pages.sub.edit', compact('sub', 'kegiatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sub = Sub::findOrFail($id);
        $sub->update($request->all());

        return redirect()->route('sub.index')->with('success', 'Sub Kegiatan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
