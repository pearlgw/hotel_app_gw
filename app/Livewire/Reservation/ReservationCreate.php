<?php

namespace App\Livewire\Reservation;

use App\Models\Bedroom;
use App\Models\DetailReservation;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Title('Create Reservation')]
class ReservationCreate extends Component
{
    public $deskripsi = 'Ini deskripsi dari create reservation';
    public $title = 'Create reservation';
    public $details = [];

    public function mount()
    {
        // Initialize one detail for the form
        $this->details[] = ['bedrooms_id' => '', 'check_in' => '', 'duration' => ''];
    }

    public function addDetail()
    {
        // Menambahkan satu detail reservasi baru
        $this->details[] = ['bedrooms_id' => '', 'check_in' => '', 'duration' => ''];
    }

    public function removeDetail($index)
    {
        unset($this->details[$index]);
        $this->details = array_values($this->details); // Reindex array
    }

    public $totalAllPrice = 0;

    public function render()
    {
        $reservations = Reservation::where('user_id', Auth::id())
            ->with(['detail_reservation.bedroom.category_bedroom'])
            ->latest()
            ->get();

        // Hitung total semua total_price_per_room
        $this->totalAllPrice = $reservations->flatMap->detail_reservation
            ->sum('total_price_per_room');

        return view('livewire.reservation.reservation-create', [
            'bedrooms' => Bedroom::latest()->get(),
            'reservations' => $reservations,
        ]);
    }

    public function save()
    {
        // Cek apakah ada reservasi existing yang belum dibayar dan masih aktif
        $reservasi = Reservation::where('user_id', Auth::id())
            ->where('status', 'unpaid')
            ->whereHas('detail_reservation', function ($query) {
                $query->where('status_reservasi', false);
            })
            ->latest()
            ->first();

        // Jika tidak ada, buat baru
        if (!$reservasi) {
            $reservasi = Reservation::create([
                'user_id' => Auth::id(),
                'status' => 'unpaid',
            ]);
        }

        // Simpan setiap detail ke reservasi yang sudah dicek/baru
        foreach ($this->details as $detail) {
            $bedroom = Bedroom::with('category_bedroom')->findOrFail($detail['bedrooms_id']);
            $pricePerDay = $bedroom->category_bedroom->price;

            $duration = (int) $detail['duration'];
            $totalPrice = $pricePerDay * $duration;

            $checkIn = \Carbon\Carbon::parse($detail['check_in']);
            $checkout = $checkIn->copy()->addDays($duration);

            DetailReservation::create([
                'reservations_id' => $reservasi->id,
                'bedrooms_id' => $detail['bedrooms_id'],
                'check_in' => $checkIn,
                'duration' => $duration,
                'check_out' => $checkout,
                'total_price_per_room' => $totalPrice,
                'status_reservasi' => false,
            ]);
        }

        // Reset form
        $this->details = [['bedrooms_id' => '', 'check_in' => '', 'duration' => '']];
    }

    public function delete($id)
    {
        $detailReservation = DetailReservation::find($id);
        $detailReservation->delete();
        return $this->redirect('/reservation', navigate: true);
    }

    public function fix($id)
    {
        $detailReservation = DetailReservation::find($id);
        $detailReservation->update([
            'status_reservasi' => true
        ]);
        return $this->redirect('/reservation', navigate: true);
    }
}
