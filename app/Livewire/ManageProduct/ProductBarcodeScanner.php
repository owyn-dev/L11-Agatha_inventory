<?php

namespace App\Livewire\ManageProduct;

use App\Models\InventoryIn;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Barcode Scanner')]
class ProductBarcodeScanner extends Component
{
    public $title = 'Barcode Scanner';

    public $text_subtitle = 'Barcode Scanner is used to display product data in the system';

    public $batch_code;

    public $store_batch_code;

    #[Computed]
    protected function inventoryIn()
    {
        return InventoryIn::query()
            ->when($this->store_batch_code, fn ($query) => $query->where('batch_code', $this->store_batch_code))
            ->with('product')
            ->first();
    }

    public function render()
    {
        return view('livewire.manage-product.product-barcode-scanner');
    }

    public function searchBatchCode()
    {
        if (! empty($this->batch_code)) {
            $this->store_batch_code = $this->batch_code;
        }

        $this->batch_code = '';
    }
}
