<?php

namespace App\Livewire\ManageProduct;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Show Product')]
class ProductShow extends Component {

    public $title = "Show Product";
    public $text_subtitle = "This page displays details of product data.";

    public function render() {
        return view('livewire.manage-product.product-show');
    }
}
