<?php

namespace App\Livewire\ManageInventory\InventoryRequest;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Update Production Request')]
class InventoryRequestUpdateStatus extends Component {

    public $title = "Update Production Request";
    public $text_subtitle = "This page displays the production request data to be changed.";

    public function render() {
        return view('livewire.manage-inventory.inventory-request.inventory-request-update-status');
    }
}
