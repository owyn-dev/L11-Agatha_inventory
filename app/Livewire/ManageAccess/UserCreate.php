<?php

namespace App\Livewire\ManageAccess;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Create User')]
class UserCreate extends Component
{
    public $title = 'Create User';

    public $text_subtitle = 'This page displays for create data user.';

    public function render()
    {
        return view('livewire.manage-access.user-create');
    }
}
