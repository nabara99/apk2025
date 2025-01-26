<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramRequest;
use App\Http\Requests\UpdateProgramRequest;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $programs = DB::table('programs')
            ->when($request->input('nama_program'), function ($query, $name) {
                return $query->where('nama_program', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'asc')
            ->paginate(10);
        return view('pages.program.index', compact('programs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.program.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProgramRequest $request)
    {
        $data = $request->all();
        Program::create($data);
        return redirect()->route('program.index')->with('success', 'Program berhasil dibuat');
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
        $program = Program::findOrFail($id);
        return view('pages.program.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProgramRequest $request,Program $program)
    {
        $data = $request->validated();
        $program->update($data);
        return redirect()->route('program.index')->with('success', 'Program berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Program $program)
    {
        $program->delete();
        return redirect()->route('program.index')->with('success', 'Program berhasil dihapus');
    }
}
