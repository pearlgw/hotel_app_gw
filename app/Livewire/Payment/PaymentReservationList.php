<?php

namespace App\Livewire\Payment;

use App\Models\DetailReservation;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Payment')]
class PaymentReservationList extends Component
{
    public $deskripsi = 'Ini deskripsi dari Payment';
    public $title = 'Payment';
    public $grandTotal = 0;

    public function render()
    {
        $detailReservations = DetailReservation::where('user_id', Auth::id())
            ->where('status_reservasi', true)->whereNull('reservations_id')
            ->latest()
            ->get();

        // Hitung total dan simpan ke properti
        $this->grandTotal = $detailReservations->sum('total_price_per_room');

        return view('livewire.payment.payment-reservation-list', [
            'detailReservations' => $detailReservations,
        ]);
    }

    public function saveReservation()
    {
        $user = Auth::user();
        $now = now();

        $datePrefix = 'RSV-' . $now->format('dmY'); // hanya tanggal
        $latest = Reservation::where('code_reservation', 'like', $datePrefix . '%')->count() + 1;

        $codeReservation = 'RSV-' . $now->format('dmYHis') . '-' . str_pad($latest, 3, '0', STR_PAD_LEFT);


        // Simpan ke tabel reservations
        $reservation = Reservation::create([
            'order_id' => $user->id,
            'code_reservation' => $codeReservation,
            'status' => 'unpaid',
            'total_price' => $this->grandTotal,
        ]);

        $details = DetailReservation::where('user_id', $user->id)
            ->where('status_reservasi', true)->whereNull('reservations_id')
            ->get();

        foreach ($details as $detail) {
            $detail->reservations_id = $reservation->id;
            $detail->save();
        }

        // Reset form dan kasih feedback
        $this->reset(['grandTotal']);
        session()->flash('success', 'Reservasi berhasil disimpan dengan kode ' . $codeReservation);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-XqHhRaIuKtZWhL-QmyGREhGn';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $reservation->code_reservation,
                'gross_amount' => $reservation->total_price,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'phone' => Auth::user()->no_phone,
            ),
            'callbacks' => [
                'finish' => url('/midtrans/payment-finish/' . $reservation->id),
            ],
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $reservation->update([
            'snap_token' => $snapToken,
        ]);

        return $this->redirect('/detail-payment', navigate: true);
    }
}
