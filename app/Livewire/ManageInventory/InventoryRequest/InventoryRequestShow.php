<?php

namespace App\Livewire\ManageInventory\InventoryRequest;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Show Request Production')]
class InventoryRequestShow extends Component
{
    public $title = 'Show Request Production';

    public $text_subtitle = 'This page displays details of request production data.';

    public function render()
    {
        return view('livewire.manage-inventory.inventory-request.inventory-request-show');
    }
}
