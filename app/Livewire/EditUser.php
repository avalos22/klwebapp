<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\User;// Importa el modelo User

class EditUser extends Component
{
    public $open = false;

    public $showModal = false;
    public $userId;
    public $user = ['name' => '', 'email' => ''];

    protected $listeners = ['editUser' => 'loadUser'];

    public function loadUser($userId)
    {
        $this->userId = $userId;
        $user = User::find($userId);
        $this->user = ['name' => $user->name, 'email' => $user->email];
        $this->showModal = true;
    }

    public function save()
    {
        $user = User::find($this->userId);
        $user->update($this->user);
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.edit-user');
    }
}