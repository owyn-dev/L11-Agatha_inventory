<?php

namespace App\Livewire\ManageAccess;

use App\Models\User;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Show User')]
class UserShow extends Component
{
    #[Locked]
    public User $user;

    public $title = 'Show User';

    public $text_subtitle = 'This page displays details of user data.';

    public function render()
    {
        return view('livewire.manage-access.user-show');
    }
}
