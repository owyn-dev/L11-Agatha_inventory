<?php

namespace App\Livewire\ManageAccess;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Role;

#[Title('Update User')]
class UserUpdate extends Component
{
    public $title = 'Update User';

    public $text_subtitle = 'This page displays the profile of user data.';

    public UserForm $form;

    public User $user;

    #[Computed]
    public function roles()
    {
        return Role::pluck('name');
    }

    public function edit()
    {
        $this->form->update();

        flash()->success('Data Changed Successfully.');
    }

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->form->setUser($user);
    }

    public function render()
    {
        return view('livewire.manage-access.user-update');
    }
}
