<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanPajakPusatExport implements FromView
{
    protected $pajakPusat;
    protected $startDate;
    protected $endDate;
    protected $decision;

    public function __construct($pajakPusat, $startDate, $endDate, $decision)
    {
        $this->pajakPusat = $pajakPusat;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->decision = $decision;
    }

    public function view(): View
    {
        return view('exports.laporan_pajak_pusat', [
            'pajakPusat' => $this->pajakPusat,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'decision' => $this->decision,
        ]);
    }
}
