<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Update User')]
class UserEdit extends Component
{
    public $deskripsi = 'Ini deskripsi dari update user';
    public $title = 'update User';

    #[Validate('required', message: 'Nama harus di isi yaa')]
    public $name;

    #[Validate('required', message: 'Email harus di isi yaa')]
    public $email;

    #[Validate('required', message: 'Password harus di isi yaa')]
    public $password;

    #[Validate('required', message: 'No Phone harus di isi yaa')]
    public $no_phone;

    #[Validate('required', message: 'Address harus di isi yaa')]
    public $address;

    public $user;
    public function mount($id)
    {
        $this->user = User::find($id);
        $this->name = $this->user->name;
        $this->email = str_replace('@gmail.com', '', $this->user->email);
        $this->password = $this->user->password;
        $this->no_phone = str_replace('+62', '', $this->user->no_phone);
        $this->address = $this->user->address;
    }

    public function update()
    {
        $this->validate();
        $this->user->update([
            'name' => $this->name,
            'email' => $this->email . '@gmail.com',
            'password' => $this->password ? Hash::make($this->password) : $this->user->password,
            'no_phone' => '+62 ' . $this->no_phone,
            'address' => $this->address,
        ]);
        return $this->redirect('/user', navigate: true);
    }

    public function render()
    {
        return view('livewire.users.user-edit');
    }
}
