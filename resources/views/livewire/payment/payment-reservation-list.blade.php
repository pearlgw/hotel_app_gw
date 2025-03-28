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
            <h6 class="m-0 font-weight-bold text-info">Pembayaran</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Bedroom</th>
                            <th>Price Bedroom</th>
                            <th>Check In</th>
                            <th>Duration</th>
                            <th>Check Out</th>
                            <th>Total Price Per Rooom</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($detailReservations as $detailReservation)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detailReservation->bedroom->title_bedroom }}</td>
                                <td>Rp
                                    {{ number_format($detailReservation->bedroom->category_bedroom->price, 0, ',', '.') }}
                                </td>
                                <td>{{ $detailReservation->check_in }}</td>
                                <td>{{ $detailReservation->duration }} Hari</td>
                                <td>{{ $detailReservation->check_out }}</td>
                                <td>Rp
                                    {{ number_format($detailReservation->total_price_per_room, 0, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Data masih kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" class="text-right font-weight-bold">Total Keseluruhan:</td>
                            <td id="grand-total" class="font-weight-bold" colspan="2">Rp
                                {{ number_format($grandTotal, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                    <input type="hidden" id="grand_total"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" wire:model="grandTotal"
                        readonly />
                </table>
            </div>
            <div class="text-right mt-3">
                <button wire:click="saveReservation" class="btn btn-success">
                    Submit
                </button>
            </div>
        </div>
    </div>
</div>
