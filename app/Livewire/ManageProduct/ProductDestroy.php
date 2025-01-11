<?php

namespace App\Livewire\ManageProduct;

use Livewire\Component;

class ProductDestroy extends Component
{
    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }
}
