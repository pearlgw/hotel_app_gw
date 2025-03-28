<?php

namespace App\Livewire\Reservation;

use App\Models\Bedroom;
use App\Models\DetailReservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Bedroom')]
class ReservationList extends Component
{
    public $deskripsi = 'Ini deskripsi dari Bedroom';
    public $title = 'Bedroom';

    public $check_out = [];
    public $total_price_per_room = [];
    public $check_in = [];
    public $duration = [];

    public function updated($property, $value)
    {
        // Ambil ID dari properti array, contoh: check_in.5 => 5
        $matches = [];
        if (preg_match('/^(check_in|duration)\.(\d+)$/', $property, $matches)) {
            $field = $matches[1];
            $id = $matches[2];

            // Cek kalau dua-duanya sudah terisi
            if (!empty($this->check_in[$id]) && !empty($this->duration[$id])) {
                $this->calculateCheckout($id);
                $this->calculateTotalPrice($id);
            }
        }
    }

    public function calculateCheckout($id)
    {
        if (isset($this->check_in[$id]) && isset($this->duration[$id])) {
            $this->check_out[$id] = Carbon::parse($this->check_in[$id])
                ->addDays((int) $this->duration[$id])
                ->format('Y-m-d\TH:i');
        }
    }

    public function calculateTotalPrice($id)
    {
        $detail = DetailReservation::with('bedroom.category_bedroom')->find($id);

        if ($detail && isset($this->duration[$id])) {
            $price = $detail->bedroom->category_bedroom->price ?? 0;
            $this->total_price_per_room[$id] = $price * $this->duration[$id];
        }
    }

    public function getGrandTotalProperty()
    {
        return array_sum($this->total_price_per_room);
    }

    public function render()
    {
        return view('livewire.reservation.reservation-list', [
            'detailReservations' => DetailReservation::where('status_reservasi', false)->where('user_id', Auth::id())->latest()->get(),
            'grandTotal' => $this->grandTotal,
        ]);
    }

    public function saveRoom($id)
    {
        $detailReservation = DetailReservation::find($id);

        if ($detailReservation) {
            $detailReservation->update([
                'check_in' => $this->check_in[$id] ?? null,
                'check_out' => $this->check_out[$id] ?? null,
                'duration' => $this->duration[$id] ?? null,
                'total_price_per_room' => $this->total_price_per_room[$id] ?? null,
                'status_reservasi' => true,
            ]);

            session()->flash('success', 'Reservasi berhasil disimpan!');
        }
    }

    public function deleteRoom($id)
    {
        $detailReservation = DetailReservation::find($id);
        $detailReservation->delete();
        return $this->redirect('/reservation/select', navigate: true);
    }
}
