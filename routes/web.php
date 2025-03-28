<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HandleMidtransController;
use App\Http\Controllers\ProfileController;
use App\Livewire\Bedroom\BedroomCreate;
use App\Livewire\Bedroom\BedroomEdit;
use App\Livewire\Bedroom\BedroomList;
use App\Livewire\Bedroom\BedroomShow;
use App\Livewire\BedroomOrder\BedroomAvailable;
use App\Livewire\Category\CategoryCreate;
use App\Livewire\Category\CategoryEdit;
use App\Livewire\Category\CategoryList;
use App\Livewire\Dashboard;
use App\Livewire\Payment\PaymentDetailReservation;
use App\Livewire\Payment\PaymentReservationList;
use App\Livewire\Payment\ShowDetailReservation;
use App\Livewire\Reservation\ReservationCreate;
use App\Livewire\Reservation\ReservationList;
use App\Livewire\ReservationAdminStaff\ReservationListOrder;
use App\Livewire\ReservationAdminStaff\ReservationShowOrder;
use App\Livewire\Transaction\TransactionCreate;
use App\Livewire\Transaction\TransactionList;
use App\Livewire\Transaction\TransactionShow;
use App\Livewire\User\AdminCreateUserOrder;
use App\Livewire\Users\UserCreate;
use App\Livewire\Users\UserEdit;
use App\Livewire\Users\UserList;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    // Route::get('/reservation/create', ReservationCreate::class);

    Route::middleware('can:make confirmation')->group(function () {
        Route::get('/reservation-order', ReservationListOrder::class);
        Route::get('/reservation-order/{id}/show', ReservationShowOrder::class);
    });

    Route::middleware('can:cashier')->group(function () {
        Route::get('/transaction', TransactionList::class);
        Route::get('/transaction/create', TransactionCreate::class);
        Route::get('/transaction/{id}/show', TransactionShow::class);
    });

    Route::middleware('can:manage users')->group(function () {
        Route::get('/user', UserList::class);
        Route::get('/user/create', UserCreate::class);
        Route::get('/user/{id}/edit', UserEdit::class);
    });

    Route::middleware('can:manage category')->group(function () {
        Route::get('/category', CategoryList::class);
        Route::get('/category/create', CategoryCreate::class);
        Route::get('/category/{id}/edit', CategoryEdit::class);
    });

    Route::middleware('can:manage bedrooms')->group(function () {
        Route::get('/bedroom', BedroomList::class);
        Route::get('/bedroom/create', BedroomCreate::class);
        Route::get('/bedroom/{id}/edit', BedroomEdit::class);
        Route::get('/bedroom/{id}', BedroomShow::class);
    });

    Route::middleware('can:make user order')->group(function () {
        Route::get('/create-user-order', AdminCreateUserOrder::class);
    });

    Route::middleware('can:view bedrooms')->group(function () {
        Route::get('/bedrooms', BedroomAvailable::class);
    });

    Route::middleware('can:make reservation')->group(function () {
        Route::get('/reservation/select', ReservationList::class);
        Route::get('/payment', PaymentReservationList::class);
        Route::get('/detail-payment/{id}/show', ShowDetailReservation::class);
        Route::get('/midtrans/payment-finish/{id}', [HandleMidtransController::class, 'paymentFinish']);
    });

    Route::middleware('can:make reservation')->group(function () {
        Route::get('/detail-payment', PaymentDetailReservation::class);
    });
});

require __DIR__ . '/auth.php';
