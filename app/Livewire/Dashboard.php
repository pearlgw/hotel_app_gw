<?php

namespace App\Livewire;

use App\Models\Bedroom;
use App\Models\CategoryBedroom;
use App\Models\Reservation;
use App\Models\Transaction;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', [
            'total_user' => User::all()->count(),
            'total_reservation' => Reservation::all()->count(),
            'total_transaction' => Transaction::all()->count(),
            'total_bedroom' => Bedroom::all()->count(),
            'total_category' => CategoryBedroom::all()->count(),
        ]);
    }
}
