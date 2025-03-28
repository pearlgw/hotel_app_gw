<?php

namespace App\Livewire\Bedroom;

use App\Models\Bedroom;
use App\Models\CategoryBedroom;
use App\Models\ImageBedroom;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Edit Bedroom')]
class BedroomEdit extends Component
{
    use WithFileUploads;

    public $deskripsi = 'Ini deskripsi dari create bedroom';
    public $title = 'Create bedroom';

    public $bedroomId;

    public $category_bedrooms_id;
    public $main_image_url;
    public $oldmain_image_url;

    public $title_bedroom;
    public $description;

    public $image_url = []; // untuk gambar tambahan baru
    public $old_images = []; // untuk menampilkan gambar tambahan lama

    public $wifi;
    public $elektronik;
    public $swimming_pool;
    public $gym;

    public function mount($id)
    {
        $bedroom = Bedroom::with(['facility', 'image_bedroom'])->findOrFail($id);

        $this->bedroomId = $bedroom->id;
        $this->category_bedrooms_id = $bedroom->category_bedrooms_id;
        $this->oldmain_image_url = $bedroom->main_image_url;
        $this->title_bedroom = $bedroom->title_bedroom;
        $this->description = $bedroom->description;

        $this->old_images = $bedroom->image_bedroom->toArray();

        $this->wifi = $bedroom->facility->wifi ?? null;
        $this->elektronik = $bedroom->facility->elektronik ?? null;
        $this->swimming_pool = $bedroom->facility->swimming_pool ?? null;
        $this->gym = $bedroom->facility->gym ?? null;
    }

    public function render()
    {
        return view('livewire.bedroom.bedroom-edit', [
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

    public function deleteOldImage($id)
    {
        $image = ImageBedroom::find($id);
        if ($image) {
            // Hapus file dari MinIO jika perlu
            $filePath = str_replace(config('filesystems.disks.s3.url') . '/', '', $image->image_url);
            Storage::disk('s3')->delete($filePath);

            $image->delete();
            $this->old_images = array_filter($this->old_images, fn ($img) => $img['id'] != $id);
        }
    }

    public function update()
    {
        $this->validate([
            'category_bedrooms_id' => 'required',
            'title_bedroom' => 'required',
            'description' => 'required',
            'main_image_url' => 'nullable|image|max:2048',
        ]);

        $bedroom = Bedroom::findOrFail($this->bedroomId);

        // Jika ganti gambar utama
        if ($this->main_image_url && is_object($this->main_image_url)) {
            // Upload baru ke MinIO
            $path = $this->main_image_url->store('bedrooms', 's3');
            $bedroom->main_image_url = Storage::disk('s3')->url($path);
        }

        $bedroom->update([
            'category_bedrooms_id' => $this->category_bedrooms_id,
            'title_bedroom' => $this->title_bedroom,
            'description' => $this->description,
        ]);

        // Update atau buat fasilitas
        $bedroom->facility()->updateOrCreate([], [
            'wifi' => $this->wifi,
            'elektronik' => $this->elektronik,
            'swimming_pool' => $this->swimming_pool,
            'gym' => $this->gym,
        ]);

        // Upload gambar tambahan baru
        foreach ($this->image_url as $img) {
            if ($img) {
                $path = $img->store('bedrooms', 's3');
                $imageUrl = Storage::disk('s3')->url($path);

                $bedroom->image_bedroom()->create([
                    'image_url' => $imageUrl,
                ]);
            }
        }

        return $this->redirect('/bedroom', navigate: true);
    }
}
