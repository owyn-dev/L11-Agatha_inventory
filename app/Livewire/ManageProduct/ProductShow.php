<?php

namespace App\Livewire\ManageProduct;

use App\Models\Product;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Show Product')]
class ProductShow extends Component
{
    public $title = 'Show Product';

    public $text_subtitle = 'This page displays details of product data.';

    #[Locked]
    public Product $product;

    public function render()
    {
        return view('livewire.manage-product.product-show');
    }
}
