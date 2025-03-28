<?php

namespace App\Http\Controllers;

use App\Models\Bedroom;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Transaction;

class HandleMidtransController extends Controller
{
    public function paymentFinish($id)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $reservation = Reservation::findOrFail($id);

        // Cek status dari Midtrans
        $status = Transaction::status($reservation->code_reservation);

        if ($status->transaction_status === 'settlement') {
            $reservation->status = 'paid';
            $reservation->save();

            // Update status kamar
            foreach ($reservation->detail_reservation as $detail) {
                Bedroom::where('id', $detail->bedrooms_id)
                    ->update(['is_available' => true]);
            }
        }

        // Redirect ke halaman detail atau apapun
        return redirect()->to('/detail-payment')->with('success', 'Pembayaran berhasil!');
    }
}
