<?php

namespace App\Livewire\ManageProduction;

use App\Enum\StatusProduction;
use App\Models\DetailProduction;
use App\Models\Production;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules\Enum;
use Livewire\Attributes\Title;
use Livewire\Component;
use Milon\Barcode\DNS1D;

#[Title('Update Production')]
class ProductionUpdate extends Component
{
    public $title = 'Update Production';

    public $text_subtitle = 'This page displays the production data to be changed.';

    public Production $production;

    public $production_date;

    public $status;

    public $note = '';

    public $productList = [];

    public function statusProduction()
    {
        return [
            StatusProduction::COMPLETE,
            StatusProduction::REJECTED,
        ];
    }

    public function mount(Production $production): void
    {
        $this->production = Production::with('detailProductions.product')->find($production->id);

        $this->production_date = \Carbon\Carbon::parse($production->production_date)->format('Y-m-d');
        $this->note = $production->note;

        if ($production->detailProductions) {
            $this->productList = [];

            foreach ($production->detailProductions as $detail) {
                $product = $detail->product;

                $this->productList[$product->id] = [
                    'product_id' => $product->id,
                    'code' => $product->code,
                    'name' => $product->name,
                    'variant' => $product->variant?->label(),
                    'price' => $product->price,
                    'batch_code' => $detail->batch_code,
                    'shelf_name' => $detail->shelf_name,
                    'quantity' => $detail->quantity,
                ];
            }
        } else {
            $this->productList = [];
        }
    }

    public function render()
    {
        return view('livewire.manage-production.production-update');
    }

    public function edit()
    {
        if (empty($this->productList)) {
            return flash()->warning('The Product Production List is still empty!');
        }

        $this->validate([
            'production_date' => ['required', 'date'],
            'status' => ['required', new Enum(StatusProduction::class)],
            'note' => ['required'],
        ]);

        if ($this->status = StatusProduction::COMPLETE) {
            $current_status = StatusProduction::PENDING_APPROVAL;
        } else {
            $current_status = StatusProduction::REJECTED;
        }

        $this->production->update([
            'inventory_user_id' => auth()->user()->id,
            'status' => $current_status,
            'production_date' => $this->production_date,
            'note' => $this->note,
        ]);

        $this->redirect(route('production.index'), navigate: true);

        return flash()->success('Data Changed Successfully.');
    }

    public function generateBarcodePdf($detail_production_id)
    {
        $detail_production = DetailProduction::with('production')->findOrFail($detail_production_id);

        $barcodes = [];
        $barcodeGenerator = new DNS1D;

        for ($i = 0; $i < $detail_production->quantity; $i++) {
            $barcodes[] = [
                'product_name' => $detail_production->product->name,
                'code' => $detail_production->product->code,
                'barcode' => $barcodeGenerator->getBarcodeHTML($detail_production->batch_code, 'C128', 2, 40),
                'expiry_date' => Carbon::parse($detail_production->production->production_date)
                    ->addDays($detail_production->product->expired_day)
                    ->format('Y-m-d'),
            ];
        }

        $pdf = Pdf::loadView('livewire.layouts.barcode', compact('barcodes'));

        $filename = 'Production_Barcodes_'.now()->format('Ymd').'.pdf';

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, $filename);
    }
}
