<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanSpdExport implements FromView
{
    protected $spds;
    protected $startDate;
    protected $endDate;
    protected $jenisSpd;
    protected $decision;

    public function __construct($spds, $startDate, $endDate, $jenisSpd, $decision)
    {
        $this->spds = $spds;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->jenisSpd = $jenisSpd;
        $this->decision = $decision;
    }

    public function view(): View
    {
        return view('exports.laporan_spd', [
            'spds' => $this->spds,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'jenisSpd' => $this->jenisSpd,
            'decision' => $this->decision,
        ]);
    }
}
