<?php

namespace App\Livewire\ManageAccess;

use App\Livewire\Forms\UserForm;
use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Update Profile')]
class UserProfileUpdate extends Component
{
    public $title = 'Update Profile';

    public $text_subtitle = 'This page displays the profile of user data.';

    public UserForm $form;

    public User $user;

    public function edit()
    {
        $this->form->update();

        $this->user = $this->user->fresh();
        flash()->success('Data Changed Successfully.');
    }

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->form->setUser($user);
    }

    public function render()
    {
        return view('livewire.manage-access.user-profile-update');
    }
}
