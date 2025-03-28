<?php

namespace App\Livewire\Payment;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;
use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Transaction;

#[Title('Detail Payment')]
class PaymentDetailReservation extends Component
{
    public $deskripsi = 'Ini deskripsi dari Detail Payment';
    public $title = 'Detail Payment';

    public function render()
    {
        return view('livewire.payment.payment-detail-reservation', [
            'reservations' => Reservation::where('order_id', Auth::id())->latest()->get()
        ]);
    }
}
