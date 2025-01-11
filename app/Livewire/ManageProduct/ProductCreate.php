<?php

namespace App\Livewire\ManageProduct;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Create Product')]
class ProductCreate extends Component
{
    public $title = 'Create Product';

    public $text_subtitle = 'This page displays for create data product.';

    public function render()
    {
        return view('livewire.manage-product.product-create');
    }
}
