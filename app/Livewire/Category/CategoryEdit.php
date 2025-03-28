<?php

namespace App\Livewire\Category;

use App\Models\CategoryBedroom;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Update Category')]
class CategoryEdit extends Component
{
    public $deskripsi = 'Ini deskripsi dari update category';
    public $title = 'update category';

    #[Validate('required', message: 'Nama kategori harus di isi yaa')]
    public $category_name;

    #[Validate('required', message: 'Harga harus di isi yaa')]
    public $price;

    public $category;
    public function mount($id)
    {
        $this->category = CategoryBedroom::find($id);
        $this->category_name = $this->category->category_name;
        $this->price = $this->category->price;
    }

    public function update()
    {
        $this->validate();
        $this->category->update([
            'category_name' => $this->category_name,
            'price' => $this->price,
        ]);
        return $this->redirect('/category', navigate: true);
    }

    public function render()
    {
        return view('livewire.category.category-edit');
    }
}
