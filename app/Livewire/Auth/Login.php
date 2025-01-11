<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('livewire.layouts.app-auth')]
class Login extends Component
{
    public function render()
    {
        return view('livewire.auth.login');
    }
}
