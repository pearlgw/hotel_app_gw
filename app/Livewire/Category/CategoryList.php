<?php

namespace App\Livewire\Category;

use App\Models\CategoryBedroom;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Manage Category')]
class CategoryList extends Component
{
    public $deskripsi = 'Ini deskripsi dari category';
    public $title = 'Manage category';

    public function render()
    {
        return view('livewire.category.category-list', [
            "categories" => CategoryBedroom::latest()->get(),
            "title" => $this->title,
            "deskripsi" => $this->deskripsi,
        ]);
    }

    public function delete($id)
    {
        $user = CategoryBedroom::find($id);
        $user->delete();
        return $this->redirect('/category', navigate: true);
    }
}
