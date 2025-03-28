<?php

namespace App\Livewire\Transaction;

use App\Models\Bedroom;
use App\Models\Transaction;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Manage Transaction')]
class TransactionList extends Component
{
    public $deskripsi = 'Ini deskripsi dari transaction';
    public $title = 'Manage transaction';

    public function render()
    {
        return view('livewire.transaction.transaction-list',[
            'transactions' => Transaction::latest()->get()
        ]);
    }

    public function finishTransaction($transactionId)
    {
        $transaction = Transaction::with('detail_transaction')->findOrFail($transactionId);

        foreach ($transaction->detail_transaction as $detail) {
            Bedroom::where('id', $detail->bedrooms_id)
                ->update(['is_available' => false]);
        }

        $transaction->status = 'done';
        $transaction->save();

        session()->flash('success', 'Transaksi ditandai selesai dan kamar menjadi tersedia');
        return $this->redirect('/transaction', navigate: true);
    }
}
