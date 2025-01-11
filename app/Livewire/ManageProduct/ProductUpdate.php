<?php

namespace App\Livewire\ManageProduct;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Update Product')]
class ProductUpdate extends Component
{
    public $title = 'Update Product';

    public $text_subtitle = 'This page displays the product data to be changed.';

    public function render()
    {
        return view('livewire.manage-product.product-update');
    }
}
