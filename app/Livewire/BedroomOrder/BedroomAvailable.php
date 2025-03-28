<?php

namespace App\Livewire\BedroomOrder;

use App\Models\Bedroom;
use App\Models\DetailReservation;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Bedroom')]
class BedroomAvailable extends Component
{
    public $deskripsi = 'Ini deskripsi dari Bedroom';
    public $title = 'Bedroom';

    public function render()
    {
        return view('livewire.bedroom-order.bedroom-available', [
            'bedrooms' => Bedroom::where('is_available', false)->latest()->paginate(12)
        ]);
    }

    public function reserv($id)
    {
        // Cek apakah sudah ada reservasi untuk kamar ini yang belum dikonfirmasi
        $detailReserv = DetailReservation::where('bedrooms_id', $id)
            ->where('status_reservasi', false)
            ->where('user_id', Auth::id())
            ->first();

        if ($detailReserv) {
            // Data sudah ada, tidak boleh buat lagi
            session()->flash('error', 'Kamar ini sudah ada di daftar reservasi Anda.');
            return $this->redirect('/bedrooms', navigate: true);
        }

        DetailReservation::create([
            'user_id' => Auth::id(),
            'bedrooms_id' => $id,
            'status_reservasi' => false
        ]);

        session()->flash('success', 'Kamar berhasil ditambahkan.');
        return $this->redirect('/bedrooms', navigate: true);
    }
}
