<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('livewire.layouts.app-auth')]
class Login extends Component
{
    public $username = '';

    public $password = '';

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['username' => $this->username, 'password' => $this->password])) {

            Session::regenerate();

            flash()->success('Welcome '.$this->username);

            return $this->redirect(route('dashboard'), navigate: true);
        } else {
            flash()->error('Login failed. Please check your credentials and try again.');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }

    protected $rules = [
        'username' => 'required',
        'password' => 'required|string|min:6',
    ];
}
