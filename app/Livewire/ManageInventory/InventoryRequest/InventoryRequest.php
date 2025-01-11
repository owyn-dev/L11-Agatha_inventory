<?php

namespace App\Livewire\ManageInventory\InventoryRequest;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Production Request List')]
class InventoryRequest extends Component
{
    public $title = 'Production Request List';

    public $text_subtitle = 'Inventory Production Request List is used to display, manage, and monitor production request data in the system';

    public function render()
    {
        return view('livewire.manage-inventory.inventory-request.inventory-request');
    }
}
