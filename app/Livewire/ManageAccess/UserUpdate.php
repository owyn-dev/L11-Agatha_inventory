<?php

namespace App\Livewire\ManageAccess;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Update User')]
class UserUpdate extends Component
{
    public $title = 'Update User';

    public $text_subtitle = 'This page displays the profile of user data.';

    public function render()
    {
        return view('livewire.manage-access.user-update');
    }
}
