<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Show Transaction')]
class TransactionShow extends Component
{
    public $deskripsi = 'Ini deskripsi dari Show Transaction';
    public $title = 'Show Transaction';

    public $transaction;
    public $code_transaction;
    public $total_price;
    public $pay_money;
    public $refund_money;
    public $created_at;

    // public $detailReservations = [];

    public function mount($id)
    {
        $this->transaction = Transaction::with('detail_transaction.bedroom.category_bedroom')->with(['user', 'order'])->findOrFail($id);

        $this->code_transaction = $this->transaction->code_transaction;
        $this->total_price = $this->transaction->total_price;
        $this->pay_money = $this->transaction->pay_money;
        $this->refund_money = $this->transaction->refund_money;
        $this->created_at = $this->transaction->created_at;
    }

    public function render()
    {
        return view('livewire.transaction.transaction-show');
    }
}
