<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Manage User')]

class UserList extends Component
{
    public $deskripsi = 'Ini deskripsi dari user';
    public $title = 'Manage User';

    public function render()
    {
        return view('livewire.users.user-list', [
            "users" => User::latest()->get(),
            "title" => $this->title,
            "deskripsi" => $this->deskripsi,
        ]);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return $this->redirect('/user', navigate: true);
    }
}
