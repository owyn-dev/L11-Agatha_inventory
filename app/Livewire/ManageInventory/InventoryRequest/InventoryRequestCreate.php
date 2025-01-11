<?php

namespace App\Livewire\ManageInventory\InventoryRequest;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Create Production Request')]
class InventoryRequestCreate extends Component
{
    public $title = 'Create Production Request';

    public $text_subtitle = 'This page displays for create data production request.';

    public function render()
    {
        return view('livewire.manage-inventory.inventory-request.inventory-request-create');
    }
}
