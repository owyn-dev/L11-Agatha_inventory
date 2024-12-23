<?php

namespace App\Livewire\ManageInventory\InventoryRequest;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Inventory Request Production List')]
class InventoryRequest extends Component {

    public $title = "Inventory Request Production List";
    public $text_subtitle = "Inventory Request Production List is used to display, manage, and monitor production request data in the system";

    public function render() {
        return view('livewire.manage-inventory.inventory-request.inventory-request');
    }
}
