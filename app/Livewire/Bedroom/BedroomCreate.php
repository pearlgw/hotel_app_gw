<?php

namespace App\Livewire\Bedroom;

use App\Models\Bedroom;
use App\Models\CategoryBedroom;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Create Bedroom')]
class BedroomCreate extends Component
{
    use WithFileUploads;

    public $deskripsi = 'Ini deskripsi dari create bedroom';
    public $title = 'Create bedroom';

    public $code_bedroom;

    #[Validate('required', message: 'kategori bedroom harus di isi yaa')]
    public $category_bedrooms_id;

    #[Validate('required|image', message: 'Gambar harus di isi yaa')]
    public $main_image_url;

    #[Validate('required', message: 'Title bedroom harus di isi yaa')]
    public $title_bedroom;

    #[Validate('required', message: 'Deskripsi harus di isi yaa')]
    public $description;

    public $image_url = [];

    public $wifi;
    public $elektronik;
    public $swimming_pool;
    public $gym;

    public function render()
    {
        return view('livewire.bedroom.bedroom-create', [
            'categories' => CategoryBedroom::latest()->get(),
        ]);
    }

    public function addImage()
    {
        $this->image_url[] = '';
    }

    public function removeImage($index)
    {
        unset($this->image_url[$index]);
        $this->image_url = array_values($this->image_url); // Reset index array
    }

    public function save()
    {
        $this->validate();

        // Ambil angka terbesar dari kode yang sudah ada (walaupun tidak urut)
        $lastNumber = Bedroom::withTrashed()
            ->selectRaw("MAX(CAST(SUBSTRING(code_bedroom, 6) AS UNSIGNED)) as max_code")
            ->value('max_code');

        $newNumber = str_pad(($lastNumber ?? 0) + 1, 3, '0', STR_PAD_LEFT); // Tetap lanjut, default 001
        $this->code_bedroom = 'RBDRM' . $newNumber;

        $path = $this->main_image_url->store('bedrooms', 's3');
        $url = Storage::disk('s3')->url($path);
        // Simpan ke database
        $bedroom = Bedroom::create([
            'code_bedroom' => $this->code_bedroom,
            'category_bedrooms_id' => $this->category_bedrooms_id,
            'main_image_url' => $url,
            'is_available' => 0,
            'title_bedroom' => $this->title_bedroom,
            'description' => $this->description,
        ]);

        // Simpan semua gambar tambahan
        foreach ($this->image_url as $image) {
            if ($image) {
                // Upload ke MinIO
                $path = $image->store('bedrooms', 's3');
                $imageUrl = Storage::disk('s3')->url($path);

                // Simpan ke tabel relasi
                $bedroom->image_bedroom()->create([
                    'image_url' => $imageUrl,
                ]);
            }
        }

        $bedroom->facility()->create([
            'wifi' => $this->wifi,
            'elektronik' => $this->elektronik,
            'swimming_pool' => $this->swimming_pool,
            'gym' => $this->gym,
        ]);

        // session()->flash('success', 'User berhasil dibuat!');
        return $this->redirect('/bedroom', navigate: true);
    }
}
