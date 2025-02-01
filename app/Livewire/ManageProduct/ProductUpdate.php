<?php

namespace App\Livewire\ManageProduct;

use App\Enum\VariantProduct;
use App\Livewire\Forms\ProductForm;
use App\Models\Product;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Update Product')]
class ProductUpdate extends Component
{
    use WithFileUploads;

    public $title = 'Update Product';

    public $text_subtitle = 'This page displays the product data to be changed.';

    public ProductForm $form;

    public Product $product;

    public function variantProduct()
    {
        return VariantProduct::cases();
    }

    public function mount(Product $product): void
    {
        $this->product = $product;
        $this->form->setProduct($product);
    }

    public function render()
    {
        return view('livewire.manage-product.product-update');
    }

    public function edit()
    {
        $this->form->update();

        flash()->success('Data Changed Successfully.');
    }
}
