<?php

namespace App\Livewire\ManageAccess;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Show User')]
class UserShow extends Component {

    public $title = "Show User";
    public $text_subtitle = "This page displays details of user data.";

    public function render() {
        return view('livewire.manage-access.user-show');
    }
}
