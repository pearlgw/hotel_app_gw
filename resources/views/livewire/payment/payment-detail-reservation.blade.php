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
    <div>
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
        <p>{{ $deskripsi }}</p>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-info">Detail Payment</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Code Reservation</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Status Konfirmasi Hotel</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($reservations as $reservation)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $reservation->code_reservation }}</td>
                                <td>Rp
                                    {{ number_format($reservation->total_price, 0, ',', '.') }}
                                </td>
                                <td>{{ ucfirst($reservation->status) }}</td>
                                <td>
                                    @if ($reservation->user_id)
                                        <span class="badge bg-success text-light p-2">Sudah Dikonfirmasi</span>
                                    @else
                                        <span class="badge bg-warning text-dark p-2">Belum Dikonfirmasi</span>
                                    @endif
                                </td>
                                <td>{{ $reservation->created_at->format('d F Y H:i:s') }}</td>
                                <td>
                                    <div class="row">
                                        <a wire:navigate href="/detail-payment/{{ $reservation->id }}/show"
                                            class="btn btn-primary ml-2">Show</a>
                                        @if ($reservation->status === 'paid')
                                            <button class="btn btn-secondary ml-2" disabled>
                                                Sudah Dibayar
                                            </button>
                                        @else
                                            <a href="https://app.sandbox.midtrans.com/snap/v4/redirection/{{ $reservation->snap_token }}"
                                                class="btn btn-success ml-2" target="_blank" rel="noopener noreferrer">
                                                Bayar
                                            </a>
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
