<?php

namespace App\Livewire\Bedroom;

use App\Models\Bedroom;
use Livewire\Attributes\Validate;
use Livewire\Component;

class BedroomShow extends Component
{
    public $deskripsi = 'Ini deskripsi dari show bedroom';
    public $title = 'show bedroom';

    public $bedroom;
    public $code_bedroom;
    public $category_bedrooms_id;
    public $main_image_url;
    public $title_bedroom;
    public $description;
    public $is_available;

    public $image_url = [];

    public $wifi;
    public $elektronik;
    public $swimming_pool;
    public $gym;

    public function mount($id)
    {
        $this->bedroom = Bedroom::find($id);
        $this->code_bedroom = $this->bedroom->code_bedroom;
        $this->category_bedrooms_id = $this->bedroom->category_bedroom->category_name;
        $this->main_image_url = $this->bedroom->main_image_url;
        $this->title_bedroom = $this->bedroom->title_bedroom;
        $this->description = $this->bedroom->description;
        $this->is_available = $this->bedroom->is_available;

        $this->image_url = $this->bedroom->image_bedroom->pluck('image_url')->toArray();

        $this->wifi = $this->bedroom->facility->wifi ?? 0;
        $this->elektronik = $this->bedroom->facility->elektronik ?? 0;
        $this->swimming_pool = $this->bedroom->facility->swimming_pool ?? 0;
        $this->gym = $this->bedroom->facility->gym ?? 0;
    }

    public function render()
    {
        return view('livewire.bedroom.bedroom-show');
    }
}
