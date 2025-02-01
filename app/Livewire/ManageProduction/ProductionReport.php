<?php

namespace App\Livewire\ManageProduction;

use App\Models\Production;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Production Report')]
class ProductionReport extends Component
{
    public $title = 'Production Report';

    public $text_subtitle = 'Generate Production Reports instantly';

    public $startDate;

    public $endDate;

    public $reports = [];

    public function render()
    {
        return view('livewire.manage-production.production-report');
    }

    public function generateReport()
    {
        $this->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        $this->reports = Production::whereBetween('production_date', [$this->startDate, $this->endDate])
            ->with(['detailProductions.product'])
            ->get();
    }

    public function exportPDF()
    {
        $this->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        $reports = Production::whereBetween('production_date', [$this->startDate, $this->endDate])
            ->with(['detailProductions.product'])
            ->get();

        $pdf = Pdf::loadView('livewire.manage-production.production-export-report', ['reports' => $reports, 'startDate' => $this->startDate, 'endDate' => $this->endDate]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'Production_Report_'.now()->format('Y-m-d').'.pdf');
    }
}
