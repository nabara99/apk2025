<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RekapBelanjaExport implements FromView
{
    protected $rekapBelanja;
    protected $totalJanuari;
    protected $totalFebruari;
    protected $totalMaret;
    protected $totalApril;
    protected $totalMei;
    protected $totalJuni;
    protected $totalJuli;
    protected $totalAgustus;
    protected $totalSeptember;
    protected $totalOktober;
    protected $totalNovember;
    protected $totalDesember;
    protected $totalPagu;
    protected $decision;
    protected $startDate;
    protected $endDate;

    public function __construct(
        $rekapBelanja,
        $totalJanuari,
        $totalFebruari,
        $totalMaret,
        $totalApril,
        $totalMei,
        $totalJuni,
        $totalJuli,
        $totalAgustus,
        $totalSeptember,
        $totalOktober,
        $totalNovember,
        $totalDesember,
        $totalPagu,
        $decision,
        $startDate,
        $endDate
    ) {
        $this->rekapBelanja = $rekapBelanja;
        $this->totalJanuari = $totalJanuari;
        $this->totalFebruari = $totalFebruari;
        $this->totalMaret = $totalMaret;
        $this->totalApril = $totalApril;
        $this->totalMei = $totalMei;
        $this->totalJuni = $totalJuni;
        $this->totalJuli = $totalJuli;
        $this->totalAgustus = $totalAgustus;
        $this->totalSeptember = $totalSeptember;
        $this->totalOktober = $totalOktober;
        $this->totalNovember = $totalNovember;
        $this->totalDesember = $totalDesember;
        $this->totalPagu = $totalPagu;
        $this->decision = $decision;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function view(): View
    {
        return view('exports.rekap_belanja', [
            'rekapBelanja' => $this->rekapBelanja,
            'totalJanuari' => $this->totalJanuari,
            'totalFebruari' => $this->totalFebruari,
            'totalMaret' => $this->totalMaret,
            'totalApril' => $this->totalApril,
            'totalMei' => $this->totalMei,
            'totalJuni' => $this->totalJuni,
            'totalJuli' => $this->totalJuli,
            'totalAgustus' => $this->totalAgustus,
            'totalSeptember' => $this->totalSeptember,
            'totalOktober' => $this->totalOktober,
            'totalNovember' => $this->totalNovember,
            'totalDesember' => $this->totalDesember,
            'totalPagu' => $this->totalPagu,
            'decision' => $this->decision,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
        ]);
    }
}
