<div>
    <a wire:navigate href="/transaction" class="btn btn-info mb-4">Kembali</a>

    <div class="row">
        <div class="col-md-6">
            <table class="table table-bordered">
                <tr>
                    <th>Kode Transaksi</th>
                    <td>{{ $code_transaction }}</td>
                </tr>
                <tr>
                    <th>User</th>
                    <td>{{ $transaction->user->name }}</td>
                    {{-- <td>Rp {{ number_format($total_price, 0, ',', '.') }}</td> --}}
                </tr>
                <tr>
                    <th>Order</th>
                    <td>{{ $transaction->order->name }}</td>
                    {{-- <td>Rp {{ number_format($total_price, 0, ',', '.') }}</td> --}}
                </tr>
                <tr>
                    <th>Total Price</th>
                    <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Pay Money</th>
                    <td>Rp {{ number_format($transaction->pay_money, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Refund Money</th>
                    <td>Rp {{ number_format($transaction->refund_money, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $transaction->created_at->format('d F Y H:i:s') }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <h5>Detail Transaction</h5>
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
                    @foreach ($transaction->detail_transaction as $detail)
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
