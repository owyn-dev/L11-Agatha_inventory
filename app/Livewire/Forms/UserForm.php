<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user = null;

    public $full_name = '';

    public $username = '';

    public $role = '';

    public $password = '';

    public $password_confirmation = '';

    public function setUser(User $user): void
    {
        $this->user = $user;

        $this->full_name = $user->full_name;
        $this->username = $user->username;
        $this->role = $user->getRoleNames()->first();

        if (! $this->isAdmin()) {
            $this->role = $user->getRoleNames()->first();
        }
    }

    public function store()
    {
        $this->validate();

        $user = User::create([
            'full_name' => $this->full_name,
            'username' => $this->username,
            'password' => $this->password,
        ]);

        if ($this->isAdmin()) {
            $user->assignRole($this->role);
        }

        $this->resetForm();
    }

    public function update()
    {
        $this->validate();

        $dataToUpdate = [
            'full_name' => $this->full_name,
            'username' => $this->username,
        ];

        if (! empty($this->password)) {
            $dataToUpdate['password'] = $this->password;
        }

        $this->user->update($dataToUpdate);

        if ($this->isAdmin()) {
            $this->user->syncRoles([$this->role]);
        }

        $this->resetValidation();
    }

    public function destroy($id): bool
    {
        return User::destroy($id) > 0;
    }

    private function isAdmin(): bool
    {
        return request()->user()?->hasRole('Administrator');
    }

    public function rules(): array
    {
        $uniqueUsername = $this->user && $this->user->exists
            ? 'unique:users,username,'.$this->user->id
            : 'unique:users,username';

        $rules = [
            'full_name' => 'required|string|max:255',
            'username' => 'required|string|max:255|'.$uniqueUsername,
            'password' => $this->user && $this->user->exists
                ? 'nullable|string|min:6|confirmed'
                : 'required|string|min:6|confirmed',
        ];

        if ($this->isAdmin()) {
            $rules['role'] = 'required|string';
        }

        return $rules;
    }
}
