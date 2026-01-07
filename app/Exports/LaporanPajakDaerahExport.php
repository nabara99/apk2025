<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanPajakDaerahExport implements FromView
{
    protected $pajakDaerah;
    protected $startDate;
    protected $endDate;
    protected $decision;

    public function __construct($pajakDaerah, $startDate, $endDate, $decision)
    {
        $this->pajakDaerah = $pajakDaerah;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->decision = $decision;
    }

    public function view(): View
    {
        return view('exports.laporan_pajak_daerah', [
            'pajakDaerah' => $this->pajakDaerah,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'decision' => $this->decision,
        ]);
    }
}
