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
            <h6 class="m-0 font-weight-bold text-info">Data Reservasi Kamu</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" id="dataTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Bedroom</th>
                            <th>Price Bedroom</th>
                            <th>Check In</th>
                            <th>Duration</th>
                            <th>Check Out</th>
                            <th>Total Price Per Rooom</th>
                            <th>Action</th>
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
                                <td>
                                    <input type="datetime-local" wire:model.live="check_in.{{ $detailReservation->id }}"
                                        class="form-control">
                                </td>
                                <td>
                                    <input type="number" wire:model.live="duration.{{ $detailReservation->id }}"
                                        class="form-control">
                                </td>
                                <td>
                                    <input type="datetime-local" wire:model="check_out.{{ $detailReservation->id }}"
                                        readonly class="form-control">
                                </td>
                                <td>
                                    <input type="text" class="form-control"
                                        wire:model="total_price_per_room.{{ $detailReservation->id }}" readonly>
                                </td>
                                <td class="d-flex gap-2">
                                    <button wire:click="saveRoom({{ $detailReservation->id }})"
                                        class="btn btn-sm btn-success ml-2">Save</button>
                                    <button wire:click="deleteRoom({{ $detailReservation->id }})"
                                        class="btn btn-sm btn-danger ml-2">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Data masih kosong</td>
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
                </table>
            </div>
        </div>
    </div>
</div>
