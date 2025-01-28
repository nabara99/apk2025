<?php

namespace App\Http\Controllers;

use App\Models\Sk;
use App\Http\Requests\StoreSkRequest;
use App\Http\Requests\UpdateSkRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sks = Sk::all();
        return view('pages.sk.index', compact('sks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.sk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_sk' => 'required',
            'number_sk' => 'required',
            'date_sk' => 'required',
            'signer' => 'required',
            'scan' => 'file|mimes:pdf|max:2048'
        ]);

        $sk = Sk::create([
            'name_sk' => $request->name_sk,
            'number_sk' => $request->number_sk,
            'date_sk' => $request->date_sk,
            'signer' => $request->signer,
        ]);

        if ($request->hasFile('scan')) {
            $file = $request->file('scan');
            $file->storeAs('public/sk', $sk->id . '.' . $file->getClientOriginalExtension());
            $sk->scan = 'storage/sk/' . $sk->id . '.' . $file->getClientOriginalExtension();
            $sk->save();
        }

        return redirect()->route('sk.index')->with('success', 'Data & dokumen SK berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sk $sk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $sk = Sk::findOrFail($id);
        return view('pages.sk.edit', compact('sk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name_sk' => 'required',
            'number_sk' => 'required',
            'date_sk' => 'required',
            'signer' => 'required',
            'scan' => 'file|mimes:pdf|max:2048'
        ]);

        $sk = Sk::find($id);
        $sk->name_sk = $request->name_sk;
        $sk->number_sk = $request->number_sk;
        $sk->date_sk = $request->date_sk;
        $sk->signer = $request->signer;

        if ($request->hasFile('scan')) {
            if ($sk->scan) {
                $oldFilePath = str_replace('storage', 'public', $sk->scan);
                Storage::delete($oldFilePath);
            }
            $file = $request->file('scan');
            $file->storeAs('public/sk', $sk->id . '.' . $file->getClientOriginalExtension());
            $sk->scan = 'storage/sk/' . $sk->id . '.' . $file->getClientOriginalExtension();
        }
        $sk->save();

        return redirect()->route('sk.index')->with('success', 'Data & dokumen SK berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sk $sk)
    {
        //
    }
}
