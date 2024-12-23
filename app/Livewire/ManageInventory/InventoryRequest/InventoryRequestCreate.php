<?php

namespace App\Livewire\ManageInventory\InventoryRequest;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Create Request Production')]
class InventoryRequestCreate extends Component {

    public $title = "Create Request Production";
    public $text_subtitle = "This page displays for create data request production.";

    public function render() {
        return view('livewire.manage-inventory.inventory-request.inventory-request-create');
    }
}
