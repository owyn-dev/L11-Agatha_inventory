<?php

namespace App\Livewire\ManageProduct;

use App\Enum\VariantProduct;
use App\Livewire\Forms\ProductForm;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Create Product')]
class ProductCreate extends Component
{
    use WithFileUploads;

    public $title = 'Create Product';

    public $text_subtitle = 'This page displays for create data product.';

    public ProductForm $form;

    public function variantProduct()
    {
        return VariantProduct::cases();
    }

    public function render()
    {
        return view('livewire.manage-product.product-create');
    }

    public function save()
    {
        $this->form->store();

        flash()->success('Data Saved Successfully.');
    }
}
