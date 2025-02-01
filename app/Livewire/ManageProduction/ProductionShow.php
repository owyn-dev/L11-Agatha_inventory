<?php

namespace App\Livewire\ManageProduction;

use App\Models\DetailProduction;
use App\Models\Production;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Component;
use Milon\Barcode\DNS1D;

#[Title('Show Production')]
class ProductionShow extends Component
{
    public $title = 'Show Production';

    public $text_subtitle = 'This page displays details of production data.';

    #[Locked]
    public Production $production;

    public function mount(Production $production)
    {
        $this->production = $production->with('detailProductions', 'detailProductions.product', 'inventoryUser', 'productionUser')->find($production->id);
    }

    public function render()
    {
        return view('livewire.manage-production.production-show');
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
