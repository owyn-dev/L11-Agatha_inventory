<?php

namespace App\Livewire\ManageAccess;

use App\Livewire\Forms\UserForm;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Role;

#[Title('Create User')]
class UserCreate extends Component
{
    public $title = 'Create User';

    public $text_subtitle = 'This page displays for create data user.';

    public UserForm $form;

    #[Computed]
    public function roles()
    {
        return Role::pluck('name');
    }

    public function save()
    {
        $this->form->store();

        flash()->success('Data Saved Successfully.');
    }

    public function render()
    {
        return view('livewire.manage-access.user-create');
    }
}
