<?php

namespace App\Livewire\Payment;

use App\Models\Reservation;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Show Detail Payment')]
class ShowDetailReservation extends Component
{
    public $deskripsi = 'Ini deskripsi dari Show Detail Payment';
    public $title = 'Show Detail Payment';

    public $reservation;
    public $code_reservation;
    public $total_price;
    public $status;
    public $created_at;

    // public $detailReservations = [];

    public function mount($id)
    {
        $this->reservation = Reservation::with('detail_reservation.bedroom.category_bedroom')->findOrFail($id);

        $this->code_reservation = $this->reservation->code_reservation;
        $this->total_price = $this->reservation->total_price;
        $this->status = $this->reservation->status;
        $this->created_at = $this->reservation->created_at;
        // $this->detailReservations = $this->reservation->detail_reservation;
    }

    public function render()
    {
        return view('livewire.payment.show-detail-reservation');
    }
}
