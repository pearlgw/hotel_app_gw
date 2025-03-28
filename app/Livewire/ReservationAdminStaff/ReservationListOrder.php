<?php

namespace App\Livewire\ReservationAdminStaff;

use App\Models\Bedroom;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Reservation Order')]
class ReservationListOrder extends Component
{
    public $deskripsi = 'Ini deskripsi dari Reservation Order';
    public $title = 'Reservation Order';

    public function render()
    {
        return view('livewire.reservation-admin-staff.reservation-list-order', [
            'reservations' => Reservation::latest()->get()
        ]);
    }

    public function finishReservation($reservationId)
    {
        $reservation = Reservation::with('detail_reservation')->findOrFail($reservationId);

        foreach ($reservation->detail_reservation as $detail) {
            Bedroom::where('id', $detail->bedrooms_id)
                ->update(['is_available' => false]);
        }

        $reservation->status = 'done';
        $reservation->save();

        session()->flash('success', 'Reservasi ditandai selesai dan kamar menjadi tersedia');
        return $this->redirect('/reservation-order', navigate: true);
    }

    public function confirmOrder($id)
    {
        $reservation = Reservation::find($id);
        $reservation->update([
            'user_id' => Auth::id()
        ]);

        return $this->redirect('/reservation-order', navigate: true);
    }
}
