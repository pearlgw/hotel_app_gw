<div>
    <a wire:navigate href="/reservation-order" class="btn btn-info mb-4">Kembali</a>

    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                    <th>Kode Reservation</th>
                    <td>{{ $code_reservation }}</td>
                </tr>
                <tr>
                    <th>Total Keseluruhan</th>
                    <td>Rp {{ number_format($total_price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ ucfirst($status) }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $reservation->created_at->format('d F Y H:i:s') }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <h5>Detail Reservasi</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Bedroom</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Duration</th>
                        <th>Price per Room</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservation->detail_reservation as $detail)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $detail->bedroom->title_bedroom ?? '-' }}</td>
                            <td>{{ $detail->check_in }}</td>
                            <td>{{ $detail->check_out }}</td>
                            <td>{{ $detail->duration }} Hari</td>
                            <td>
                                Rp {{ number_format($detail->bedroom->category_bedroom->price ?? 0, 0, ',', '.') }}
                            </td>
                            <td>Rp {{ number_format($detail->total_price_per_room, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
