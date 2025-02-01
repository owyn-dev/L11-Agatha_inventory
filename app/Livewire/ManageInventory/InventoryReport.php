<?php

namespace App\Livewire\ManageInventory;

use App\Models\InventoryIn;
use App\Models\InventoryOut;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Inventory Report')]
class InventoryReport extends Component
{
    public $title = 'Inventory Report';

    public $text_subtitle = 'Generate Inventory Reports instantly';

    public $startDate;

    public $endDate;

    public $activeTab = 'inventory_in';

    public $inventoryIn = [];

    public $inventoryOut = [];

    public function mount()
    {
        $this->loadInventoryIn();
    }

    public function render()
    {
        return view('livewire.manage-inventory.inventory-report');
    }

    public function generateReport()
    {
        $this->validate([
            'startDate' => 'required|date',
            'endDate' => 'required|date|after_or_equal:startDate',
        ]);

        $this->loadInventoryIn();
    }

    public function loadInventoryIn()
    {
        if (! $this->startDate || ! $this->endDate) {
            $this->inventoryIn = [];

            return;
        }

        if (empty($this->inventoryIn)) {
            $this->inventoryIn = InventoryIn::whereBetween('transaction_date', [$this->startDate, $this->endDate])
                ->orderBy('transaction_date', 'desc')
                ->get();
        }
    }

    public function loadInventoryOut()
    {
        if (! $this->startDate || ! $this->endDate) {
            $this->inventoryOut = [];

            return;
        }

        if (empty($this->inventoryOut)) {
            $this->inventoryOut = InventoryOut::whereBetween('transaction_date', [$this->startDate, $this->endDate])
                ->orderBy('transaction_date', 'desc')
                ->get();
        }
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;

        if ($tab === 'inventory_out') {
            $this->loadInventoryOut();
        }
    }

    public function exportInventoryInPdf()
    {
        if (! $this->startDate || ! $this->endDate) {
            session()->flash('error', 'Please select a date range first.');

            return;
        }

        $data = [
            'title' => 'Inventory [IN] Report',
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'inventoryIn' => $this->inventoryIn,
        ];

        $pdf = Pdf::loadView('livewire.manage-inventory.inventory-in.inventory-export-report', $data)->setPaper('a4', 'landscape');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, "inventory_in_{$this->startDate}_to_{$this->endDate}.pdf");
    }

    public function exportInventoryOutPdf()
    {
        if (! $this->startDate || ! $this->endDate) {
            session()->flash('error', 'Please select a date range first.');

            return;
        }

        $data = [
            'title' => 'Inventory [OUT] Report',
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'inventoryOut' => $this->inventoryOut,
        ];

        $pdf = Pdf::loadView('livewire.manage-inventory.inventory-out.inventory-export-report', $data)->setPaper('a4', 'landscape');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, "inventory_out_{$this->startDate}_to_{$this->endDate}.pdf");
    }
}
