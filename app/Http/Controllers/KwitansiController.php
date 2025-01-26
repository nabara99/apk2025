<?php

namespace App\Http\Controllers;

use App\Models\Anggaran;
use App\Models\Decision;
use App\Models\Kwitansi;
use App\Models\Penerima;
use App\Models\Spd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KwitansiController extends Controller
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
        return view('pages.kwitansi.index', compact('kwitansis'));
    }

    public function create()
    {
        $lastFaktur = DB::table('kwitansis')->orderBy('kw_id', 'desc')->first();
        $item = new Kwitansi();
        $item->no_faktur = $lastFaktur ? $lastFaktur->kw_id + 1 : 1;

        $anggarans = Anggaran::all();
        $penerimas = Penerima::all();

        return view('pages.kwitansi.create', compact('item', 'anggarans', 'penerimas'));
    }

    public function modalcaripagu()
    {
        $anggarans = DB::table('anggarans')
            ->join('subs', 'anggarans.sub_id', '=', 'subs.id')
            ->join('rekenings', 'anggarans.rekening_id', '=', 'rekenings.id')
            ->join('kegiatans', 'subs.kegiatan_id', '=', 'kegiatans.id')
            ->join('programs', 'kegiatans.program_id', '=', 'programs.id')
            ->selectRaw('anggarans.id, sisa_pagu,nama_sub, kode_sub, kode_kegiatan, kode_program, uraian, kode_rekening')
            ->get();

        return response()->json(['data' => $anggarans]);
    }

    public function modalcaripenerima()
    {
        $penerimas = Penerima::all();

        return response()->json(['data' => $penerimas]);
    }


    public function store(Request $request)
    {
        try {
            $requiredInputs = ['kwitansi_id', 'tgl', 'hal', 'total_belanja', 'idpenerima', 'ppn', 'pph21', 'pph22', 'pph23', 'pajakdaerah', 'sisa', 'anggaran_id'];
            foreach ($requiredInputs as $input) {
                if (!$request->has($input)) {
                    return response()->json(['message' => 'Data tidak lengkap'], 400);
                }
            }
            $kw_id = $request->input('kwitansi_id');
            $tgl = $request->input('tgl');

            $data = Kwitansi::create([
                'kw_id' => $kw_id,
                'tgl' => $tgl,
                'hal' => $request->input('hal'),
                'nilai' => str_replace(",", "", $request->input('total_belanja')),
                'penerima_id' => $request->input('idpenerima'),
                'anggaran_id' => $request->input('anggaran_id'),
                'ppn' => str_replace(",", "", $request->input('ppn')),
                'pph21' => str_replace(",", "", $request->input('pph21')),
                'pph22' => str_replace(",", "", $request->input('pph22')),
                'pph23' => str_replace(",", "", $request->input('pph23')),
                'pdaerah' => str_replace(",", "", $request->input('pajakdaerah')),
                'sisa' => str_replace(",", "", $request->input('sisa')),
            ]);

            return response()->json(['message' => 'Data berhasil disimpan', 'data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menyimpan data'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($kwitansi_id)
    {
        $pengelolas = Decision::all();
        $kwitansi = Kwitansi::where('kw_id', $kwitansi_id)->firstOrFail();
        return view(
            'pages.kwitansi.cetak',
            [
                'kwitansi' => $kwitansi,
                'pengelolas' => $pengelolas
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kwitansi_id)
    {
        $penerimas = Penerima::all();
        $anggarans = Anggaran::all();
        $kwitansis = Kwitansi::findOrFail($kwitansi_id);
        return view('pages.kwitansi.editkwitansi', compact('penerimas', 'kwitansis', 'anggarans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kwitansi = Kwitansi::findOrFail($id);

        $kwitansi->update([
            'tgl' => $request->tgl,
            'hal' => $request->hal,
            'nilai' => str_replace(",", "", $request->nilai),
            'ppn' => str_replace(",", "", $request->ppn),
            'pph21' => str_replace(",", "", $request->pph21),
            'pph22' => str_replace(",", "", $request->pph22),
            'pph23' => str_replace(",", "", $request->pph23),
            'pdaerah' => str_replace(",", "", $request->pdaerah),
            'sisa' => str_replace(",", "", $request->sisa),
            'penerima_id' => $request->penerima_id,
            'anggaran_id' => $request->anggaran_id,
            'file' => $request->file,
        ]);

        return redirect()->route('kwitansi.index')->with('success', 'Kwitansi berhasil diupdate');
    }

    public function pajak($id)
    {
        $kwitansi = Kwitansi::findOrFail($id);
        $spds = Spd::all();

        return view('pages.kwitansi.input_pajak', compact('kwitansi', 'spds'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
