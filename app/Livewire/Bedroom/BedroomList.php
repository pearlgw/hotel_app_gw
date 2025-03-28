<?php

namespace App\Livewire\Bedroom;

use App\Models\Bedroom;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Manage Bedroom')]
class BedroomList extends Component
{
    public $deskripsi = 'Ini deskripsi dari bedroom';
    public $title = 'Manage bedroom';

    public function render()
    {
        return view('livewire.bedroom.bedroom-list',[
            "bedrooms" => Bedroom::latest()->get(),
            "title" => $this->title,
            "deskripsi" => $this->deskripsi,
        ]);
    }

    public function delete($id)
    {
        $user = Bedroom::find($id);
        $user->delete();
        return $this->redirect('/bedroom', navigate: true);
    }
}
