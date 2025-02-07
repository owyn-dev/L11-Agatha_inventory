<?php

namespace App\Livewire\ManageAccess;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('User List')]
class UserIndex extends Component
{
    public $title = 'User List';

    public $text_subtitle = 'User List is used to display, manage, and monitor user data in the system';

    public function render()
    {
        return view('livewire.manage-access.user-index');
    }
}
