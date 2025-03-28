<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Create User Order')]
class AdminCreateUserOrder extends Component
{
    public $deskripsi = 'Ini deskripsi dari Admin Create User Order';
    public $title = 'Manage User Order';

    public $name, $no_phone, $address;

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'no_phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);

        // Prefix otomatis
        $prefix = 'ORD';

        $lastUser = User::withTrashed()
            ->where('code_user', 'like', "$prefix%")
            ->orderBy('code_user', 'desc')
            ->first();

        $lastNumber = 0;
        if ($lastUser && preg_match('/\d+$/', $lastUser->code_user, $matches)) {
            $lastNumber = (int) $matches[0];
        }

        $codeUser = $prefix . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        User::create([
            'code_user' => $codeUser,
            'name' => $this->name,
            'no_phone' => '+62 ' . $this->no_phone,
            'address' => $this->address,
        ]);

        return $this->redirect('/create-user-order', navigate: true);
    }

    public function render()
    {
        return view('livewire.user.admin-create-user-order');
    }
}
