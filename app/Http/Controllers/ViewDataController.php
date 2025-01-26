<?php

namespace App\Http\Controllers;

use App\Models\Kwitansi;
use Illuminate\Http\Request;

class ViewDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $kwitansis = Kwitansi::when($request->input('hal'), function ($query, $name) {
            return $query->where('hal', 'like', '%' . $name . '%');
        })
            ->orderBy('kw_id', 'asc')
            ->paginate(5);

        return view('pages.viewer.index', compact('kwitansis'));
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
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
