<div class="mt-4">
    @if (session('success'))
        <div class="alert alert-success" id="flash-message">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(function() {
                let flash = document.getElementById('flash-message');
                if (flash) {
                    flash.style.display = 'none';
                }
            }, 3000); // 5 detik
        </script>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" id="flash-message">
            {{ session('error') }}
        </div>

        <script>
            setTimeout(function() {
                let flash = document.getElementById('flash-message');
                if (flash) {
                    flash.style.display = 'none';
                }
            }, 3000); // 5 detik
        </script>
    @endif

    <div>
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
        <p>{{ $deskripsi }}</p>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-info">Data Reservasi Order</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" id="dataTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Code Reservation</th>
                            <th>Order</th>
                            <th>Staff</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $reservation)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $reservation->code_reservation }}</td>
                                <td>{{ $reservation->order->name }}</td>
                                <td>{{ $reservation->user->name ?? 'Belum di konfirmasi' }}</td>
                                <td>Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</td>
                                <td>{{ ucfirst($reservation->status) }}</td>
                                <td>
                                    <div class="row">
                                        <a wire:navigate href="/reservation-order/{{ $reservation->id }}/show"
                                            class="btn btn-primary ml-2">Show</a>
                                        @if ($reservation->user_id === null)
                                            <button wire:click='confirmOrder({{ $reservation->id }})'
                                                wire:confirm="Are you sure certain this confirm ?"
                                                class="btn btn-success ml-2">
                                                Konfirmasi
                                            </button>
                                        @else
                                            <button class="btn btn-secondary ml-2" disabled>
                                                Sudah Di Konfirmasi
                                            </button>
                                        @endif
                                        @if ($reservation->status == 'paid')
                                            <button wire:click='finishReservation({{ $reservation->id }})'
                                                class="btn btn-warning ml-2">
                                                Tandai Selesai
                                            </button>
                                        @else
                                            <button class="btn btn-secondary ml-2" disabled>
                                                Sudah Selesai
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Data masih kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
