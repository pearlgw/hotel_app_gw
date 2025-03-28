<?php

namespace App\Livewire\Category;

use App\Models\CategoryBedroom;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Create Category')]
class CategoryCreate extends Component
{
    public $deskripsi = 'Ini deskripsi dari create category';
    public $title = 'Create category';

    public $code_category_bedroom;

    #[Validate('required', message: 'Nama kategori harus di isi yaa')]
    public $category_name;

    #[Validate('required', message: 'Harga harus di isi yaa')]
    public $price;

    public function render()
    {
        return view('livewire.category.category-create');
    }

    public function save()
    {
        $this->validate();

        // Ambil angka terbesar dari kode yang sudah ada (walaupun tidak urut)
        $lastNumber = CategoryBedroom::withTrashed() // Ini kuncinya
            ->selectRaw("MAX(CAST(SUBSTRING(code_category_bedroom, 5) AS UNSIGNED)) as max_code")
            ->value('max_code');


        $newNumber = str_pad(($lastNumber ?? 0) + 1, 3, '0', STR_PAD_LEFT); // Tetap lanjut, default 001
        $this->code_category_bedroom = 'BDRM' . $newNumber;

        // Simpan ke database
        CategoryBedroom::create([
            'code_category_bedroom' => $this->code_category_bedroom,
            'category_name' => $this->category_name,
            'price' => $this->price,
        ]);
        // session()->flash('success', 'User berhasil dibuat!');
        return $this->redirect('/category', navigate: true);
    }
}
