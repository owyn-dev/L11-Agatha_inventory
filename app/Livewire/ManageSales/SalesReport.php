<?php

namespace App\Livewire\ManageSales;

use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Sales Report')]
class SalesReport extends Component
{
    public $title = 'Sales Report';

    public $text_subtitle = 'Generate Sales Reports instantly';

    public $startDate;

    public $endDate;

    public $reports = [];

    public $totalAmount = 0;

    public function render()
    {
        return view('livewire.manage-sales.sales-report');
    }

    public function generateReport()
    {
        $this->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        $this->reports = Sale::whereBetween('transaction_date', [$this->startDate, $this->endDate])
            ->with(['detailSales.product'])
            ->get();

        $this->totalAmount = $this->reports->sum('total_amount');
    }

    public function exportPDF()
    {
        $this->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        $reports = Sale::whereBetween('transaction_date', [$this->startDate, $this->endDate])
            ->with(['detailSales.product'])
            ->get();

        $totalAmount = $reports->sum('total_amount');
        $pdf = Pdf::loadView('livewire.manage-sales.sales-export-report', ['reports' => $reports, 'totalAmount' => $totalAmount, 'startDate' => $this->startDate, 'endDate' => $this->endDate]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'Sales_Report_'.now()->format('Y-m-d').'.pdf');
    }
}
