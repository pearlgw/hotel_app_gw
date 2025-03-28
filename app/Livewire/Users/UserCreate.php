<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Create User')]
class UserCreate extends Component
{
    public $deskripsi = 'Ini deskripsi dari create user';
    public $title = 'Create User';

    #[Validate('required')]
    public $role;

    public $code_user;

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

    public function updatedRole()
    {
        if (!$this->role) {
            $this->code_user = null;
            return;
        }

        // Prefix berdasarkan role
        $prefix = match ($this->role) {
            'admin' => 'ADM',
            'staff' => 'STF',
            'order' => 'ORD',
            default => 'USR'
        };

        // Cari user terakhir dengan prefix ini
        $lastUser = User::withTrashed()
            ->where('code_user', 'like', "$prefix%")
            ->orderBy('code_user', 'desc')
            ->first();

        $lastNumber = 0;
        if ($lastUser && preg_match('/\d+$/', $lastUser->code_user, $matches)) {
            $lastNumber = (int) $matches[0];
        }

        $this->code_user = $prefix . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    }

    public function save()
    {
        $this->validate();

        $user = User::create([
            'code_user' => $this->code_user,
            'name' => $this->name,
            'email' => $this->email . '@gmail.com',
            'password' => Hash::make($this->password),
            'no_phone' => '+62 ' . $this->no_phone,
            'address' => $this->address,
        ]);

        $user->assignRole($this->role);

        // session()->flash('success', 'User berhasil dibuat!');
        return $this->redirect('/user', navigate: true);
    }

    public function render()
    {
        return view('livewire.users.user-create', [
            "title" => $this->title,
            "deskripsi" => $this->deskripsi,
        ]);
    }
}
