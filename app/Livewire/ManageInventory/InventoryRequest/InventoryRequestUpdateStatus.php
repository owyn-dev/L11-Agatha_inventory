<?php

namespace App\Livewire\ManageInventory\InventoryRequest;

use App\Enum\StatusProduction;
use App\Models\Production;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Update Production Request')]
class InventoryRequestUpdateStatus extends Component
{
    public $title = 'Update Production Request';

    public $text_subtitle = 'This page displays the production request data to be changed.';

    public Production $production;

    public $note = '';

    public $productList = [];

    public function mount(Production $production): void
    {
        $this->production = Production::with('detailProductions.product')->find($production->id);

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
        return view('livewire.manage-inventory.inventory-request.inventory-request-update-status');
    }

    public function edit()
    {
        $this->validate([
            'note' => ['required'],
        ]);

        $this->production->update([
            'note' => $this->note,
            'status' => StatusProduction::REJECTED,
        ]);

        $this->redirect(route('inventory.request.index'), navigate: true);
        flash()->success('Data Changed Successfully.');
    }
}
