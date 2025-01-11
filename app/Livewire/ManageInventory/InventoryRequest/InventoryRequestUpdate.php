<?php

namespace App\Livewire\ManageInventory\InventoryRequest;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Update Production Request')]
class InventoryRequestUpdate extends Component
{
    public $title = 'Update Production Request';

    public $text_subtitle = 'This page displays the production request data to be changed.';

    public function render()
    {
        return view('livewire.manage-inventory.inventory-request.inventory-request-update');
    }
}
