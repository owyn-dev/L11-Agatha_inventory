<?php

namespace App\Livewire\ManageProduct;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Barcode Scanner')]
class ProductBarcodeScanner extends Component
{
    public $title = 'Barcode Scanner';

    public $text_subtitle = 'Barcode Scanner is used to display product data in the system';

    public function render()
    {
        return view('livewire.manage-product.product-barcode-scanner');
    }
}
