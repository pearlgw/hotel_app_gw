<div>
    <div>
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>
        <p>
            {{ $deskripsi }}
        </p>
    </div>
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
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-info">Data Transaction</h6>
            <a wire:navigate href="/transaction/create" class="btn btn-sm btn-info">Tambah Transaksi</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" id="dataTable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Code Transaction</th>
                            <th>User</th>
                            <th>Order</th>
                            <th>Total Price</th>
                            <th>Pay Money</th>
                            <th>Refund Money</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaction->code_transaction }}</td>
                                <td>{{ $transaction->user->name }}</td>
                                <td>{{ $transaction->order->name }}</td>
                                <td>Rp {{ number_format($transaction->total_price, 0, ',', '.') }} </td>
                                <td>Rp {{ number_format($transaction->pay_money, 0, ',', '.') }} </td>
                                <td>Rp {{ number_format($transaction->refund_money, 0, ',', '.') }} </td>
                                <td>{{ $transaction->created_at->format('d F Y H:i:s') }}</td>
                                <td>{{ $transaction->updated_at->format('d F Y H:i:s') }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <a wire:navigate href="/transaction/{{ $transaction->id }}/show"
                                            class="btn btn-sm btn-primary">Show</a>
                                        @if ($transaction->status == 'paid')
                                            <button wire:click='finishTransaction({{ $transaction->id }})'
                                                class="btn btn-sm btn-warning ml-2">
                                                Selesai
                                            </button>
                                        @else
                                            <button class="btn btn-secondary ml-2 btn-sm" disabled>
                                                Sudah Selesai
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center">Data masih kosong</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
