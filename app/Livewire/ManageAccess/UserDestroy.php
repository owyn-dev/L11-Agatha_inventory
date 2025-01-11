<?php

namespace App\Livewire\ManageAccess;

use Livewire\Component;

class UserDestroy extends Component
{
    public $id;

    public function mount($id)
    {
        $this->id = $id;
    }
}
