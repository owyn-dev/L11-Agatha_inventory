<?php

namespace App\Livewire\ManageProduct;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Product List')]
class ProductIndex extends Component
{
    public $title = 'Product List';

    public $text_subtitle = 'Product List is used to display, manage, and monitor product data in the system';

    public function render()
    {
        return view('livewire.manage-product.product-index');
    }
}
