<?php

namespace App\Livewire\Transaction;

use App\Models\Bedroom;
use App\Models\DetailReservation;
use App\Models\DetailTransaction;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Manage Transaction')]
class TransactionCreate extends Component
{
    public $deskripsi = 'Ini deskripsi dari create transaction';
    public $title = 'Manage create transaction';

    public $order_id;
    public $orders;
    public $bedrooms;
    public $total_price = 0;
    public $uang_pembayaran;
    public $uang_kembalian = 0;

    public $detail_transactions = [];

    public function mount()
    {
        $this->orders = User::where(function ($query) {
            $query->whereNull('email')
                  ->orWhereHas('roles', function ($q) {
                      $q->where('name', 'order');
                  });
        })->latest()->get();
        $this->bedrooms = Bedroom::with('category_bedroom')->where('is_available', false)->get();

        $this->addTransaction(); // tambahkan 1 row default
    }

    public function addTransaction()
    {
        $this->detail_transactions[] = [
            'bedrooms_id' => '',
            'check_in' => '',
            'duration' => '',
            'check_out' => '',
            'total_price_per_room' => '',
        ];
    }

    public function removeDetail($index)
    {
        unset($this->detail_transactions[$index]);
        $this->detail_transactions = array_values($this->detail_transactions); // reset index
        $this->calculateTotalPriceAll(); // update total setelah hapus
    }

    public function updated($property)
    {
        // Deteksi jika properti yang berubah adalah bagian dari detail_transactions
        if (preg_match('/detail_transactions\.(\d+)\.(bedrooms_id|check_in|duration)/', $property, $matches)) {
            $index = $matches[1];

            $this->calculateCheckOut($index);
            $this->calculateTotalPrice($index);
            $this->calculateTotalPriceAll();
        }

        if ($property === 'uang_pembayaran') {
            $this->calculateKembalian();
        }
    }

    public function calculateCheckOut($index)
    {
        $check_in = $this->detail_transactions[$index]['check_in'] ?? null;
        $duration = $this->detail_transactions[$index]['duration'] ?? null;

        if ($check_in && $duration) {
            $this->detail_transactions[$index]['check_out'] = Carbon::parse($check_in)
                ->addDays((int) $duration)
                ->format('Y-m-d\TH:i');
        }
    }

    public function calculateTotalPrice($index)
    {
        $bedroom_id = $this->detail_transactions[$index]['bedrooms_id'] ?? null;
        $duration = $this->detail_transactions[$index]['duration'] ?? null;

        if ($bedroom_id && $duration) {
            $bedroom = $this->bedrooms->firstWhere('id', $bedroom_id);
            $price = $bedroom->category_bedroom->price ?? 0;
            $this->detail_transactions[$index]['total_price_per_room'] = $price * $duration;
        }
    }

    public function calculateTotalPriceAll()
    {
        $this->total_price = collect($this->detail_transactions)
            ->sum(function ($item) {
                return (int) $item['total_price_per_room'];
            });
    }

    public function calculateKembalian()
    {
        $this->uang_kembalian = max(0, (int)$this->uang_pembayaran - (int)$this->total_price);
    }

    public function save()
    {
        $this->validate([
            'order_id' => 'required|exists:users,id',
            'uang_pembayaran' => 'required|numeric',
            'detail_transactions' => 'required|array|min:1',
            'detail_transactions.*.bedrooms_id' => 'required|exists:bedrooms,id',
            'detail_transactions.*.check_in' => 'required|date',
            'detail_transactions.*.duration' => 'required|integer|min:1',
        ]);

        $now = now();

        $datePrefix = 'TRS-' . $now->format('dmY'); // hanya tanggal
        $latest = Transaction::where('code_transaction', 'like', $datePrefix . '%')->count() + 1;

        $codeTransaction = 'TRS-' . $now->format('dmYHis') . '-' . str_pad($latest, 3, '0', STR_PAD_LEFT);

        $transaction = Transaction::create([
            'status' => "paid",
            'code_transaction' => $codeTransaction,
            'user_id' => Auth::id(),
            'order_id' => $this->order_id,
            'total_price' => $this->total_price,
            'pay_money' => $this->uang_pembayaran,
            'refund_money' => $this->uang_kembalian,
        ]);

        // Simpan detail transaksi
        foreach ($this->detail_transactions as $detail) {
            DetailTransaction::create([
                'transactions_id' => $transaction->id,
                'bedrooms_id' => $detail['bedrooms_id'],
                'check_in' => $detail['check_in'],
                'check_out' => $detail['check_out'],
                'duration' => $detail['duration'],
                'total_price_per_room' => $detail['total_price_per_room'],
            ]);

            Bedroom::where('id', $detail['bedrooms_id'])->update(['is_available' => true]);
        }

        session()->flash('success', 'Transaksi berhasil disimpan.');
        return $this->redirect('/transaction', navigate: true);
    }

    public function render()
    {
        return view('livewire.transaction.transaction-create', [
            'orders' => $this->orders,
            'bedrooms' => $this->bedrooms,
        ]);
    }
}
